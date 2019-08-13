/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	$('.tooltip').tooltipster();

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	/* Homepage Location */
	$(document).on("click","#locationlist a.name",function(e){
		e.preventDefault();
		$(this).parents('li').toggleClass('open');
	});

	$(document).on("click",".contact-section li.gfield",function(e){
		if( $(this).find('span.name_first').length ) {
			return false;
		} else {
			$(this).find("label").addClass('hide');
		}
	});

	$(document).on("click",".contact-section span.name_first, .contact-section span.name_last",function(e){
		$(this).find('label').addClass('hide');
	});

	$(document).on("blur focusout",'.contact-section span.name_first, .contact-section span.name_last',function(e){
		var parent = $(this);
		var str = $(this).find('input').val();
			str = StrtoSlug(str);
			if(str=='') {
				parent.find('label').removeClass('hide');
				$(this).val("");
			}
	});

	$(document).on("blur focusout",'.contact-section input[type="text"],.contact-section input[type="email"],.contact-section textarea',function(e){
		var parent = $(this).parents("li");
		var div = parent.find('.ginput_container');
		var str = $(this).val();
			str = StrtoSlug(str);

		if( div.hasClass('ginput_container_phone') ) {
			if( str=='(___)___-____' ) {
				parent.find('label').removeClass('hide');
				$(this).val("");
			}
			if(str=='') {
				parent.find('label').removeClass('hide');
				$(this).val("");
			}
		} else {

			if( parent.find('span.name_first').length ) {
				

			} else {
				if(str=='') {
					parent.find('label').removeClass('hide');
					$(this).val("");
				}
			}
			
		}
	});

	$(document).on("click","#toggleMenu",function(){
		$(this).toggleClass('open');
		$('.main-navigation').toggleClass('show');
		$("#primary-menu").slideToggle();
	});

	/* Testimonials */
	$('#testimonials').flexslider({
		animation: "slide",
		animationLoop: false,
		directionNav: true,
		itemMargin: 5,
		minItems: 1
	});

	function StrtoSlug(string) {
		var str = string.replace(/\s/g,'');
		str = str.toLowerCase();
		return str;
	} 

	/* MAPS  */
	// $(".mapinfo").hover(
	// 	function(){
	// 		$(".basemap").addClass('invisible');
	// 		var mapId = $(this).attr('data-map');
	// 		if( $(mapId).length ) {
	// 			$(mapId).addClass('active');
	// 		}
	// 	}, function() {
	// 		$(".basemap").removeClass('invisible');
	// 		var mapId = $(this).attr('data-map');
	// 		if( $(mapId).length ) {
	// 			$(mapId).removeClass('active');
	// 		}
	// 	}
	// );

	$(document).on("click",".mapinfo", function(){
		var baseMap = $(".basemap");
		var useMap = baseMap.attr('data-default');
		baseMap.addClass('invisible');
		baseMap.attr('usemap','');
		$(".mapinfo").removeClass('active');
		$(this).addClass('active');
		var mapId = $(this).attr('data-map');
		if( $(mapId).length ) {
			$(".maphover").removeClass('active');
			$(".maphover").attr('usemap',''); 
			$(mapId).addClass('active');
			$(mapId).attr('usemap',useMap);
		}
	});

	/* Clicking Map Area */
	$('#themaps area').each(function(){
		var mapName = $(this).attr('data-mapname');
		$(this).addClass('tooltip');
		$(this).attr('alt',mapName);
		$(this).attr('title',mapName);
		$(this).tooltipster();
	});

	/* Remove Active Location */
	$(document).on('click', function (e) {
		var locationsDiv = "#locations";
	    if ($(e.target).closest(locationsDiv).length === 0) {
			$(".basemap").removeClass('invisible');
			$(".mapinfo").removeClass('active');
			$(".maphover").removeClass('active');
	    }
	});

});// END #####################################    END