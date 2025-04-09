<?php
/*
 * Plugin Name: Plugin Reference Cleaner
 * Description: Adds a "Remove Reference" button to plugin deactivation error notices, allowing users to clean up invalid plugin entries.
 * Version: 1.3.1
 * Author: Marcus Quinn
 * Author URI: https://www.wpallstars.com
 * License: GPL-2.0+
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Plugin_Reference_Cleaner {
    public function __construct() {
        // Add our plugin to the plugins list
        add_filter('all_plugins', array($this, 'add_missing_plugins_references'));
        
        // Add our action link to the plugins list
        add_filter('plugin_action_links', array($this, 'add_remove_reference_action'), 20, 4);
        
        // Handle the remove reference action
        add_action('admin_init', array($this, 'handle_remove_reference'));
        
        // Add admin notices for operation feedback
        add_action('admin_notices', array($this, 'admin_notices'));
    }
    
    /**
     * Find and add invalid plugin references to the plugins list
     */
    public function add_missing_plugins_references($plugins) {
        // Only run on the plugins page
        if (!$this->is_plugins_page()) {
            return $plugins;
        }

        // Get active plugins that don't exist
        $invalid_plugins = $this->get_invalid_plugins();
        
        // Add each invalid plugin to the plugin list
        foreach ($invalid_plugins as $plugin_path) {
            if (!isset($plugins[$plugin_path])) {
                $plugin_name = basename($plugin_path);
                $plugins[$plugin_path] = array(
                    'Name' => $plugin_name . ' <span class="error">(File Missing)</span>',
                    'Description' => 'This plugin file does not exist. You can safely remove this reference.',
                    'Version' => 'N/A',
                    'Author' => '',
                    'PluginURI' => '',
                    'AuthorURI' => '',
                    'Title' => $plugin_name . ' (Missing)',
                    'AuthorName' => ''
                );
            }
        }
        
        return $plugins;
    }
    
    /**
     * Add the Remove Reference action link to invalid plugins
     */
    public function add_remove_reference_action($actions, $plugin_file, $plugin_data, $context) {
        // Only run on the plugins page
        if (!$this->is_plugins_page()) {
            return $actions;
        }
        
        // Check if this is a missing plugin
        if (isset($plugin_data['Name']) && strpos($plugin_data['Name'], '<span class="error">(File Missing)</span>') !== false) {
            // Clear existing actions
            $actions = array();
            
            // Add our action
            $nonce = wp_create_nonce('remove_plugin_reference_' . $plugin_file);
            $remove_url = admin_url('plugins.php?action=remove_reference&plugin=' . urlencode($plugin_file) . '&_wpnonce=' . $nonce);
            $actions['remove_reference'] = '<a href="' . esc_url($remove_url) . '" class="delete" aria-label="' . esc_attr__('Remove Reference', 'plugin-reference-cleaner') . '">Remove Reference</a>';
        }
        
        return $actions;
    }
    
    /**
     * Handle the remove reference action
     */
    public function handle_remove_reference() {
        // Check if we're removing a reference
        if (!isset($_GET['action']) || $_GET['action'] !== 'remove_reference' || !isset($_GET['plugin'])) {
            return;
        }
        
        // Verify permissions
        if (!current_user_can('activate_plugins')) {
            wp_die(__('You do not have sufficient permissions to perform this action.', 'plugin-reference-cleaner'));
        }
        
        // Get the plugin file
        $plugin_file = isset($_GET['plugin']) ? $_GET['plugin'] : '';
        
        // Verify nonce
        check_admin_referer('remove_plugin_reference_' . $plugin_file);
        
        // Remove the plugin reference
        $success = $this->remove_plugin_reference($plugin_file);
        
        // Redirect back to plugins page with a message
        $redirect = admin_url('plugins.php');
        $redirect = add_query_arg($success ? 'reference_removed' : 'reference_removal_failed', '1', $redirect);
        wp_redirect($redirect);
        exit;
    }
    
    /**
     * Remove a plugin reference from the active plugins
     */
    public function remove_plugin_reference($plugin_file) {
        $success = false;
        
        // Handle multisite network admin
        if (is_multisite() && is_network_admin()) {
            $active_plugins = get_site_option('active_sitewide_plugins', array());
            if (isset($active_plugins[$plugin_file])) {
                unset($active_plugins[$plugin_file]);
                $success = update_site_option('active_sitewide_plugins', $active_plugins);
            }
        } 
        // Handle single site or multisite subsite
        else {
            $active_plugins = get_option('active_plugins', array());
            $key = array_search($plugin_file, $active_plugins);
            if ($key !== false) {
                unset($active_plugins[$key]);
                $active_plugins = array_values($active_plugins); // Re-index array
                $success = update_option('active_plugins', $active_plugins);
            }
        }
        
        return $success;
    }
    
    /**
     * Display admin notices
     */
    public function admin_notices() {
        // Only run on the plugins page
        if (!$this->is_plugins_page()) {
            return;
        }
        
        // Get invalid plugins
        $invalid_plugins = $this->get_invalid_plugins();
        
        // Display instructional notice if there are invalid plugins
        if (!empty($invalid_plugins)) {
            echo '<div class="notice notice-info is-dismissible">';
            echo '<h3>Plugin Reference Cleaner</h3>';
            echo '<p><strong>Missing plugin files detected:</strong> The plugins listed below with <span style="color:red;">(File Missing)</span> tag no longer exist but are still referenced in your database.</p>';
            echo '<p><strong>How to fix:</strong> Click the "Remove Reference" link next to each missing plugin to safely remove it from your active plugins list.</p>';
            echo '<p>This will clean up your database and remove the error notifications.</p>';
            echo '</div>';
        }
        
        // Show success message
        if (isset($_GET['reference_removed']) && $_GET['reference_removed'] === '1') {
            echo '<div class="notice notice-success is-dismissible"><p>Plugin reference removed successfully.</p></div>';
        }
        
        // Show error message
        if (isset($_GET['reference_removal_failed']) && $_GET['reference_removal_failed'] === '1') {
            echo '<div class="notice notice-error is-dismissible"><p>Failed to remove plugin reference. The plugin may already have been removed.</p></div>';
        }
    }
    
    /**
     * Check if we're on the plugins page
     */
    private function is_plugins_page() {
        global $pagenow;
        return is_admin() && $pagenow === 'plugins.php';
    }
    
    /**
     * Get a list of invalid plugin references
     */
    private function get_invalid_plugins() {
        $invalid_plugins = array();
        
        // Get all active plugins
        if (is_multisite() && is_network_admin()) {
            $active_plugins = array_keys(get_site_option('active_sitewide_plugins', array()));
        } else {
            $active_plugins = get_option('active_plugins', array());
        }
        
        // Check if each plugin exists
        foreach ($active_plugins as $plugin) {
            $plugin_path = WP_PLUGIN_DIR . '/' . $plugin;
            if (!file_exists($plugin_path)) {
                $invalid_plugins[] = $plugin;
            }
        }
        
        return $invalid_plugins;
    }
}

// Initialize the plugin
new Plugin_Reference_Cleaner();