<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package iCare
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses icare_header_style()
 */
function icare_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'icare_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'icare_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'icare_custom_header_setup' );

if ( ! function_exists( 'icare_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see icare_custom_header_setup().
 */
function icare_header_style() {
	$header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="header-style">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; 
	$header = get_custom_header();
	if($header->url!=""){ ?>
	.header_nav{
		background-image: url('<?php echo esc_url($header->url);?>');
		background-repeat: no-repeat;
	    background-size: cover;
    }
	<?php } ?>
	</style>
	<?php
}
endif;
