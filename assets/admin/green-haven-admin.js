/* global jQuery, wp */

( function ( $ ) {
	'use strict';

	$( document ).ready( function () {

		// Initialize WordPress color picker.
		$( '.green-haven-color-picker' ).wpColorPicker();

		// ── Image uploader ────────────────────────────────────────────────
		$( '.green-haven-upload-image' ).on( 'click', function ( e ) {
			e.preventDefault();

			var button       = $( this );
			var input        = button.siblings( '.green-haven-image-url' );
			var preview      = button.siblings( '.green-haven-image-preview' );
			var removeButton = button.siblings( '.green-haven-remove-image' );

			var mediaUploader = wp.media( {
				title:    'Choose Image',
				button:   { text: 'Use This Image' },
				multiple: false,
			} );

			mediaUploader.on( 'select', function () {
				var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();

				input.val( attachment.url );

				preview.html(
					'<img src="' + attachment.url + '" alt="Title Background Image" style="max-width: 250px; height: auto; display: block;">'
				);

				removeButton.show();
			} );

			mediaUploader.open();
		} );

		// ── Remove image ──────────────────────────────────────────────────
		$( '.green-haven-remove-image' ).on( 'click', function ( e ) {
			e.preventDefault();

			var button  = $( this );
			var input   = button.siblings( '.green-haven-image-url' );
			var preview = button.siblings( '.green-haven-image-preview' );

			input.val( '' );
			preview.html( '' );
			button.hide();
		} );

		// ── Add Follow Us field ───────────────────────────────────────────
		$( '#green-haven-add-follow-us' ).on( 'click', function ( e ) {
			e.preventDefault();

			var wrapper    = $( '#green-haven-follow-us-wrapper' );
			var totalItems = wrapper.find( '.green-haven-follow-us-item' ).length;

			if ( totalItems >= 4 ) {
				alert( 'Maximum 4 fields allowed.' );
				return;
			}

			var index = Date.now();
			var html  = '';

			html += '<div class="green-haven-follow-us-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ccd0d4;">';

			html += '<input ';
			html += 'type="url" ';
			html += 'name="green_haven_footer_options[footer_follow_us_type][' + index + '][text]" ';
			html += 'class="regular-text" ';
			html += 'placeholder="Enter social URL">';

			html += '<br>';

			html += '<select ';
			html += 'name="green_haven_footer_options[footer_follow_us_type][' + index + '][icon]" ';
			html += 'class="green-haven-follow-us-icon" ';
			html += 'style="margin-top: 10px;">';
			html += '<option value="">Select Icon</option>';
			html += '<option value="facebook">Facebook</option>';
			html += '<option value="youtube">YouTube</option>';
			html += '<option value="linkedin">LinkedIn</option>';
			html += '<option value="instagram">Instagram</option>';
			html += '</select>';

			html += '<span class="dashicons green-haven-icon-preview" style="margin-left: 10px; margin-top: 12px;"></span>';

			html += '<br>';

			html += '<button type="button" class="button green-haven-remove-follow-us" style="margin-top: 10px;">Remove</button>';

			html += '</div>';

			wrapper.append( html );
		} );

		// ── Remove Follow Us field ────────────────────────────────────────
		$( document ).on( 'click', '.green-haven-remove-follow-us', function ( e ) {
			e.preventDefault();
			$( this ).closest( '.green-haven-follow-us-item' ).remove();
		} );

		// ── Dashicon preview on icon select change ────────────────────────
		$( document ).on( 'change', '.green-haven-follow-us-icon', function () {
			var selectedIcon = $( this ).val();
			var iconPreview  = $( this ).siblings( '.green-haven-icon-preview' );

			iconPreview.removeClass( 'dashicons-facebook-alt dashicons-youtube dashicons-linkedin dashicons-instagram' );

			if ( 'facebook' === selectedIcon ) {
				iconPreview.addClass( 'dashicons-facebook-alt' );
			}

			if ( 'youtube' === selectedIcon ) {
				iconPreview.addClass( 'dashicons-youtube' );
			}

			if ( 'linkedin' === selectedIcon ) {
				iconPreview.addClass( 'dashicons-linkedin' );
			}

			if ( 'instagram' === selectedIcon ) {
				iconPreview.addClass( 'dashicons-instagram' );
			}
		} );

	} );

} ( jQuery ) );