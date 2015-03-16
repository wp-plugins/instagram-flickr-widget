;(function($, window, document, undefined){

	"use strict";

	function pi_ip_magnific()
	{
		$('.pi_ip_widget.pi_popup').magnificPopup(
		{
			delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			}
		});
	}

	function pi_instagram_cycle()
	{
		
	}

	$(document).ready(function()
	{
		pi_ip_magnific();
	})

	$(window).load(function()
	{
		pi_instagram_cycle();
	})

})(jQuery, window, document);