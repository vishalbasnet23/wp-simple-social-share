(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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
	$(function(){
		$( 'body' ).on( 'click', 'a.social-share-pop-up-button', function(e) {
			e.preventDefault();
			var width = 600;
			var height = 400;
			var shareUrl = $(this).data( 'url' );
			var popUpName = $(this).data('servicename');
			var popupWindow = window.open( shareUrl, popUpName || 'window' + Math.floor( Math.random() * 10000 + 1 ), 'menubar=0,location=0,toolbar=0,status=0,scrollbars=1, width='+width+',height='+height );
			if( window.focus ) {
				popupWindow.focus;
			}
		});
		var isMobile = {
		    Android: function() {
		        return navigator.userAgent.match(/Android/i);
		    },
		    BlackBerry: function() {
		        return navigator.userAgent.match(/BlackBerry/i);
		    },
		    iOS: function() {
		        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		    },
		    Opera: function() {
		        return navigator.userAgent.match(/Opera Mini/i);
		    },
		    Windows: function() {
		        return navigator.userAgent.match(/IEMobile/i);
		    },
		    any: function() {
		        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		    }
		};
		console.log(isMobile.any());
		if( isMobile.any() === null ) {
			console.log('here');
			$( '.whatsapp-mobile-only' ).remove();
		}
		$('.has-social-share').parent('div').addClass('has-social-share-image-wrapper');
	});

})( jQuery );
