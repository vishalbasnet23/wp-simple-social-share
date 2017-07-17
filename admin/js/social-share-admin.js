(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$( function() {
		$( '#social-share-sortable' ).sortable();
		$( '#social-share-sortable' ).disableSelection();

		$( 'body' ).on( 'click', 'input[name="toptal_social_share_options[button_size]"]', function() {
			var selectedValue = $(this).val();
			$( 'label.social-share-icon' ).removeClass( 'small-icon medium-icon large-icon' ).addClass( selectedValue+'-icon' );
		} );

		$( 'body' ).on( 'click', 'input[name="toptal_social_share_options[button_style]"]', function() {
			var selectedValue = $(this).val();
			$( 'label.social-share-icon' ).removeClass( 'grayscale colored' ).addClass( selectedValue );
		} );
	});
})( jQuery );
