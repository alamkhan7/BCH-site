<?php 
/**
 * Topbar
 *
 * @see  icare_social_icons()
 * @see  icare_topbar_info()
 */
add_action( 'icare_topbar', 'icare_topbar_menu',                    10 );
add_action( 'icare_topbar', 'icare_topbar_info',             20 );
/**
 * header
 *
 * @see icare_primary_navigation_wrapper()
 * @see icare_site_logo()    
 * @see icare_primary_navigation()
 * @see icare_primary_navigation_wrapper_close()
 */
add_action( 'icare_header', 'icare_primary_navigation_wrapper',   		10 );
add_action( 'icare_header', 'icare_site_logo',             				12 );
add_action( 'icare_header', 'icare_primary_navigation',             	20 );
add_action( 'icare_header', 'icare_primary_navigation_wrapper_close',   30 );