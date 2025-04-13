/**
 * Fix Plugin Details Popup
 * 
 * This script directly modifies the plugin details popup to show the correct version
 * when the popup is opened for our plugin.
 */
(function($) {
    'use strict';

    // Current plugin version - this should match the version in the main plugin file
    const CURRENT_VERSION = '2.0.9';
    
    // Plugin slugs to check for
    const OUR_SLUGS = ['wp-fix-plugin-does-not-exist-notices', 'fix-plugin-does-not-exist-notices'];
    
    // Wait for the document to be ready
    $(document).ready(function() {
        // Listen for the thickbox to open (WordPress uses thickbox for plugin details)
        $(document).on('tb_init', function() {
            // Check if we're on the plugins page
            if (window.location.href.indexOf('plugins.php') === -1) {
                return;
            }
            
            // Set a timeout to allow the thickbox content to load
            setTimeout(function() {
                // Get the thickbox content
                const $thickbox = $('#TB_window');
                if (!$thickbox.length) return;
                
                // Get the plugin slug from the URL
                const tbUrl = $('#TB_iframeContent').attr('src');
                if (!tbUrl) return;
                
                // Extract the plugin slug from the URL
                const slugMatch = tbUrl.match(/plugin=([^&]+)/);
                if (!slugMatch || !slugMatch[1]) return;
                
                const pluginSlug = decodeURIComponent(slugMatch[1]);
                
                // Check if this is our plugin
                if (OUR_SLUGS.indexOf(pluginSlug) !== -1) {
                    console.log('Fixing plugin details for: ' + pluginSlug);
                    
                    // Find the version element in the thickbox
                    const $iframe = $('#TB_iframeContent');
                    if (!$iframe.length) return;
                    
                    // Wait for iframe to load
                    $iframe.on('load', function() {
                        const iframeDoc = this.contentDocument || this.contentWindow.document;
                        
                        // Find the version element
                        const $versionElement = $(iframeDoc).find('.plugin-version-author-uri');
                        if (!$versionElement.length) return;
                        
                        // Update the version text
                        const versionText = $versionElement.text();
                        const newVersionText = versionText.replace(/Version: [0-9.]+/, 'Version: ' + CURRENT_VERSION);
                        $versionElement.text(newVersionText);
                        
                        // Also update the version in the header if it exists
                        const $versionHeader = $(iframeDoc).find('h2:contains("Version:")');
                        if ($versionHeader.length) {
                            $versionHeader.text('Version: ' + CURRENT_VERSION);
                        }
                        
                        console.log('Plugin details updated to version: ' + CURRENT_VERSION);
                    });
                }
            }, 500); // Wait 500ms for the thickbox to load
        });
    });
})(jQuery);
