(function() {
    // Function to inject our notice
    function injectNotice() {
        // Find all notification containers first
        var noticeContainers = document.querySelectorAll('.notice, .error, .updated');

        // Find all error notifications about missing plugins
        noticeContainers.forEach(function(notice) {
            if (notice.textContent.includes('Plugin file does not exist') ||
                notice.textContent.includes('has been deactivated due to an error')) {

                // Check if we already added our notice
                if (notice.nextElementSibling && notice.nextElementSibling.classList.contains('prc-notice')) {
                    return;
                }

                // Create our custom notice
                var ourNotice = document.createElement('div');
                ourNotice.className = 'prc-notice';

                // Add content (using localized strings passed via wp_localize_script if needed, but simple for now)
                ourNotice.innerHTML = '<h3 style="margin-top:0;color:#826200;">👉 Fix Plugin Does Not Exist Notices Can Fix This</h3>' +
                    '<p>To remove the above error notification, scroll down to find the plugin marked with "<strong style="color:red">(File Missing)</strong>" and click its "<strong>Remove Reference</strong>" link.</p>' +
                    '<p>This will permanently remove the missing plugin reference from your database.</p>' +
                    '<p><a href="#" id="prc-scroll-to-plugin" style="font-weight:bold;text-decoration:underline;color:#826200;">Click here to scroll to the missing plugin</a></p>';

                // Insert our notice right after the error
                notice.parentNode.insertBefore(ourNotice, notice.nextSibling);

                // Add scroll behavior
                var scrollLink = document.getElementById('prc-scroll-to-plugin');
                if (scrollLink) {
                    scrollLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        var missingPlugins = document.querySelectorAll('tr.inactive:not(.plugin-update-tr)');
                        for (var i = 0; i < missingPlugins.length; i++) {
                            if (missingPlugins[i].textContent.includes('(File Missing)')) {
                                // Add a class for highlighting instead of direct style manipulation
                                missingPlugins[i].classList.add('prc-highlight-missing');
                                missingPlugins[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                                // Optional: Remove highlight after a delay
                                setTimeout(function() {
                                    missingPlugins[i].classList.remove('prc-highlight-missing');
                                }, 3000); // Remove highlight after 3 seconds
                                return;
                            }
                        }
                    });
                }
            }
        });
    }

    // Try to inject notices on multiple events to ensure it works
    document.addEventListener('DOMContentLoaded', function() {
        injectNotice();

        // Also set up a MutationObserver to watch for dynamically added notices
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes && mutation.addedNodes.length > 0) {
                    // Check if added nodes are notices or contain notices
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && (node.matches('.notice, .error, .updated') || node.querySelector('.notice, .error, .updated'))) {
                            injectNotice();
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

})();
