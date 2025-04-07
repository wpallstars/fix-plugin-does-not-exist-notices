<?php
/*
 * Plugin Name: Plugin Reference Cleaner
 * Description: Adds a "Remove Reference" button to plugin deactivation error notices, allowing users to clean up invalid plugin entries.
 * Version: 1.1
 * Author: Marcus Quinn
 * Author URI: https://wpallstars.com
 * License: GPL-2.0+
 */

class Plugin_Reference_Cleaner {
    public function __construct() {
        // Hook into admin notices to modify plugin error messages
        add_action('admin_notices', array($this, 'inject_remove_button'), 100);
        // Handle the AJAX request to remove the plugin reference
        add_action('wp_ajax_remove_plugin_reference', array($this, 'remove_plugin_reference'));
    }

    // Inject "Remove Reference" button only if a relevant notice exists
    public function inject_remove_button() {
        global $pagenow;

        // Only run on plugins.php or network admin plugins page
        if (!in_array($pagenow, array('plugins.php', 'network/plugins.php'))) {
            return;
        }

        // Check if a "Plugin file does not exist" notice exists
        $notices = $this->get_admin_notices();
        $has_error_notice = false;
        $plugin_files = array();

        foreach ($notices as $notice) {
            if (strpos($notice, 'has been deactivated due to an error: Plugin file does not exist') !== false) {
                // Extract plugin file from notice
                if (preg_match('/The plugin ([^ ]+)/', $notice, $match)) {
                    $plugin_files[] = $match[1];
                    $has_error_notice = true;
                }
            }
        }

        // Only proceed if a relevant notice was found
        if (!$has_error_notice) {
            return;
        }

        // Inject JavaScript with the specific plugin files
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var pluginFiles = <?php echo json_encode($plugin_files); ?>;
                var notices = document.querySelectorAll('.notice-error p');
                notices.forEach(function(notice) {
                    pluginFiles.forEach(function(pluginFile) {
                        if (notice.textContent.includes('The plugin ' + pluginFile)) {
                            var button = document.createElement('button');
                            button.textContent = 'Remove Reference';
                            button.className = 'button button-secondary remove-plugin-ref';
                            button.dataset.plugin = pluginFile;
                            button.style.marginLeft = '10px';
                            notice.appendChild(button);
                        }
                    });
                });

                document.querySelectorAll('.remove-plugin-ref').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        var pluginFile = this.dataset.plugin;
                        if (confirm('Are you sure you want to remove the reference to ' + pluginFile + '?')) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    alert('Plugin reference removed successfully.');
                                    location.reload();
                                } else {
                                    alert('Failed to remove plugin reference.');
                                }
                            };
                            xhr.send('action=remove_plugin_reference&plugin=' + encodeURIComponent(pluginFile) + '&nonce=<?php echo wp_create_nonce('remove_plugin_reference'); ?>');
                        }
                    });
                });
            });
        </script>
        <?php
    }

    // Helper function to capture admin notices
    private function get_admin_notices() {
        ob_start();
        do_action('admin_notices');
        $output = ob_get_clean();
        return array_filter(explode("\n", $output));
    }

    // Handle the AJAX request to remove the plugin reference
    public function remove_plugin_reference() {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'remove_plugin_reference')) {
            wp_send_json_error('Invalid nonce');
            wp_die();
        }

        if (!current_user_can('activate_plugins')) {
            wp_send_json_error('Insufficient permissions');
            wp_die();
        }

        $plugin_file = isset($_POST['plugin']) ? sanitize_text_field($_POST['plugin']) : '';
        if (empty($plugin_file)) {
            wp_send_json_error('No plugin specified');
            wp_die();
        }

        if (is_multisite() && is_network_admin()) {
            $active_plugins = get_site_option('active_sitewide_plugins', array());
            if (isset($active_plugins[$plugin_file])) {
                unset($active_plugins[$plugin_file]);
                update_site_option('active_sitewide_plugins', $active_plugins);
            }
        } else {
            $site_id = get_current_blog_id();
            $active_plugins = get_blog_option($site_id, 'active_plugins', array());
            $key = array_search($plugin_file, $active_plugins);
            if ($key !== false) {
                unset($active_plugins[$key]);
                $active_plugins = array_values($active_plugins);
                update_blog_option($site_id, 'active_plugins', $active_plugins);
            }
        }

        wp_send_json_success('Plugin reference removed');
        wp_die();
    }
}

new Plugin_Reference_Cleaner();