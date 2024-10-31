jQuery(document).ready(function(){

	// Send email
	jQuery("#wooe_send_email").on('click', function(e){

		e.preventDefault();

		var to = jQuery('#wooe_to').val();
		var reply_to_name = jQuery('#wooe_reply_to_name').val();
		var reply_to_email = jQuery('#wooe_reply_to_email').val();
		var subject = jQuery('#wooe_subject').val();
		var heading = jQuery('#wooe_heading').val();
		var iFrameDOM = jQuery('iframe#wooe_message_ifr').contents();
		var message;
		if( jQuery('#wooe_message').is(':visible') ){
			message = jQuery('#wooe_message').val();
		} else {
			message = iFrameDOM.find('#tinymce.wooe_message').html();
		}

		var $response = jQuery("#wooe_ajax_res_send_email");
		$response.fadeIn();
		$response.text('Sending one-off email...');

		var data = {
			'data': {
				'to': to,
				'reply_to_name': reply_to_name,
				'reply_to_email': reply_to_email,
				'subject': subject,
				'heading': heading,
				'message': message
			},
			'action': 'wooe_sendemail',
			'nonce': wooe.nonce
		};
		jQuery.post(
			wooe.ajaxurl,
			data
		)
		.done(function( data ){
			data = JSON.parse(data);

			// If the response contains an error.
			if( data.error && data.error.length > 0 ) {
				$response.text("There was an error: " + data.error);
				return;
			}

			// Clear fields on front end.
			jQuery('#wooe_to').val('');
			jQuery('#wooe_reply_to_name').val('');
			jQuery('#wooe_reply_to_email').val('');
			jQuery('#wooe_subject').val('');
			jQuery('#wooe_heading').val('');
			iFrameDOM.find('#tinymce.wooe_message').html('');
			jQuery('#wooe_preview_window').html('');

			$response.text("Email sent successfully!");
		})
		.fail(function( data ){
			$response.text('An unexpected error occurred. Please try again.');
		})
		.always(function( data ){
			setTimeout(function(){
				$response.fadeOut();
			}, 5000);
		});
	});

	// Preview email
	jQuery("#wooe_preview_email").on('click', function(e){

		e.preventDefault();

		var heading = jQuery('#wooe_heading').val();
		var iFrameDOM = jQuery('iframe#wooe_message_ifr').contents();
		var message;
		if( jQuery('#wooe_message').is(':visible') ){
			message = jQuery('#wooe_message').val();
		} else {
			message = iFrameDOM.find('#tinymce.wooe_message').html();
		}

		jQuery('#tinymce').fadeOut();
		setTimeout(function(){
			jQuery('#tinymce').fadeIn();
		}, 2000);

		var $response = jQuery("#wooe_preview_window");
		$response.fadeIn();
		$response.text('Generating email preview...');

		var data = {
			'data': {
				'heading': heading,
				'message': message
			 },
			'action': 'wooe_previewemail',
			'nonce': wooe.nonce
		};
		jQuery.post(
			wooe.ajaxurl,
			data
		)
		.done(function( data ){
			data = JSON.parse(data);

			// If the response contains an error.
			if( data.error && data.error.length > 0 ) {
				$response.text("There was an error: " + data.error);
				return;
			}

			$response.html(data.result);
		})
		.fail(function( data ){
			$response.text('An unexpected error occurred. Please try again.');
			setTimeout(function(){
				$response.fadeOut();
			}, 5000);
		});
	});

});