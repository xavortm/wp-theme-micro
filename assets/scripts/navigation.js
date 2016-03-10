jQuery( document ).ready( function ( $ ) {
	'use strict';

	/**
	 * The actual plugin for mobile dropdown
	 */
	var mobileDropdown = (function () {

		var settings = {
			heightHeader: 80,
			heightAdminbar: 50
		};

		// The selector variables.
		var selector = {
			menuIcon: $( ".menu-toggle" ),
			dropdownArrow: $( "span.dropdown-arrow" ),
			menuNav: $('.main-navigation'),
			wavesButtonSelector: '.button'
		};

		var events = function () {

			// When header is clicked.
			selector.menuIcon.on( 'click', openMenu );


			// Dropdown menu links
			$('li.menu-item-has-children').on( 'click', $(this).closest('span.dropdown-arrow'), openDropdownMenu );

		};

		var openMenu = function ( event ) {
			var headerHeight = settings.heightHeader;
			var adminbarHeight = settings.heightAdminbar;

			// No need for this when you are not logged in.
			if ( ! $("body").hasClass("admin-bar") ) {
				adminbarHeight = 0;
			}

			// Change button state
			$( this ).toggleClass( 'is-opened' );

			// Open the main menu.
			selector.menuNav.toggleClass( 'is-extended' ).removeClass('init');
			// selector.menuNav.height( $(window).height() - headerHeight - adminbarHeight );

			$('body').toggleClass( 'is-menu-opened' );
		};

		var openDropdownMenu = function ( event ) {
			event.stopImmediatePropagation(); // Fix issue with double clicking.
			$(this).toggleClass( "is-extended" );
		};

		var buildDropdownArrow = function () {
			$('.menu-item-has-children').each(function() {
				$(this).append("<span class='dropdown-arrow'><i class='fa fa-angle-right'></i></span>");
			});
		};

		/**
		 * Run the dropdown menu.
		 */
		var initialiseDropdown = function() {
			buildDropdownArrow();
			events();
		};

		return {
			init: initialiseDropdown
		};
	})();

	mobileDropdown.init();
});