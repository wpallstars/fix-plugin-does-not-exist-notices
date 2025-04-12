<?php
/**
 * Fix 'Plugin file does not exist.' Notices
 *
 * @package           FixPluginDoesNotExistNotices
 * @author            Marcus Quinn
 * @copyright         2023 WP ALLSTARS
 * @license           GPL-2.0+
 * @noinspection      PhpUndefinedFunctionInspection
 * @noinspection      PhpUndefinedConstantInspection
 *
 * @wordpress-plugin
 * Plugin Name: Fix 'Plugin file does not exist.' Notices
 * Plugin URI: https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/
 * Description: Adds missing plugins to the plugins list with a "Remove Reference" link so you can permanently clean up invalid plugin entries and remove error notices.
 * Version: 2.0.1
 * Author: Marcus Quinn & WP ALLSTARS
 * Author URI: https://www.wpallstars.com
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: fix-plugin-does-not-exist-notices
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Update URI: https://git-updater.wpallstars.com
 * GitHub Plugin URI: wpallstars/fix-plugin-does-not-exist-notices
 * GitHub Branch: main
 * Gitea Plugin URI: wpallstars/fix-plugin-does-not-exist-notices
 * Gitea Branch: main
 *
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'FPDEN_VERSION', '2.0.1' );
define( 'FPDEN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FPDEN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FPDEN_PLUGIN_FILE', __FILE__ );
define( 'FPDEN_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Load plugin text domain.
 *
 * @return void
 */
function fpden_load_textdomain() {
	load_plugin_textdomain(
		'fix-plugin-does-not-exist-notices',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages/'
	);
}
add_action( 'plugins_loaded', 'fpden_load_textdomain' );

/**
 * Main class for the plugin.
 */
class Fix_Plugin_Does_Not_Exist_Notices {

	/**
	 * Cached list of invalid plugins.
	 *
	 * @var array
	 */
	private $invalid_plugins = null;

	/**
	 * Constructor. Hooks into WordPress actions and filters.
	 */
	public function __construct() {
		// Add our plugin to the plugins list.
		add_filter( 'all_plugins', array( $this, 'add_missing_plugins_references' ) );

		// Add our action link to the plugins list.
		add_filter( 'plugin_action_links', array( $this, 'add_remove_reference_action' ), 20, 4 );

		// Handle the remove reference action.
		add_action( 'admin_init', array( $this, 'handle_remove_reference' ) );

		// Add admin notices for operation feedback.
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );

		// Enqueue admin scripts and styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

