<?php
if(!function_exists('icare_topbar_menu')){
	function icare_topbar_menu(){?>
		  <div class="col-md-5">
			<div class="icare-widget border-none m-zero"><?php
	            if(has_nav_menu( 'topbar-menu' ) && get_theme_mod('icare_topbar_social_or_menu')=='social-links'):
					wp_nav_menu( array(
						'menu_id' => 'social-menu',
						'theme_location' => 'topbar-menu',
						'container'		=>false,
						'menu_class'     => 'list-inline sm-text-center mt-five mb-five social-links',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . icare_get_svg( array( 'icon' => 'chain' ) ),
					) );
				elseif(has_nav_menu( 'topbar-menu' ) && get_theme_mod('icare_topbar_social_or_menu')=='simple-links'):
					wp_nav_menu( array(
						'menu_id' => 'topbar-menu',
						'theme_location' => 'topbar-menu',
						'container'		=>false,
						'menu_class'     => 'list-inline sm-text-center mb-zero',
						'depth'          => 1
					) );
				endif;
				?>
			</div>
		  </div><?php
			}
}
if(!function_exists('icare_topbar_info')){
	function icare_topbar_info(){?>
		<div class="col-md-7">
            <div class="icare-widget no-border m-zero">
              <ul class="list-inline pull-right flip sm-pull-none sm-text-center mb-zero">
                <li class="m-zero pl-ten pr-ten"> <i class="fa fa-phone text-white"></i> <a class="text-white" href="tel:<?php echo esc_attr(get_theme_mod('icare_cont_phone'));?>"><?php echo esc_attr(get_theme_mod('icare_cont_phone'));?></a> </li>
                <li class="text-white m-zero pl-ten pr-ten"> <i class="<?php echo esc_attr(get_theme_mod('icare_cont_more_info_icon'));?> text-white"></i> <?php echo esc_attr(get_theme_mod('icare_cont_more_info'));?> </li>
                <li class="m-zero pl-ten pr-ten"> <i class="fa fa-envelope-o text-white"></i> <a class="text-white" href="mailto:<?php echo esc_attr(get_theme_mod('icare_cont_email'));?>"><?php echo esc_attr(get_theme_mod('icare_cont_email'));?></a> </li>
              </ul>
            </div>
        </div><?php
     }
}
/**
 * Header wrapper start
 *
 * @since  1.0.0
 * @return void
 */
if(!function_exists('icare_primary_navigation_wrapper')){
	function icare_primary_navigation_wrapper(){
		echo '<nav id="icaremenu" class="icaremenu icaremenu-responsive">';
	}
}
/**
 * Header wrapper close
 *
 * @since  1.0.0
 * @return void
 */
if(!function_exists('icare_primary_navigation_wrapper_close')){
	function icare_primary_navigation_wrapper_close(){
		echo '</nav>';
	}
}

if ( ! function_exists( 'icare_site_logo' ) ) {
	/**
	 * Site branding display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function icare_site_logo() {
		icare_site_title_or_logo();
	}
}

if ( ! function_exists( 'icare_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since 2.1.0
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function icare_site_title_or_logo( $echo = true ) {
		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			// Copied from jetpack_the_site_logo() function.
			$logo    = site_logo()->logo;
			$logo_id = get_theme_mod( 'custom_logo' ); // Check for WP 4.5 Site Logo
			$logo_id = $logo_id ? $logo_id : $logo['id']; // Use WP Core logo if present, otherwise use Jetpack's.
			$size    = site_logo()->theme_size();
			$html    = sprintf( '<a href="%1$s" class="site-logo-link flip xs-pull-center mb-fifteen" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image(
					$logo_id,
					$size,
					false,
					array(
						'class'     => 'site-logo attachment-' . $size,
						'data-size' => $size,
						'itemprop'  => 'logo'
					)
				)
			);

			$html = apply_filters( 'jetpack_the_site_logo', $html, $logo, $size );
		} else {
			$html='';
			if ( function_exists( 'the_custom_logo' ) ) {
				$html.= get_custom_logo();
			}
			$tag = is_home() || is_front_page() ? 'h2' : 'p';

			$html.= '<div class="site-branding-text"><' . esc_attr( $tag ) . ' class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="flip xs-pull-center mb-fifteen">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) .'>';
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) {
				$html .= '<p class="site-description">' . $description . '</p></div>';
			} else {
				$html .= '</div>';
			}
		}

		if ( ! $echo ) {
			return $html;
		}

		echo $html;
	}
}
// Add class to custom logo link
add_filter( 'get_custom_logo', 'icare_change_logo_class' );
function icare_change_logo_class( $html ) {
    $html = str_replace( 'custom-logo-link', 'custom-logo-link', $html );

    return $html;
}
if(!function_exists('icare_primary_navigation')){
	function icare_primary_navigation(){
		wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'primary-menu', 'container_id' => 'cssmenu',
			'menu_class' => 'p-menu pull-right','fallback_cb' => 'icare_fallback_page_menu',
			'walker' => new Icare_Class_Walker(), ) );
	}
}

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function icare_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'icare_front_page_sections', 1 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}
?>
