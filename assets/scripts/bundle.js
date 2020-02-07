
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
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

jQuery( document ).ready( function ( $ ) {
	'use strict';
	/*
	|--------------------------------------------------------------------------
	| Developer mode
	|--------------------------------------------------------------------------
	|
	| Set to true - it will allow printing in the console. Alsways check for this
	| variables when running tests so you dont forget about certain console.logs.
	| Id needed for development testing this variable should be used.
	|
	*/
	var devMode = function() {
		return true;
	};

	// Disable console.log for production site.
	if ( ! devMode() ) {
		console.log = function() {};
	}

});