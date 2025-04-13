/**
 * Fix Plugin Version Display
 *
 * This script directly modifies the plugin details popup to show the correct version
 * when the popup is opened for our plugin.
 */
(function($) {
    'use strict';

    // Current plugin version - this should match the version in the main plugin file
    const CURRENT_VERSION = '2.0.13';

    // Plugin slugs to check for
    const OUR_SLUGS = ['wp-fix-plugin-does-not-exist-notices', 'fix-plugin-does-not-exist-notices'];

    // Function to fix the version in the plugin details popup
    function fixPluginDetailsVersion() {
        // Check if we're on the plugins page
        if (window.location.href.indexOf('plugins.php') === -1) {
            return;
        }

        // Wait for the thickbox to be initialized
        $(document).on('tb_init', function() {
            // Set a timeout to allow the thickbox content to load
            setTimeout(function() {
                // Get the thickbox iframe
                const $iframe = $('#TB_iframeContent');
                if (!$iframe.length) return;

                // Wait for iframe to load
                $iframe.on('load', function() {
                    try {
                        const iframeDoc = this.contentDocument || this.contentWindow.document;

                        // Get the plugin title from the iframe
                        const $title = $(iframeDoc).find('h2.plugin-title');
                        if (!$title.length) return;

                        // Check if this is our plugin
                        const titleText = $title.text();
                        if (titleText.indexOf('Fix \'Plugin file does not exist\' Notices') !== -1) {
                            console.log('Found our plugin in the details popup, fixing version...');

                            // Find the version element
                            const $version = $(iframeDoc).find('.plugin-version-author-uri');
                            if ($version.length) {
                                // Update the version text
                                const versionText = $version.text();
                                const newVersionText = versionText.replace(/Version: [0-9.]+|Version: 0\.0\.0/, 'Version: ' + CURRENT_VERSION);
                                $version.text(newVersionText);
                                console.log('Updated version to: ' + CURRENT_VERSION);
                            }

                            // Also update the version in the header if it exists
                            const $versionHeader = $(iframeDoc).find('.wrap h2:contains("Version:")');
                            if ($versionHeader.length) {
                                $versionHeader.text('Version: ' + CURRENT_VERSION);
                                console.log('Updated version header to: ' + CURRENT_VERSION);
                            }
                        }
                    } catch (e) {
                        console.error('Error updating plugin version:', e);
                    }
                });
            }, 500);
        });
    }

    // Initialize when the document is ready
    $(document).ready(function() {
        fixPluginDetailsVersion();
    });

})(jQuery);
