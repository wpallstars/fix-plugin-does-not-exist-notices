<?php
/**
 * Plugin Name: Clear Plugin Transients
 * Description: A temporary plugin to clear all WordPress plugin transients
 * Version: 1.0.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Run on plugin activation
register_activation_hook(__FILE__, 'clear_plugin_transients');

// Also run immediately
add_action('admin_init', 'clear_plugin_transients');

/**
 * Clear all plugin-related transients
 */
function clear_plugin_transients() {
    global $wpdb;
    
    // Log that we're running
    error_log('Running clear_plugin_transients');
    
    // Clear specific plugin transients
    $our_slugs = array('wp-fix-plugin-does-not-exist-notices', 'fix-plugin-does-not-exist-notices');
    
    foreach ($our_slugs as $slug) {
        // Delete all possible transients for this plugin
        delete_transient('plugins_api_' . $slug);
        delete_site_transient('plugins_api_' . $slug);
        delete_transient('plugin_information_' . $slug);
        delete_site_transient('plugin_information_' . $slug);
        
        // Log what we're deleting
        error_log('Deleting transients for: ' . $slug);
        
        // Delete any transients with the slug in the name
        $wpdb->query($wpdb->prepare(
            "DELETE FROM $wpdb->options WHERE option_name LIKE %s OR option_name LIKE %s",
            '%' . $wpdb->esc_like('_transient_' . $slug) . '%',
            '%' . $wpdb->esc_like('_transient_timeout_' . $slug) . '%'
        ));
        
        // Delete site transients too (for multisite)
        if (is_multisite()) {
            $wpdb->query($wpdb->prepare(
                "DELETE FROM $wpdb->sitemeta WHERE meta_key LIKE %s OR meta_key LIKE %s",
                '%' . $wpdb->esc_like('_site_transient_' . $slug) . '%',
                '%' . $wpdb->esc_like('_site_transient_timeout_' . $slug) . '%'
            ));
        }
    }
    
    // Clear all plugin API transients
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%_transient_plugins_api_%'");
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%_transient_timeout_plugins_api_%'");
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%_transient_plugin_information_%'");
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%_transient_timeout_plugin_information_%'");
    
    // Clear site transients too (for multisite)
    if (is_multisite()) {
        $wpdb->query("DELETE FROM $wpdb->sitemeta WHERE meta_key LIKE '%_site_transient_plugins_api_%'");
        $wpdb->query("DELETE FROM $wpdb->sitemeta WHERE meta_key LIKE '%_site_transient_timeout_plugins_api_%'");
        $wpdb->query("DELETE FROM $wpdb->sitemeta WHERE meta_key LIKE '%_site_transient_plugin_information_%'");
        $wpdb->query("DELETE FROM $wpdb->sitemeta WHERE meta_key LIKE '%_site_transient_timeout_plugin_information_%'");
    }
    
    // Clear update cache
    delete_site_transient('update_plugins');
    delete_site_transient('update_themes');
    delete_site_transient('update_core');
    delete_site_transient('plugin_information');
    
    // Clear plugin update counts
    delete_transient('plugin_updates_count');
    delete_site_transient('plugin_updates_count');
    
    // Clear plugin slugs cache
    delete_transient('plugin_slugs');
    delete_site_transient('plugin_slugs');
    
    // Force refresh of plugin update information
    if (function_exists('wp_clean_plugins_cache')) {
        wp_clean_plugins_cache(true);
    }
    
    // Clear object cache
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
    }
    
    // Add admin notice
    add_action('admin_notices', 'plugin_transients_cleared_notice');
}

/**
 * Display admin notice
 */
function plugin_transients_cleared_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><strong>Plugin Transients Cleared:</strong> All plugin transients have been cleared from the database.</p>
    </div>
    <?php
}
