jQuery(document).ready(function($){

	var jihadcframework_upload;
	var jihadcframework_selector;

	function jihadcframework_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		jihadcframework_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( jihadcframework_upload ) {
			jihadcframework_upload.open();
		} else {
			// Create the media frame.
			jihadcframework_upload = wp.media.frames.jihadcframework_upload =  wp.media({
				// Set the title of the modal.
				title: $el.data('choose'),

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: $el.data('update'),
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			jihadcframework_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = jihadcframework_upload.state().get('selection').first();
				jihadcframework_upload.close();
				jihadcframework_selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					jihadcframework_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast');
				}
				jihadcframework_selector.find('.upload-button').unbind().addClass('remove-file').removeClass('upload-button').val(jihadcframework_l10n.remove);
				jihadcframework_selector.find('.of-background-properties').slideDown();
				jihadcframework_selector.find('.remove-image, .remove-file').on('click', function() {
					jihadcframework_remove_file( $(this).parents('.section') );
				});
			});

		}

		// Finally, open the modal.
		jihadcframework_upload.open();
	}

	function jihadcframework_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind().addClass('upload-button').removeClass('remove-file').val(jihadcframework_l10n.upload);
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button').remove();
		}
		selector.find('.upload-button').on('click', function(event) {
			jihadcframework_add_file(event, $(this).parents('.section'));
		});
	}

	$('.remove-image, .remove-file').on('click', function() {
		jihadcframework_remove_file( $(this).parents('.section') );
    });

    $('.upload-button').click( function( event ) {
    	jihadcframework_add_file(event, $(this).parents('.section'));
    });

});