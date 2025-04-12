(function() {
    // Track if we've already added our notice
    var noticeAdded = false;

    // Function to inject our notice
    function injectNotice() {
        // If we've already added a notice, don't add another one
        if (noticeAdded) {
            return;
        }

        // Find all notification containers first
        var noticeContainers = document.querySelectorAll('.notice, .error, .updated, div.error');
        var targetNotice = null;

        // Find all error notifications about missing plugins
        noticeContainers.forEach(function(notice) {
            if ((notice.textContent.includes('Plugin file does not exist') ||
                notice.textContent.includes('has been deactivated due to an error')) &&
                (notice.classList.contains('error') || notice.classList.contains('notice-error'))) {
                // We'll use the last matching notice as our target
                targetNotice = notice;
                console.log('Found WordPress error notice:', notice.textContent);
            }
        });

        // If we didn't find a specific error notice, look for the general WordPress error at the top
        if (!targetNotice) {
            // Try to find the WordPress error message at the top of the page
            var wpError = document.querySelector('.error:not(.below-h2), div.error:not(.below-h2), .notice-error:not(.below-h2)');
            if (wpError) {
                targetNotice = wpError;
                console.log('Found general WordPress error notice');
            }
        }

        // If we found a target notice, add our custom notice after it
        if (targetNotice) {
            // Check if we already added our notice
            if (targetNotice.nextElementSibling && targetNotice.nextElementSibling.classList.contains('prc-notice')) {
                return;
            }

            // Create our custom notice
            var ourNotice = document.createElement('div');
            ourNotice.className = 'prc-notice';

            // Add content using localized strings passed via wp_localize_script
            var pluginMissingText = typeof fpdenData !== 'undefined' && fpdenData.i18n && fpdenData.i18n.pluginMissing ?
                fpdenData.i18n.pluginMissing : 'File Missing';
            var removeNoticeText = typeof fpdenData !== 'undefined' && fpdenData.i18n && fpdenData.i18n.removeNotice ?
                fpdenData.i18n.removeNotice : 'Remove Notice';
            var clickToScrollText = typeof fpdenData !== 'undefined' && fpdenData.i18n && fpdenData.i18n.clickToScroll ?
                fpdenData.i18n.clickToScroll : 'Click here to scroll to and highlight missing plugins';

            ourNotice.innerHTML = '<h3 style="margin-top:0;color:#826200;">Fix Plugin Does Not Exist Notices 👆</h3>' +
                '<p>To remove these notices, scroll down to each plugin\'s row showing: plugin-name.php "<strong style="color:red">(' + pluginMissingText + ')</strong>". Then, click the "<strong>' + removeNoticeText + '</strong>" link for that plugin.</p>' +
                '<p>This safely removes the missing active plugin reference from your database, using the standard WordPress function to update your active plugin options table, to leave the remaining plugins installed and active.</p>' +
                '<p><a href="#" id="prc-scroll-to-plugin" style="font-weight:bold;text-decoration:underline;color:#826200;">' + clickToScrollText + '</a></p>';

            // Insert our notice right after the error
            targetNotice.parentNode.insertBefore(ourNotice, targetNotice.nextSibling);

            // Make sure our notice has the same width as the WordPress error notice
            ourNotice.style.width = targetNotice.offsetWidth + 'px';
            ourNotice.style.maxWidth = '100%';
            ourNotice.style.boxSizing = 'border-box';

            // Mark that we've added our notice
            noticeAdded = true;

            // Add scroll behavior
            var scrollLink = document.getElementById('prc-scroll-to-plugin');
            if (scrollLink) {
                scrollLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Look for all plugin rows, not just inactive ones
                    var allPluginRows = document.querySelectorAll('tr.active, tr.inactive');
                    for (var i = 0; i < allPluginRows.length; i++) {
                        if (allPluginRows[i].textContent.includes('(File Missing)')) {
                            // Add a class for highlighting instead of direct style manipulation
                            allPluginRows[i].classList.add('prc-highlight-missing');
                            allPluginRows[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                            // Optional: Remove highlight after a delay
                            (function(row) {
                                setTimeout(function() {
                                    row.classList.remove('prc-highlight-missing');
                                }, 3000); // Remove highlight after 3 seconds
                            })(allPluginRows[i]);
                            return;
                        }
                    }
                });
            }
        }
    }

    // Try to inject notices on multiple events to ensure it works
    document.addEventListener('DOMContentLoaded', function() {
        // Delay the initial injection to ensure WordPress has fully loaded its notices
        setTimeout(injectNotice, 100);

        // Also set up a MutationObserver to watch for dynamically added notices
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes && mutation.addedNodes.length > 0) {
                    // Check if added nodes are notices or contain notices
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && (node.matches('.notice, .error, .updated, div.error') || node.querySelector('.notice, .error, .updated, div.error'))) {
                            setTimeout(injectNotice, 50); // Small delay to ensure the DOM is updated
                        }
                    });
                }
            });
        });

        // Start observing the body for changes in children
        observer.observe(document.body, { childList: true, subtree: true });
    });

    // Backup attempt with window.onload (less reliable than DOMContentLoaded but good fallback)
    window.addEventListener('load', function() {
        setTimeout(injectNotice, 500); // Delay slightly to ensure dynamic content is loaded
    });

    // Additional attempt after a longer delay to catch late-loading notices
    window.addEventListener('load', function() {
        setTimeout(injectNotice, 1000); // Longer delay as final attempt
    });

})();
