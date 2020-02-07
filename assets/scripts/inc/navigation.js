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

		// Code taken from https://github.com/WordPress/twentytwenty
		var focusMenuWithChildren = function() {
			// Get all the link elements within the primary menu.
			var links, i, len,
				menu = document.querySelector('.menu-primary-container');

			if (!menu) {
				console.log(menu);
				return false;
			}

			links = menu.getElementsByTagName('a');

			// Each time a menu link is focused or blurred, toggle focus.
			for (i = 0, len = links.length; i < len; i++) {
				links[i].addEventListener('focus', toggleFocus, true);
				links[i].addEventListener('blur', toggleFocus, true);
			}

			// Sets or removes the .focus class on an element.
			function toggleFocus() {
				var self = this;

				// Move up through the ancestors of the current link until we hit .primary-menu.
				while (-1 === self.className.indexOf('menu')) {
					// On li elements toggle the class .focus.
					if ('li' === self.tagName.toLowerCase()) {
						if (-1 !== self.className.indexOf('focus')) {
							self.className = self.className.replace(' focus', '');
						} else {
							self.className += ' focus';
						}
					}
					self = self.parentElement;
				}
			}
		}

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
			focusMenuWithChildren();
			buildDropdownArrow();
			events();
		};

		return {
			init: initialiseDropdown
		};
	})();

	mobileDropdown.init();
});