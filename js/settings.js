/**
 * Munsa JavaScript file.
 *
 * Set up the navigation and sidebar toggles.
 */
( function( $ ) {
	
	var body, page, scrollUp, scrollToContent, mainNav, mainNavWrap, primarySidebar, primarySidebarWrap, menuButton, menuToggle, sidebarButton, sidebarToggle;
	
	// Set up vars.
	page               = $( '#site-wrapper' );
	scrollUp           = page.find( '#scroll-up' );
	scrollToContent    = page.find( '#scroll-to-content' );
	mainNav            = page.find( '#menu-primary' );
	mainNavWrap        = page.find( '#menu-primary .wrap' );
	primarySidebar     = page.find( '#sidebar-primary' );
	primarySidebarWrap = page.find( '#sidebar-primary .wrap' );
	menuButton         = page.find( '#menu-button' );
	menuToggle         = page.find( '.main-navigation-toggle' );
	sidebarButton      = page.find( '#sidebar-button' );
	sidebarToggle      = page.find( '.sidebar-primary-toggle' );
	
	// Preload page and fade the content.
	$( window ).load( function() { // makes sure the whole site is loaded
		$( '#status' ).fadeOut(); // will first fade out the loading animation
		$( '#preloader' ).delay( 350 ).fadeOut( 'slow' ); // will fade out the white DIV that covers the website.
	});
	
	// Back to top.
	if ( scrollUp.length ) {
		smoothScroll.init({
			speed: 800,
			updateURL: false,
		});
	}
	
	// Scroll to content on Front Page Template.
	if ( scrollToContent.length ) {
		smoothScroll.init({
			speed: 800,
			updateURL: false,
		});
	}

	/**
	 * Set up the main navigation toggle. This sets
	 * up a toggle for navigation to overlay the window.
	 */
	( function() {
		
		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}
		
		// Add an initial values for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );
		mainNav.attr( 'aria-expanded', 'false' );
	
		menuToggle.on( 'click', function( event ) {
			
			// Toggle classes.
			$( 'html' ).toggleClass( 'disable-scroll' );
			$( 'body' ).toggleClass( 'main-navigation-open' );
			mainNav.toggleClass( 'open' );
			
			// Hide or show element after animation.
			if ( mainNav.hasClass( 'open' ) ) {
				
				$( mainNav ).css( 'display', 'block' );
				
				$( mainNav ).addClass( 'fadeIn' );
				$( mainNav ).removeClass( 'fadeOut' );
				$( mainNavWrap ).addClass( 'fadeInDown' );
				
				/**
				 * Handles keyboard navigation.
				 * We don't want to get lost inside menu unless we close the menu.
				 */
	
				// Set up focusable vars for menu.
				var focusableMainNav, firstFocusableMainNav, lastFocusableMainNav;
	
				// Get all, first and last focusable elements from the Menu.
				focusableMainNav      = mainNav.find( 'select, input, textarea, button, a' ).filter( ':visible' );
				firstFocusableMainNav = focusableMainNav.first();
				lastFocusableMainNav  = focusableMainNav.last();
	
				// Redirect last tab to first input.
				lastFocusableMainNav.on( 'keydown', function ( e ) {
					if ( ( e.keyCode === 9 && !e.shiftKey ) ) {
						e.preventDefault();
						firstFocusableMainNav.focus(); // Set focus on first element - that's actually close menu button.	
					}
				});

				// Redirect first shift+tab to last input.
				firstFocusableMainNav.on( 'keydown', function ( e ) {
					if ( ( e.keyCode === 9 && e.shiftKey ) ) {
						e.preventDefault();
						lastFocusableMainNav.focus(); // Set focus on last element.
					}
				});
				
			} else {
				
				setTimeout( function() {
					$( mainNav ).css( 'display', 'none' );
				}, 550 );
				
				$( mainNav ).addClass( 'fadeOut' );
				$( mainNav ).removeClass( 'fadeIn' );
				$( mainNavWrap ).removeClass( 'fadeInDown' );
				
				// Enable focus on toggle button.
				menuButton.focus();
				
			}
			
			// Change button text when opening and closing the menu.
			menuToggle.html( menuToggle.html() === MunsaLiteScreenReaderText.expandMenu ? MunsaLiteScreenReaderText.collapseMenu : MunsaLiteScreenReaderText.expandMenu );
			
			// If aria-expanded is false, set it to true. And vica versa.
			$( menuToggle ).attr( 'aria-expanded', $( menuToggle ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			$( mainNav ).attr( 'aria-expanded', $( mainNav ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		
		});
		
	} )();

	/**
	 * Set up the primary sidebar toggle. This sets
	 * up a toggle for sidebar to overlay the window.
	 */
	( function() {
		
		// Return early if sidebarToggle is missing.
		if ( ! sidebarToggle.length ) {
			return;
		}
		
		// Add an initial values for the attribute.
		sidebarToggle.attr( 'aria-expanded', 'false' );
		primarySidebar.attr( 'aria-expanded', 'false' );
	
		sidebarToggle.on( 'click', function( event ) {
			
			// Toggle classes.
			$( 'html' ).toggleClass( 'disable-scroll' );
			$( 'body' ).toggleClass( 'sidebar-primary-open' );
			primarySidebar.toggleClass( 'open' );
			
			// Hide or show element after animation.
			if ( primarySidebar.hasClass( 'open' ) ) {
				
				$( primarySidebar ).css( 'display', 'block' );
				
				$( primarySidebar ).addClass( 'fadeIn' );
				$( primarySidebar ).removeClass( 'fadeOut' );
				$( primarySidebarWrap ).addClass( 'fadeInDown' );
				$( primarySidebarWrap ).removeClass( 'fadeOutUp' );
				
				/**
				 * Handles keyboard navigation.
				 * We don't want to get lost inside menu unless we close the menu.
				 */
	
				// Set up focusable vars for sidebar.
				var focusableSidebar, firstFocusableSidebar, lastFocusableSidebar;
	
				// Get all, first and last focusable elements from the Menu.
				focusableSidebar      = primarySidebar.find( 'select, input, textarea, button, a' ).filter( ':visible' );
				firstFocusableSidebar = focusableSidebar.first();
				lastFocusableSidebar  = focusableSidebar.last();
	
				// Redirect last tab to first input.
				lastFocusableSidebar.on( 'keydown', function ( e ) {
					if ( ( e.keyCode === 9 && !e.shiftKey ) ) {
						e.preventDefault();
						firstFocusableSidebar.focus(); // Set focus on first element - that's actually close menu button.	
					}
				});

				// Redirect first shift+tab to last input.
				firstFocusableSidebar.on( 'keydown', function ( e ) {
					if ( ( e.keyCode === 9 && e.shiftKey ) ) {
						e.preventDefault();
						lastFocusableSidebar.focus(); // Set focus on last element.
					}
				});
				
			} else {
				
				setTimeout( function() {
					$( primarySidebar ).css( 'display', 'none' );
				}, 550 );
				
				$( primarySidebar ).addClass( 'fadeOut' );
				$( primarySidebar ).removeClass( 'fadeIn' );
				$( primarySidebarWrap ).addClass( 'fadeOutUp' );
				$( primarySidebarWrap ).removeClass( 'fadeInDown' );
				
				// Enable focus on toggle button.
				sidebarButton.focus();
				
			}
			
			// Change button text when opening and closing the sidebar.
			sidebarToggle.html( sidebarToggle.html() === MunsaLiteScreenReaderText.expandSidebar ? MunsaLiteScreenReaderText.collapseSidebar : MunsaLiteScreenReaderText.expandSidebar );
			
			// If aria-expanded is false, set it to true. And vica versa.
			$( sidebarToggle ).attr( 'aria-expanded', $( sidebarToggle ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			$( primarySidebar ).attr( 'aria-expanded', $( primarySidebar ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		
		});
		
	} )();

	/**
	 * Closes the main navigation or sidebar when
	 * the esc key is pressed.
	*/
	$( document ).keyup( function( event ) {
		if ( event.keyCode == 27 ) {
			if ( $( 'body' ).hasClass( 'main-navigation-open' ) ) {
				
				$( 'html' ).removeClass( 'disable-scroll' );
				$( 'body' ).removeClass( 'main-navigation-open' );
				mainNav.removeClass( 'open' );
				
				setTimeout( function() {
					$( mainNav ).css( 'display', 'none' );
				}, 550 );
				
				$( mainNav ).addClass( 'fadeOut' );
				$( mainNav ).removeClass( 'fadeIn' );
				$( mainNavWrap ).removeClass( 'fadeInDown' );
				
				// Change button text when closing the menu.
				menuToggle.html( menuToggle.html() === MunsaLiteScreenReaderText.expandMenu ? MunsaLiteScreenReaderText.collapseMenu : MunsaLiteScreenReaderText.expandMenu );
			
				// Enable focus on toggle button.
				menuButton.focus();
				
				// If aria-expanded is false, set it to true. And vica versa.
				$( menuToggle ).attr( 'aria-expanded', $( menuToggle ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				$( mainNav ).attr( 'aria-expanded', $( mainNav ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		
			} else if ( $( 'body' ).hasClass( 'sidebar-primary-open' ) ) {
				$( 'html' ).removeClass( 'disable-scroll' );
				$( 'body' ).removeClass( 'sidebar-primary-open' );
				primarySidebar.removeClass( 'open' );
				
				setTimeout( function() {
					$( primarySidebar ).css( 'display', 'none' );
				}, 550 );
				
				$( primarySidebar ).addClass( 'fadeOut' );
				$( primarySidebar ).removeClass( 'fadeIn' );
				$( primarySidebarWrap ).addClass( 'fadeOutUp' );
				$( primarySidebarWrap ).removeClass( 'fadeInDown' );
				
				// Change button text when closing the sidebar.
				sidebarToggle.html( sidebarToggle.html() === MunsaLiteScreenReaderText.expandSidebar ? MunsaLiteScreenReaderText.collapseSidebar : MunsaLiteScreenReaderText.expandSidebar );
		
				// Enable focus on toggle button.
				sidebarButton.focus();
				
				// If aria-expanded is false, set it to true. And vica versa.
				$( sidebarToggle ).attr( 'aria-expanded', $( sidebarToggle ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				$( primarySidebar ).attr( 'aria-expanded', $( primarySidebar ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				
			}
		}
	});
	
} )( jQuery );