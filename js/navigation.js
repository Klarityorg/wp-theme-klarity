(function($) {
	$('.menu-item-has-children > a').click(function(e) {
		e.preventDefault();
	});

	function showSubMenu(element) {
		if (!$(element).hasClass('animating')) {
			const submenu = $(element).children('.sub-menu');
			if (submenu.is(':hidden')) {
				const submenuHeight = submenu.height();
				$(element).addClass('animating expanded');
				submenu.slideDown(200);
				$(element).animate({"height": "+=" + submenuHeight + "px"}, 200, function () {
					$(element).height(45 + submenuHeight).removeClass('animating');
				});
			}
		}
	}

	function hideSubMenu(element) {
		if (!$(element).hasClass('animating')) {
			const submenu = $(element).children('.sub-menu');
			if (!submenu.is(':hidden')) {
				const submenuHeight = submenu.height();
				$(element).addClass('animating').removeClass('expanded');
				submenu.slideUp(200);
				$(element).animate({"height": "-=" + submenuHeight + "px"}, 200, function () {
					$(element).height(45).removeClass('animating');
				});
			}
		}
	}

	$('.nav-wrapper li > .sub-menu').parent()
		.on('click', function (e) {
			if ($(this).children('.sub-menu').is(':hidden')) {
				showSubMenu(this);
			} else {
				hideSubMenu(this);
			}
			e.stopPropagation();
			e.preventDefault();
		})
		.on('mouseleave', function() { hideSubMenu($(this));})
		.on('mouseenter', function() { showSubMenu($(this));});
	$('.nav-wrapper li > .sub-menu').hide();
})( jQuery );

(function($){
  $(function(){
    $('.sidenav').sidenav({edge: 'right'});
  }); // end of document ready
})(jQuery); // end of jQuery name space
