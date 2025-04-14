<?php
/**
 * Main Plugin Class
 *
 * @package WPALLSTARS\FixPluginDoesNotExistNotices
 */

namespace WPALLSTARS\FixPluginDoesNotExistNotices;

/**
 * Main Plugin Class
 *
 * Initializes all components of the plugin.
 */
class Plugin {

    /**
     * Plugin version
     *
     * @var string
     */
    private $version;

    /**
     * Plugin file path
     *
     * @var string
     */
    private $plugin_file;

    /**
     * Plugin directory path
     *
     * @var string
     */
    private $plugin_dir;

    /**
     * Plugin directory URL
     *
     * @var string
     */
    private $plugin_url;

    /**
     * Core functionality instance
     *
     * @var Core
     */
    private $core;

    /**
     * Admin functionality instance
     *
     * @var Admin
     */
    private $admin;

    /**
     * Updater instance
     *
     * @var Updater
     */
    private $updater;

    /**
     * Constructor
     *
     * @param string $plugin_file Main plugin file path.
     * @param string $version Plugin version.
     */
    public function __construct($plugin_file, $version) {
        $this->plugin_file = $plugin_file;
        $this->version = $version;
        $this->plugin_dir = plugin_dir_path($plugin_file);
        $this->plugin_url = plugin_dir_url($plugin_file);

        $this->define_constants();
        $this->load_dependencies();
        $this->init_components();
    }

    /**
     * Define plugin constants
     *
     * @return void
     */
    private function define_constants() {
        if (!defined('FPDEN_VERSION')) {
            define('FPDEN_VERSION', $this->version);
        }
        if (!defined('FPDEN_PLUGIN_DIR')) {
            define('FPDEN_PLUGIN_DIR', $this->plugin_dir);
        }
        if (!defined('FPDEN_PLUGIN_URL')) {
            define('FPDEN_PLUGIN_URL', $this->plugin_url);
        }
    }

    /**
     * Load dependencies
     *
     * @return void
     */
    private function load_dependencies() {
        // Load composer autoloader if it exists
        $autoloader = $this->plugin_dir . 'vendor/autoload.php';
        if (file_exists($autoloader)) {
            require_once $autoloader;
        }

        // Load required files
        require_once $this->plugin_dir . 'includes/Core.php';
        require_once $this->plugin_dir . 'includes/Admin.php';
        require_once $this->plugin_dir . 'includes/Modal.php';
    }

    /**
     * Initialize plugin components
     *
     * @return void
     */
    private function init_components() {
        // Initialize core functionality
        $this->core = new Core();

        // Initialize admin functionality
        $this->admin = new Admin($this->core);

        // Initialize Git Updater fixes
        $this->init_git_updater_fixes();

        // Initialize the updater if the class exists
        if (class_exists('\WPALLSTARS\FixPluginDoesNotExistNotices\Updater')) {
            $this->updater = new Updater($this->plugin_file);
        }

        // Initialize the modal for update source selection
        new Modal();
    }

    /**
     * Initialize Git Updater fixes
     *
     * This function adds filters to fix Git Updater's handling of 'main' vs 'master' branches
     *
     * @return void
     */
    private function init_git_updater_fixes() {
        // Fix for Git Updater looking for 'master' branch instead of 'main'
        add_filter('gu_get_repo_branch', array($this, 'override_branch'), 999, 3);

        // Fix for Git Updater API URLs
        add_filter('gu_get_repo_api', array($this, 'override_api_url'), 999, 3);

        // Fix for Git Updater download URLs
        add_filter('gu_download_link', array($this, 'override_download_link'), 999, 3);

        // Fix for Git Updater repository metadata
        add_filter('gu_get_repo_meta', array($this, 'override_repo_meta'), 999, 2);

        // Fix for Git Updater API responses
        add_filter('gu_api_repo_type_data', array($this, 'override_repo_type_data'), 999, 3);
    }

    /**
     * Override the branch name for our plugin
     *
     * @param string $branch The current branch name
     * @param string $git The git service (github, gitlab, etc.)
     * @param object|null $repo The repository object (optional)
     * @return string The modified branch name
     */
    public function override_branch($branch, $git, $repo = null) {
        // If repo is null or not an object, just return the branch unchanged
        if (!is_object($repo)) {
            return $branch;
        }
        if (isset($repo->slug) &&
            (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
             strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {
            return 'main';
        }
        return $branch;
    }

    /**
     * Override the API URL for our plugin
     *
     * @param mixed $api_url The current API URL (can be string or object)
     * @param string $git The git service (github, gitlab, etc.)
     * @param object|null $repo The repository object (optional)
     * @return mixed The modified API URL (same type as input)
     */
    public function override_api_url($api_url, $git, $repo = null) {
        // If repo is null or not an object, just return the URL unchanged
        if (!is_object($repo)) {
            return $api_url;
        }

        // Check if this is our plugin
        if (isset($repo->slug) &&
            (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
             strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {

            // Only apply str_replace if $api_url is a string
            if (is_string($api_url)) {
                return str_replace('/master/', '/main/', $api_url);
            }

            // If $api_url is an object, just return it unchanged
            // This handles the case where Git Updater passes a GitHub_API object
            return $api_url;
        }

        // Return unchanged if not our plugin
        return $api_url;
    }

    /**
     * Override the download link for our plugin
     *
     * @param string $download_link The current download link
     * @param string $git The git service (github, gitlab, etc.)
     * @param object|null $repo The repository object (optional)
     * @return string The modified download link
     */
    public function override_download_link($download_link, $git, $repo = null) {
        // If repo is null or not an object, just return the link unchanged
        if (!is_object($repo)) {
            return $download_link;
        }
        if (isset($repo->slug) &&
            (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
             strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {
            return str_replace('/master.zip', '/main.zip', $download_link);
        }
        return $download_link;
    }

    /**
     * Override repository metadata for our plugin
     *
     * @param array $repo_meta The repository metadata
     * @param object $repo The repository object
     * @return array The modified repository metadata
     */
    public function override_repo_meta($repo_meta, $repo) {
        if (isset($repo->slug) &&
            (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
             strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {

            // Set the correct repository information
            $repo_meta['github_updater_repo'] = 'wp-fix-plugin-does-not-exist-notices';
            $repo_meta['github_updater_branch'] = 'main';
            $repo_meta['github_updater_api'] = 'https://api.github.com';
            $repo_meta['github_updater_raw'] = 'https://raw.githubusercontent.com/wpallstars/wp-fix-plugin-does-not-exist-notices/main';
        }
        return $repo_meta;
    }

    /**
     * Override repository type data for our plugin
     *
     * @param array $data The repository data
     * @param object $response The API response
     * @param object|null $repo The repository object (optional)
     * @return array The modified repository data
     */
    public function override_repo_type_data($data, $response, $repo = null) {
        // If repo is null or not an object, just return the data unchanged
        if (!is_object($repo)) {
            return $data;
        }

        // Check if this is our plugin
        if (isset($repo->slug) &&
            (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
             strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {

            // Set the correct branch
            if (isset($data['branch'])) {
                $data['branch'] = 'main';
            }

            // Set the correct version
            if (isset($data['version'])) {
                $data['version'] = FPDEN_VERSION;
            }
        }
        return $data;
    }
}
