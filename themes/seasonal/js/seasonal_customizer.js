jQuery(document).ready(function() {

	/* Upsells in customizer (Documentation, Reviews and Support links */
	if( !jQuery( ".seasonal-info" ).length ) {
		
		jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section seasonal-info">');
	
		jQuery('.seasonal-info').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://www.shapedpixels.com/setup-seasonal/" class="button" target="_blank">{setup}</a>'.replace('{setup}', seasonalCustomizerObject.setup));
		
		jQuery('.seasonal-info').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/view/theme-reviews/seasonal" class="button" target="_blank">{review}</a>'.replace('{review}', seasonalCustomizerObject.review));
		
		jQuery('.seasonal-info').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/theme/seasonal" class="button" target="_blank">{support}</a>'.replace('{support}', seasonalCustomizerObject.support));
		
		jQuery('.seasonal-info').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://www.shapedpixels.com/themes/seasonal-pro/?utm_source=FreeThemes&utm_medium=CustomizerLink&utm_campaign=Seasonal" class="button" target="_blank">{pro}</a>'.replace('{pro}',seasonalCustomizerObject.pro));

		jQuery('#customize-theme-controls > ul').prepend('</li>');
	}
	
});