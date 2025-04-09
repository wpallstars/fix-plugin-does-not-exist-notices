<?php
/*
 * Plugin Name: Plugin Reference Cleaner
 * Description: Adds a "Remove Reference" button to plugin deactivation error notices, allowing users to clean up invalid plugin entries.
 * Version: 1.2.4
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
        // Only hook into admin actions when on the plugins page
        add_action('current_screen', function($screen) {
            if (isset($screen->id) && ($screen->id === 'plugins' || $screen->id === 'plugins-network')) {
                // Hook into admin notices to modify plugin error messages
                add_action('admin_notices', array($this, 'inject_remove_button'), 100);
                add_action('network_admin_notices', array($this, 'inject_remove_button'), 100);
            }
        });
        
        // Handle the AJAX request to remove the plugin reference
        add_action('wp_ajax_remove_plugin_reference', array($this, 'remove_plugin_reference'));
    }

    // Inject "Remove Reference" button only if a relevant notice exists
    public function inject_remove_button() {
        // Check if a "Plugin file does not exist" notice exists
        $notices = $this->get_admin_notices();
        $has_error_notice = false;
        $plugin_files = array();

        if (!empty($notices)) {
            foreach ($notices as $notice) {
                // Look for both variations of the error message
                if (strpos($notice, 'has been deactivated due to an error: Plugin file does not exist') !== false || 
                    strpos($notice, 'deactivated due to an error: Plugin file does not exist') !== false) {
                    // Extract plugin file from notice using various patterns
                    if (preg_match('/The plugin ([^ ]+)/', $notice, $match)) {
                        $plugin_files[] = $match[1];
                        $has_error_notice = true;
                    }
                }
            }
        }
        
        // Only proceed if a relevant notice was found
        if (!$has_error_notice || empty($plugin_files)) {
            return;
        }

        // Inject JavaScript with the specific plugin files
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var pluginFiles = <?php echo wp_json_encode($plugin_files); ?>;
                console.log('Plugin Reference Cleaner: Detected plugin files:', pluginFiles);
                
                // Get all notifications directly in the plugins page
                var pluginsPage = document.querySelector('.wrap');
                if (!pluginsPage) {
                    console.log('Plugin Reference Cleaner: Could not find the plugins page wrapper');
                    return;
                }
                
                // Look specifically for elements containing the error message
                // Use direct DOM traversal to find all text nodes
                function findTextNodesWithText(element, searchText) {
                    var result = [];
                    var walk = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
                    var node;
                    
                    while (node = walk.nextNode()) {
                        if (node.nodeValue.indexOf(searchText) > -1) {
                            result.push(node);
                        }
                    }
                    
                    return result;
                }
                
                // Find paragraphs containing error messages
                var errorTexts = findTextNodesWithText(pluginsPage, 'Plugin file does not exist');
                console.log('Plugin Reference Cleaner: Found error nodes:', errorTexts.length);
                
                if (errorTexts.length === 0) {
                    // Try another approach - find direct error messages
                    var allElements = pluginsPage.querySelectorAll('*');
                    for (var i = 0; i < allElements.length; i++) {
                        var el = allElements[i];
                        var text = el.textContent;
                        if (text && text.includes('has been deactivated due to an error: Plugin file does not exist')) {
                            errorTexts.push(el);
                        }
                    }
                }
                
                // Handle each error message
                errorTexts.forEach(function(textNode) {
                    console.log('Plugin Reference Cleaner: Processing error node:', textNode);
                    
                    // Get the parent element of the text node
                    var errorElement = textNode.parentNode || textNode;
                    
                    // Check if a button already exists to avoid duplicates
                    if (errorElement.querySelector('.remove-plugin-ref')) {
                        console.log('Plugin Reference Cleaner: Button already exists for this element');
                        return;
                    }
                    
                    // Find which plugin file this error refers to
                    var matchingPluginFile = null;
                    pluginFiles.forEach(function(pluginFile) {
                        if (textNode.nodeValue && textNode.nodeValue.includes(pluginFile) || 
                            (textNode.textContent && textNode.textContent.includes(pluginFile))) {
                            matchingPluginFile = pluginFile;
                        }
                    });
                    
                    // If we couldn't match a specific plugin, use the first one as fallback
                    if (!matchingPluginFile && pluginFiles.length > 0) {
                        matchingPluginFile = pluginFiles[0];
                        console.log('Plugin Reference Cleaner: Using fallback plugin file:', matchingPluginFile);
                    }
                    
                    if (matchingPluginFile) {
                        // Create button
                        var button = document.createElement('button');
                        button.textContent = 'Remove Reference';
                        button.className = 'button button-secondary remove-plugin-ref';
                        button.dataset.plugin = matchingPluginFile;
                        button.style.marginLeft = '10px';
                        
                        // Append the button to the error message
                        errorElement.appendChild(button);
                        console.log('Plugin Reference Cleaner: Added button for ' + matchingPluginFile + ' to', errorElement);
                    } else {
                        console.log('Plugin Reference Cleaner: Could not determine plugin file for this error');
                    }
                });
                
                // Inject a more direct approach if the above fails
                if (errorTexts.length === 0) {
                    // Target the specific format in the screenshot
                    var errorMessages = document.querySelectorAll('.wrap > .notice, .wrap > div > .notice');
                    console.log('Plugin Reference Cleaner: Trying direct approach, found notices:', errorMessages.length);
                    
                    errorMessages.forEach(function(notice) {
                        var text = notice.textContent;
                        if (text && text.includes('Plugin file does not exist')) {
                            // Extract the plugin path
                            var pluginMatch = /The plugin ([^ ]+) has been deactivated/.exec(text);
                            var pluginFile = pluginMatch ? pluginMatch[1] : (pluginFiles.length > 0 ? pluginFiles[0] : null);
                            
                            if (pluginFile) {
                                // Get container to add button
                                var container = notice.querySelector('p') || notice;
                                
                                if (!container.querySelector('.remove-plugin-ref')) {
                                    var button = document.createElement('button');
                                    button.textContent = 'Remove Reference';
                                    button.className = 'button button-secondary remove-plugin-ref';
                                    button.dataset.plugin = pluginFile;
                                    button.style.marginLeft = '10px';
                                    container.appendChild(button);
                                    console.log('Plugin Reference Cleaner: Direct approach - added button for ' + pluginFile);
                                }
                            }
                        }
                    });
                }

                // Add click event listeners to all created buttons
                document.querySelectorAll('.remove-plugin-ref').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        var pluginFile = this.dataset.plugin;
                        if (confirm('Are you sure you want to remove the reference to ' + pluginFile + '?')) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '<?php echo esc_url(admin_url('admin-ajax.php')); ?>', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    try {
                                        var response = JSON.parse(xhr.responseText);
                                        if (response.success) {
                                            alert('Plugin reference removed successfully.');
                                            location.reload();
                                        } else {
                                            alert('Failed to remove plugin reference: ' + (response.data || 'Unknown error'));
                                        }
                                    } catch (e) {
                                        alert('Failed to parse server response.');
                                        console.error(e);
                                    }
                                } else {
                                    alert('Failed to remove plugin reference. Server returned status ' + xhr.status);
                                }
                            };
                            xhr.onerror = function() {
                                alert('Network error occurred while trying to remove plugin reference.');
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
        // Static flag to prevent infinite recursion
        static $is_capturing = false;
        
        // If already capturing, return empty to break potential loops
        if ($is_capturing) {
            return array();
        }
        
        $is_capturing = true;
        
        ob_start();
        do_action('admin_notices');
        do_action('network_admin_notices');
        $output = ob_get_clean();
        
        $is_capturing = false;
        
        if (empty($output)) {
            return array();
        }
        
        return array_filter(explode("\n", $output));
    }

    // Handle the AJAX request to remove the plugin reference
    public function remove_plugin_reference() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'remove_plugin_reference')) {
            wp_send_json_error('Invalid security token. Please refresh the page and try again.');
            wp_die();
        }

        // Check user permissions
        if (!current_user_can('activate_plugins')) {
            wp_send_json_error('You do not have sufficient permissions to perform this action.');
            wp_die();
        }

        // Get and validate plugin file parameter
        $plugin_file = isset($_POST['plugin']) ? sanitize_text_field($_POST['plugin']) : '';
        if (empty($plugin_file)) {
            wp_send_json_error('No plugin specified.');
            wp_die();
        }

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

        if ($success) {
            wp_send_json_success('Plugin reference removed successfully.');
        } else {
            wp_send_json_error('Plugin reference not found or could not be removed.');
        }
        
        wp_die();
    }
}

// Initialize the plugin
new Plugin_Reference_Cleaner();