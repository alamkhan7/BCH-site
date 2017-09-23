/**
 * File icare customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// header background color
	wp.customize( 'icare_header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.header_nav' ).css( 'background-color',to );
		} );
	} );
	// Primary menu color
	wp.customize( 'icare_menu_color', function( value ) {
		value.bind( function( to ) {
			$( '.icaremenu-menu > li > a' ).css( 'color',to );
		} );
	} );
	// service heading
	wp.customize( 'icare_service_head', function( value ) {
		value.bind( function( to ) {
			$( '.service.title' ).html( to );
		} );
	} );
	wp.customize( 'icare_service_desc', function( value ) {
		value.bind( function( to ) {
			$( '#service_desc' ).html( to );
		} );
	} );
	// service bg color
	wp.customize( 'icare_service_color', function( value ) {
		value.bind( function( to ) {
			$( '#services' ).css( 'background',to );
		} );
	} );
	//home blog color
	wp.customize( 'icare_home_blog_color', function( value ) {
		value.bind( function( to ) {
			$( '#blog' ).css( 'background',to );
		} );
	} );

	// hero section title
	wp.customize( 'icare_hero_title', function( value ) {
		value.bind( function( to ) {
			$( '#h_title' ).html( to );
		} );
	} );
	// hero section desc
	wp.customize( 'icare_hero_desc', function( value ) {
		value.bind( function( to ) {
			$( '#h_subtitle' ).html( to );
		} );
	} );
	// home about us
	wp.customize( 'icare_about_color', function( value ) {
		value.bind( function( to ) {
			$( 'section#about' ).css( 'background',to );
		} );
	} );
	// extra section 


	wp.customize( 'icare_extra_color', function( value ) {
		value.bind( function( to ) {
			$( 'section.extra.section' ).css( 'background',to );
		} );
	} );


	/* home about */

	//home blog
	wp.customize( 'icare_aboutus_bgcolor', function( value ) {
		value.bind( function( to ) {
			$( '#aboutus' ).css( 'background-color', to );
		} );
	} );
	//calltoaction
	wp.customize( 'icare_calltoaction_title', function( value ) {
		value.bind( function( to ) {
			$( '#cta_title' ).html( to );
		} );
	} );
	
	wp.customize( 'icare_calltoaction_text', function( value ) {
		value.bind( function( to ) {
			$( '#cta_desc' ).html( to );
		} );
	} );

	wp.customize( 'icare_calltoaction_btn_text', function( value ) {
		value.bind( function( to ) {
			$( '#cta_btn' ).html( to );
		} );
	} );

	wp.customize( 'icare_calltoaction_btn_url', function( value ) {
		value.bind( function( to ) {
			$( '#cta_btn' ).attr('href', to );
		} );
	} );

	// copyright text
	wp.customize( 'icare_footer_copyright_link_text', function( value ) {
		value.bind( function( to ) {
			$( '#icare-copyright-link' ).html( to );
		} );
	} );

	wp.customize( 'icare_footer_copyright_link', function( value ) {
		value.bind( function( to ) {
			$( '#icare-copyright-link' ).attr('href', to );
		} );
	} );
	
} )( jQuery );