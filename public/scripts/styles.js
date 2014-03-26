(function() {
	
	var headerNavList = $('#header-nav-list');
	var headerNavItems = $('.header-nav-item');
	var headerTextContainer = $('#header-text-container');
	var mobileMenuNavToggleButton = $('#menu-icon-container');

	mobileMenuNavToggleButton.click(function(event) {
		if(isHeaderNavListHidden()) {
			showHeaderNavList();
		} else {
			hideHeaderNavList();
		}
	});

	headerNavItems.click(function(event) {
		event.preventDefault();
		event.stopImmediatePropagation();

		window.location = $(this).find('a').attr('href');
	});

	headerTextContainer.click(function(event) {
		window.location = '/';
	});

	window.onresize = function() {

	    var windowWidth = (
	    	window.innerWidth || 
	    	document.documentElement.clientWidth || 
	    	document.getElementsByTagName('body')[0].clientWidth
    	);

	    if(windowWidth > 767 && isHeaderNavListHidden()) {
	    	showHeaderNavList();
	    }

	};

	var isHeaderNavListHidden = function() {
		return headerNavList[0].style.display == 'none' || headerNavList[0].style.display == '';
	};

	var showHeaderNavList = function() {
		headerNavList.show();
	};

	var hideHeaderNavList = function() {
		headerNavList.hide();
	};

	// smoothes nav sizes
	window.setTimeout(function() {
		$('.pre-load-selected').removeClass('pre-load-selected').addClass('post-load-selected');
	}, 50);

})();