<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package iCare
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function icare_body_classes($classes)
{
    global $post;
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    if ( is_customize_preview() ) {
        $classes[] = 'icare-customizer';
    }

    // Add class on front page.
    if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
        $classes[] = 'icare-front-page';
    }
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    if(get_theme_mod('icare_site_layout')!=""){
        $classes[] = get_theme_mod('icare_site_layout');
    }
    if (is_single() || is_page() && get_post_meta($post->ID, 'content_layout', true) && get_post_meta($post->ID, 'content_layout', true) != "") {
        $classes[] = sanitize_text_field(get_post_meta($post->ID, 'content_layout', true));
    }
    return $classes;
}
add_filter('body_class', 'icare_body_classes');

if( !function_exists( 'icare_excerpt' ) ){
    function icare_excerpt( $content , $letter_count ){
        $content = strip_shortcodes( $content );
        $content = strip_tags( $content );
        $content = mb_substr( $content, 0 , $letter_count );

        if( strlen( $content ) == $letter_count ){
            $content .= "...";
        }
        return $content;
    }
}
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function icare_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'icare_pingback_header');

/* Breadcrumbs  */
function icare_breadcrumbs()
{
    $delimiter = '';
    $home      = esc_html__('Home', 'icare'); // text for the 'Home' link
    $pre_text  = '';
    $before    = '<li>'; // tag before the current crumb
    $after     = '</li>'; // tag after the current crumb
    echo '<ul class="breadcrumb text-left sm-text-center text-black mt-ten">';
    global $post;
    $homeLink = esc_url(home_url());
    if (is_front_page()) {
        echo '<li>' . $pre_text . '<a href="' . $homeLink . '">' . $home . '</a>';
    } else {
        echo '<li>' . $pre_text . '<a href="' . $homeLink . '">' . $home . '</a>' . $delimiter;
    }
    if (is_category()) {
        global $wp_query;
        $cat_obj   = $wp_query->get_queried_object();
        $thisCat   = $cat_obj->term_id;
        $thisCat   = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0) {
            echo (get_category_parents($parentCat, true, ' ' . $delimiter . '</li> '));
        }
        echo $before . single_cat_title('', false) . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a>' . $delimiter . '</li>';
        echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y')), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter;
        echo $before . get_the_time('d') . '</li>';
    } elseif (is_month()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a>' . $delimiter;
        echo $before . get_the_time('F') . '</li>';
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . '</li>';
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug      = $post_type->rewrite;
            echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter;
            echo $before . get_the_title() . '</li>';
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo $before . get_the_title() . '</li>';
        }
    } elseif (is_search()) {
        echo $before . _e("Search results for ", 'icare') . esc_attr(get_search_query()) . '"' . $after;
    } elseif (!is_single() && !is_page() && get_post_type() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat    = get_the_category($parent->ID);
        $cat    = $cat[0];
        echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
        echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>' . $delimiter;
        echo $before . esc_attr(get_the_title()) . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . esc_attr(get_the_title()) . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id   = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page          = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_attr(get_the_title($page->ID)) . '</a></li>';
            $parent_id     = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) {
            echo $crumb . ' ' . $delimiter . ' ';
        }

        echo $before . esc_attr(get_the_title()) . $after;
    } elseif (is_tag()) {
        echo $before . _e('Tag ', 'icare') . single_tag_title('', false) . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . _e("Articles posted by ", 'icare') . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . _e("Error 404 ", 'icare') . $after;
    } elseif (single_post_title()) {
        echo $before . single_post_title() . $after;
    }
    echo '</ul>';
}
/* Blog navigation */
if (!function_exists('icare_pagination')) {
    function icare_pagination()
    {
        global $wp_query;
        $big   = 999999999; // need an unlikely integer
        $pages = paginate_links(array(
            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'    => '?paged=%#%',
            'current'   => max(1, get_query_var('paged')),
            'total'     => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'      => 'array',
            'prev_next' => true,
            'prev_text' => '&#171;',
            'next_text' => '&#187;',
        ));
        if (is_array($pages)) {
            $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
            echo '<div class="col-md-12"><ul class="pagination theme-colored">';
            foreach ($pages as $page) {
                $active = strpos($page, 'current') ? 'class="active"' : '';
                echo "<li $active >$page</li>";
            }
            echo '</ul></div>';
        }
    }
}
// Comment Function
function icare_comments($comments, $args, $depth)
{
    extract($args, EXTR_SKIP);
    if ('div' == $args['style']) {
        $add_below = 'comment';
    } else {
        $add_below = 'div-comment';
    }
    $class = is_rtl() ? 'media-object img-thumbnail comment-gravtar-r' : 'media-object img-thumbnail comment-gravtar';
    ?>

<li <?php comment_class(empty($args['has_children']) ? '' : 'parent')?> id="comment-<?php comment_ID()?>">
    <div class="media comment-author"> <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comments, $args['avatar_size'],'','',array('class'=>$class) ); ?>
        <div class="media-body">
            <h5 class="media-heading comment-heading"><?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>','icare' ), get_comment_author_link() ); ?></h5>
            <div class="comment-date"><a href="<?php echo get_comment_link(); ?>"><?php printf(esc_html__('%1$s at %2$s', 'icare'), get_comment_date(), get_comment_time());?></a></div>
            <?php