		// We're no longer trying to prevent WordPress from auto-deactivating plugins
		// as it was causing critical errors in some environments
	}

	/**
	 * Enqueue scripts and styles needed for the admin area.
	 *
	 * @param string $hook_suffix The current admin page hook.
	 * @return void
	 */
	public function enqueue_admin_assets( $hook_suffix ) {
		// Only load on the plugins page.
		if ( 'plugins.php' !== $hook_suffix ) {
			return;
		}

		// Get invalid plugins to decide if assets are needed.
		$invalid_plugins = $this->get_invalid_plugins();
		if ( empty( $invalid_plugins ) ) {
			return; // No missing plugins, no need for the special notice JS/CSS.
		}

		wp_enqueue_style(
			'fpden-admin-styles',
			FPDEN_PLUGIN_URL . 'assets/css/admin-styles.css',
			array(),
			FPDEN_VERSION
		);

		wp_enqueue_script(
			'fpden-admin-scripts',
			FPDEN_PLUGIN_URL . 'assets/js/admin-scripts.js',
			array( 'jquery' ), // Add dependencies if needed, e.g., jQuery.
			FPDEN_VERSION,
			true // Load in footer.
		);

		// Add translation strings for JavaScript
		wp_localize_script(
			'fpden-admin-scripts',
			'fpdenData',
			array(
				'i18n' => array(
					'clickToScroll' => esc_html__( 'Click here to scroll to missing plugins', 'fix-plugin-does-not-exist-notices' ),
					'pluginMissing' => esc_html__( 'File Missing', 'fix-plugin-does-not-exist-notices' ),
					'removeNotice' => esc_html__( 'Remove Notice', 'fix-plugin-does-not-exist-notices' ),
				),
			)
		);
	}

	/**
	 * Find and add invalid plugin references to the plugins list.
	 *
	 * Filters the list of plugins displayed on the plugins page to include
	 * entries for active plugins whose files are missing.
	 *
	 * @param array $plugins An array of plugin data.
	 * @return array The potentially modified array of plugin data.
	 */
	public function add_missing_plugins_references( $plugins ) {
		// Only run on the plugins page.
		if ( ! $this->is_plugins_page() ) {
			return $plugins;
		}

		// Get active plugins that don't exist.
		$invalid_plugins = $this->get_invalid_plugins();

		// Add each invalid plugin to the plugin list.
		foreach ( $invalid_plugins as $plugin_path ) {
			if ( ! isset( $plugins[ $plugin_path ] ) ) {
				$plugin_name          = basename( $plugin_path );
				$plugins[ $plugin_path ] = array(
					'Name'        => $plugin_name . ' <span class="error">(File Missing)</span>',
					/* translators: %s: Path to wp-content/plugins */
					'Description' => sprintf(
						__( 'This plugin is still marked as "Active" in your database — but its folder and files can\'t be found in %s. Click "Remove Notice" to permanently remove it from your active plugins list and eliminate the error notice.', 'fix-plugin-does-not-exist-notices' ),
						'<code>/wp-content/plugins/</code>'
					),
					'Version'     => __( 'N/A', 'fix-plugin-does-not-exist-notices' ),
					'Author'      => '',
					'PluginURI'   => '',
					'AuthorURI'   => '',
					'Title'       => $plugin_name . ' (' . __( 'Missing', 'fix-plugin-does-not-exist-notices' ) . ')',
					'AuthorName'  => '',
				);
			}
		}

		return $plugins;
	}

	/**
	 * Add the Remove Notice action link to invalid plugins.
	 *
	 * Filters the action links displayed for each plugin on the plugins page.
	 * Adds a "Remove Notice" link for plugins identified as missing.
	 *
	 * @param array  $actions     An array of plugin action links.
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 * @param array  $plugin_data An array of plugin data.
	 * @param string $context     The plugin context (e.g., 'all', 'active', 'inactive').
	 * @return array The potentially modified array of plugin action links.
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function add_remove_reference_action( $actions, $plugin_file, $plugin_data, $context ) {
		// Only run on the plugins page.
		if ( ! $this->is_plugins_page() ) {
			return $actions;
		}

		// Get our list of invalid plugins
		$invalid_plugins = $this->get_invalid_plugins();

		// Check if this plugin file is in our list of invalid plugins
		if ( in_array( $plugin_file, $invalid_plugins, true ) ) {
			// Clear existing actions like "Activate", "Deactivate", "Edit".
			$actions = array();

			// Add our custom action.
			$nonce      = wp_create_nonce( 'remove_plugin_reference_' . $plugin_file );
			$remove_url = admin_url( 'plugins.php?action=remove_reference&plugin=' . urlencode( $plugin_file ) . '&_wpnonce=' . $nonce );
			/* translators: %s: Plugin file path */
			$aria_label                 = sprintf( __( 'Remove reference to missing plugin %s', 'fix-plugin-does-not-exist-notices' ), esc_attr( $plugin_file ) );
			$actions['remove_reference'] = '<a href="' . esc_url( $remove_url ) . '" class="delete" aria-label="' . $aria_label . '">' . esc_html__( 'Remove Notice', 'fix-plugin-does-not-exist-notices' ) . '</a>';
		}

		return $actions;
	}

	/**
	 * Handle the remove reference action triggered by the link.
	 *
	 * Checks for the correct action, verifies nonce and permissions,
	 * calls the removal function, and redirects back to the plugins page.
	 *
	 * @return void
	 */
	public function handle_remove_reference() {
		// Check if our specific action is being performed.
		if ( ! isset( $_GET['action'] ) || 'remove_reference' !== $_GET['action'] || ! isset( $_GET['plugin'] ) ) {
			return;
		}

		// Verify user permissions.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to perform this action.', 'fix-plugin-does-not-exist-notices' ) );
		}

		// Sanitize and get the plugin file path.
		$plugin_file = isset( $_GET['plugin'] ) ? sanitize_text_field( wp_unslash( $_GET['plugin'] ) ) : '';
		if ( empty( $plugin_file ) ) {
			wp_die( esc_html__( 'Invalid plugin specified.', 'fix-plugin-does-not-exist-notices' ) );
		}

		// Verify nonce for security.
		check_admin_referer( 'remove_plugin_reference_' . $plugin_file );

		// Attempt to remove the plugin reference.
		$success = $this->remove_plugin_reference( $plugin_file );

		// Prepare redirect URL with feedback query args.
		$redirect_url = admin_url( 'plugins.php' );
		$redirect_url = add_query_arg( $success ? 'reference_removed' : 'reference_removal_failed', '1', $redirect_url );

		// Redirect and exit.
		wp_safe_redirect( $redirect_url );
		exit;
	}

	/**
	 * Remove a plugin reference from the active plugins list in the database.
	 *
	 * Handles both single site and multisite network activated plugins.
	 *
	 * @param string $plugin_file The plugin file path to remove.
	 * @return bool True on success, false on failure or if the plugin wasn't found.
	 */
	public function remove_plugin_reference( $plugin_file ) {
		$success = false;

		// Ensure plugin file path is provided.
		if ( empty( $plugin_file ) ) {
			return false;
		}

		// Handle multisite network admin context.
		if ( is_multisite() && is_network_admin() ) {
			$active_plugins = get_site_option( 'active_sitewide_plugins', array() );
			// Network active plugins are stored as key => timestamp.
			if ( isset( $active_plugins[ $plugin_file ] ) ) {
				unset( $active_plugins[ $plugin_file ] );
				$success = update_site_option( 'active_sitewide_plugins', $active_plugins );
			}
		} else { // Handle single site or non-network admin context.
			$active_plugins = get_option( 'active_plugins', array() );
			// Single site active plugins are stored as an indexed array.
			$key = array_search( $plugin_file, $active_plugins, true ); // Use strict comparison.
			if ( false !== $key ) {
				unset( $active_plugins[ $key ] );
				// Re-index the array numerically.
				$active_plugins = array_values( $active_plugins );
				$success        = update_option( 'active_plugins', $active_plugins );
			}
		}

		return $success;
	}

	/**
	 * Display admin notices on the plugins page.
	 *
	 * Shows feedback messages after attempting to remove a reference.
	 * The main informational notice is handled by JavaScript to position it
	 * directly below the WordPress error message.
	 *
	 * @return void
	 */
	public function admin_notices() {
		// Only run on the plugins page.
		if ( ! $this->is_plugins_page() ) {
			return;
		}

		// Check for feedback messages from the remove action.
		if ( isset( $_GET['reference_removed'] ) && '1' === $_GET['reference_removed'] ) {
			?>
			<div class="notice notice-success is-dismissible">
				<p><?php esc_html_e( 'Plugin reference removed successfully.', 'fix-plugin-does-not-exist-notices' ); ?></p>
			</div>
			<?php
		}

		if ( isset( $_GET['reference_removal_failed'] ) && '1' === $_GET['reference_removal_failed'] ) {
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php esc_html_e( 'Failed to remove plugin reference. The plugin may already have been removed, or there was a database issue.', 'fix-plugin-does-not-exist-notices' ); ?></p>
			</div>
			<?php
		}
		// The main informational notice is now handled entirely by JavaScript
		// to position it directly below the WordPress error message.
	}

	/**
	 * Check if the current admin page is the plugins page.
	 *
	 * @global string $pagenow WordPress global variable for the current admin page filename.
	 * @return bool True if the current page is plugins.php, false otherwise.
	 */
	private function is_plugins_page() {
		global $pagenow;
		// Check if it's an admin page and the filename is plugins.php.
		return is_admin() && isset( $pagenow ) && 'plugins.php' === $pagenow;
	}

	/**
	 * Get a list of active plugin file paths that do not exist on the filesystem.
	 *
	 * Checks both single site and network active plugins based on the context.
	 * Uses caching to avoid repeated filesystem checks.
	 *
	 * @return array An array of plugin file paths (relative to WP_PLUGIN_DIR) that are missing.
	 */
	private function get_invalid_plugins() {
		// Return cached result if available
		if ( null !== $this->invalid_plugins ) {
			return $this->invalid_plugins;
		}

		$this->invalid_plugins = array();
		$active_plugins  = array();

		// Determine which option to check based on context (Network Admin or single site).
		if ( is_multisite() && is_network_admin() ) {
			// Network active plugins are stored as keys in an associative array.
			$active_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
		} else {
			// Single site active plugins are stored in a numerically indexed array.
			$active_plugins = get_option( 'active_plugins', array() );
		}

		// Check if the file exists for each active plugin.
		foreach ( $active_plugins as $plugin_file ) {
			// Construct the full path to the main plugin file.
			$plugin_path = WP_PLUGIN_DIR . '/' . $plugin_file;
			// Use validate_file to prevent directory traversal issues, although less likely here.
			if ( validate_file( $plugin_file ) === 0 && ! file_exists( $plugin_path ) ) {
				$this->invalid_plugins[] = $plugin_file;
			}
		}

		return $this->invalid_plugins;
	}

// We've removed the prevent_auto_deactivation method as it was causing critical errors
} // End class Fix_Plugin_Does_Not_Exist_Notices

// Initialize the plugin class.
new Fix_Plugin_Does_Not_Exist_Notices();

// Initialize the updater if composer autoload exists
$autoloader = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloader)) {
    require_once $autoloader;

    // Initialize the updater if the class exists
    if (class_exists('\WPALLSTARS\FixPluginDoesNotExistNotices\Updater')) {
        new \WPALLSTARS\FixPluginDoesNotExistNotices\Updater(__FILE__);
    }
}
