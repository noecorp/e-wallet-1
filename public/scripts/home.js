jQuery(document).ready(function($){
	var windowWidth = $(window).innerWidth;
	var windowHeight = $(window).height();
	var homeNavBarHeight = $('.home-navbar').height();

	$('.window-width').width(windowWidth);
	$('.window-height').css('min-height',windowHeight - homeNavBarHeight -2+'px');

	$('a[rel=goToPanel]').click(function (e) {
		console.log("click");
		var targetPanel = $(this).attr("href");
		$('body,html').animate({
			scrollTop: $(targetPanel).offset().top + "px"
		}, 500);
		e.preventDefault();
	});
});