if ($comments->comment_approved == '0') {?>
            <p><?php _e('Your comment is awaiting moderation.', 'icare');?></p><br/>
        </div><?php } else {comment_text();}?>
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));?></div>
    </div>

    <?php
}

/**
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 *
 * @param  strong  $hex   hex color e.g. #111111.
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten).
 * @return string        brightened/darkened hex color
 * @since  1.0.0
 */
function icare_adjust_color_brightness($hex, $steps)
{
    // Steps should be between -255 and 255. Negative = darker, positive = lighter.
    $steps = max(-255, min(255, $steps));

    // Format the hex color string.
    $hex = str_replace('#', '', $hex);

    if (3 == strlen($hex)) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }

    // Get decimal values.
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Adjust number of steps and keep it inside 0 to 255.
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#' . $r_hex . $g_hex . $b_hex;
}
/**
 * convert hex color into rgba
 *
 * @param  strong  $color   hex color e.g. #111111.
 * @param  integer $opcity  0.0 to 1.
 * @return string        rgb(a) color
 * @since  1.0.0
 */
function icare_hex2rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color)) {
        return $default;
    }

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }

        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

//Customizer sannitize callback functions

/* Custom Sanitization Function  */
function icare_sanitize_checkbox($checked)
{
    return ((isset($checked) && (true == $checked || 'on' == $checked)) ? true : false);
}

function icare_sanitize_selected($value)
{
    if ($value[0] == '') {
        return $value = '';
    } else {
        return wp_kses_post($value);
    }
}
function icare_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
function icare_sanitize_text($value)
{
    return wp_kses_post(force_balance_tags($value));
}

function icare_sanitize_json_string($json){
    $sanitized_value = array();
    foreach (json_decode($json,true) as $value) {
        $sanitized_value[] = esc_attr($value);
    }
    return json_encode($sanitized_value);
}
/* Woocommerce supoport */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'icare_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'icare_theme_wrapper_end', 10);
function icare_theme_wrapper_start()
{
    ?>
<section class="inner-header-transform divider parallax section-overlay breadcrumb-overlay">
  <div class="container pt-thirty pb-thirty">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-sm-8 text-left flip xs-text-center crumbs">

        <?php if (!is_product()): ?>
                <h2 class="title"><?php woocommerce_page_title();?></h2>
        <?php else:
                woocommerce_template_single_title();
            endif;?>
        </div>
        <div class="col-sm-4">
          <?php icare_breadcrumbs();?>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container mt-thirty mb-thirty pt-thirty pb-thirty">
    <div class="row">
      <div class="col-md-9 post-content">
        <div class="blog-posts single-post">
    <?php
}
function icare_theme_wrapper_end()
{?>
    </div>
       </div>
        <?php do_action('woocommerce_sidebar');?>
    </div>
</div>
</section>
<?php }

/**
 * icare_hide_page_title
 *
 * Removes the "shop" title on the main shop page
 */
function icare_hide_page_title()
{
    return false;
}
add_filter('woocommerce_show_page_title', 'icare_hide_page_title');
/**
 * Removes breadcrumbs
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

function icare_import_files() {
  return array(
    array(
      'import_file_name'             => 'Demo Import 1',
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/ocdi/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/ocdi/widgets.json',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/ocdi/customizer.dat',
      'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'screenshot.png',
      'import_notice'                => __( 'Save time by import our demo data, your website will be set up and ready to customize in minutes.', 'icare' ),
      'preview_url'                  => 'https://www.demo.webhuntinfotech.com/icare',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'icare_import_files' );
function icare_after_import_setup() {
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
	
	// Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'primary', 'nav_menu' );
    $top_menu = get_term_by( 'name', 'social', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'topbar-menu' => $top_menu->term_id,
		)
    );
}
add_action( 'pt-ocdi/after_import', 'icare_after_import_setup' );