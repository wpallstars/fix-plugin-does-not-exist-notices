/**
 * Update Source Selector
 *
 * Handles the UI for selecting which source to use for plugin updates.
 */
jQuery(document).ready(function($) {
    // Open modal when toggle is clicked
    $(document).on('click', '.fpden-update-source-toggle', function(e) {
        e.preventDefault();

        // Add overlay
        $('body').append('<div id="fpden-modal-overlay"></div>');
        $('#fpden-modal-overlay').css({
            'position': 'fixed',
            'top': 0,
            'left': 0,
            'width': '100%',
            'height': '100%',
            'background-color': 'rgba(0,0,0,0.5)',
            'z-index': 100000
        });

        // Position and show modal
        var modal = $('#fpden-update-source-modal');
        modal.css({
            'position': 'fixed',
            'top': '50%',
            'left': '50%',
            'transform': 'translate(-50%, -50%)',
            'background-color': '#fff',
            'padding': '20px',
            'border-radius': '5px',
            'box-shadow': '0 0 10px rgba(0,0,0,0.5)',
            'z-index': 100001,
            'width': '400px',
            'max-width': '90%'
        }).show();

        // Add close button styles
        $('.fpden-close-modal').css({
            'position': 'absolute',
            'top': '10px',
            'right': '10px',
            'cursor': 'pointer',
            'font-size': '20px',
            'color': '#666'
        });
    });

    // Close modal when clicking overlay or close button
    $(document).on('click', '#fpden-modal-overlay', function() {
        $('#fpden-update-source-modal').hide();
        $('#fpden-modal-overlay').remove();
    });

    // Separate handler for close button to ensure it works
    $(document).on('click', '.fpden-close-modal', function(e) {
        e.preventDefault();
        $('#fpden-update-source-modal').hide();
        $('#fpden-modal-overlay').remove();
    });

    // Prevent clicks inside modal from closing it
    $('#fpden-update-source-modal').on('click', function(e) {
        e.stopPropagation();
    });

    // Handle form submission
    $('#fpden-update-source-form').on('submit', function(e) {
        e.preventDefault();

        var source = $('input[name="update_source"]:checked').val();

        // Show loading state
        var submitButton = $(this).find('button[type="submit"]');
        var originalText = submitButton.text();
        submitButton.text('Saving...').prop('disabled', true);

        // Save via AJAX
        $.post(ajaxurl, {
            action: 'fpden_save_update_source',
            source: source,
            nonce: fpdenData.updateSourceNonce
        }, function(response) {
            submitButton.text(originalText).prop('disabled', false);

            if (response.success) {
                // Update the badge
                var badgeText = source.charAt(0).toUpperCase() + source.slice(1);
                if (source === 'wordpress.org') {
                    badgeText = 'WP.org';
                }

                // Remove all badge classes and add the new one
                var badge = $('.fpden-update-source-toggle .fpden-source-badge');
                badge.removeClass('auto wordpress github gitea')
                     .addClass(source)
                     .text(badgeText);

                // Show success message
                var message = $('<div class="fpden-success-message">Update source saved successfully!</div>');
                message.css({
                    'color': 'green',
                    'margin-top': '10px',
                    'text-align': 'center'
                });

                $('#fpden-update-source-form').append(message);

                // Hide message and modal after delay
                setTimeout(function() {
                    message.fadeOut(function() {
                        $(this).remove();
                        $('#fpden-update-source-modal').hide();
                        $('#fpden-modal-overlay').remove();
                    });
                }, 1500);
            } else {
                // Show error message
                var message = $('<div class="fpden-error-message">Error saving update source.</div>');
                message.css({
                    'color': 'red',
                    'margin-top': '10px',
                    'text-align': 'center'
                });

                $('#fpden-update-source-form').append(message);

                // Hide message after delay
                setTimeout(function() {
                    message.fadeOut(function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    });
});
