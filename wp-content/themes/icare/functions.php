<?php
/**
 * iCare functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package iCare
 */
if (!function_exists('icare_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

    function icare_setup()
{

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on iCare, use a find and replace
         * to change 'icare' to the name of your theme in all the template files.
         */
        load_theme_textdomain('icare', get_template_directory() . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        //custom logo
        add_theme_support('custom-logo', array(
            'height'      => 50,
            'width'       => 150,
            'flex-width'  => true,
            'flex-height' => false,
            'header-text' => array('site-title', 'site-description'),
        ));
        add_editor_style(get_stylesheet_directory_uri() . '/assets/css/icare-editor-style.css');
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_image_size('icare_home_slider', 1440, 550, true);
        add_image_size('icare_blog_classic_img', 900, 450, true);
        add_image_size('icare_home_team_profile', 325, 300, true);
        add_image_size('icare_home_blog_thumb', 360, 220, true);
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary-menu' => esc_html__('Primary Menu', 'icare'),
            'topbar-menu'  => esc_html__('Top bar Menu', 'icare'),
            'footer-menu'  => esc_html__('Footer Menu', 'icare'),
        ));
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('icare_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
        // Recommend plugins
        add_theme_support( 'recommend-plugins', array(
            'caldera-forms' => array(
                'name' => esc_html__( 'Caldera Forms', 'icare' ),
                'active_filename' => 'caldera-forms/caldera-core.php',
            ),
            'siteorigin-panels'=> array(
                'name'     => esc_html__( 'Page Builder by SiteOrigin', 'icare' ), // The plugin name.
                'active_filename' => 'siteorigin-panels/siteorigin-panels.php',
            ),
			'one-click-demo-import'=> array(
                'name'     => esc_html__( 'One Click Demo Import', 'icare' ), // The plugin name.
                'active_filename' => 'one-click-demo-import/one-click-demo-import.php',
            ),
            'fusion-slider'=>array(
                'name'     => esc_html__( 'Fusion Slider', 'icare' ), // The plugin name.
                'active_filename' => 'fusion-slider/fusion-slider.php',
            ),
            'photo-video-gallery-master'=>array(
                'name'     => esc_html__( 'Photo Video Gallery Master', 'icare' ), // The plugin name.
                'active_filename' => 'photo-video-gallery-master/photo-video-gallery-master.php',
            ),
            'ultimate-gallery-master'=>array(
                'name'     => esc_html__( 'Ultimate Gallery Master', 'icare' ), // The plugin name.
                'active_filename' => 'ultimate-gallery-master/ultimate-gallery-master-lite.php',
            ),
            'social-media-gallery'=>array(
                'name'     => esc_html__( 'Social Media Gallery', 'icare' ), // The plugin name.
                'active_filename' => 'social-media-gallery/social-media-gallery.php',
            ),

        ) );
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('starter-content', array(

            'posts'     => array(
                'home'    => array(
                    'template' => 'home-page.php',
                ),
                'about'   => array(
                    'thumbnail' => '{{image-sandwich}}',
                ),
                'contact' => array(
                    'thumbnail' => '{{image-espresso}}',
                ),
                'blog'    => array(
                    'thumbnail' => '{{image-coffee}}',
                ),

            ),

            'options'   => array(
                'icare_show_topbar'           => 1,
                'icare_footer_social_or_menu' => 'simple-links',
                'icare_topbar_social_or_menu' => 'social-links',
                'show_on_front'               => 'page',
                'page_on_front'               => '{{home}}',
                'page_for_posts'              => '{{blog}}',
            ),
            'widgets'   => array(
                'sidebar-r' => array(
                    'search',
                    'text_business_info',
                    'text_about',
                    'category',
                    'tags',
                ),

                'footer-1'  => array(
                    'text_business_info',
                    'text_about',
                    'meta',
                    'search',
                ),
            ),

            'nav_menus' => array(
                'primary-menu' => array(
                    'name'  => __('Primary Menu', 'icare'),
                    'items' => array(
                        'page_home',
                        'page_about',
                        'page_blog',
                        'page_contact',
                    ),
                ),
                'topbar-menu'  => array(
                    'name'  => __('Top Menu', 'icare'),
                    'items' => array(
                        'link_yelp',
                        'link_facebook',
                        'link_twitter',
                        'link_instagram',
                        'link_email',
                    ),
                ),
                'footer-menu'  => array(
                    'name'  => __('Footer Menu', 'icare'),
                    'items' => array(
                        'page_home',
                        'page_about',
                        'page_blog',
                        'page_contact',
                    ),
                ),
            ),
        ));
    }
endif;
add_action('after_setup_theme', 'icare_setup');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function icare_content_width()
{
    $GLOBALS['content_width'] = apply_filters('icare_content_width', 1440);
}
add_action('after_setup_theme', 'icare_content_width', 0);
/**
 * Register icare-widget.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function icare_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Right Sidebar', 'icare'),
        'id'            => 'sidebar-r',
        'description'   => esc_html__('Add widgets here.', 'icare'),
        'before_widget' => '<widget id="%1$s" class="icare-widget no-border m-zero %2$s">',
        'after_widget'  => '</widget>',
        'before_title'  => '<h5 class="icare-widget-title widget-title-border-bottom">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Extra Widget Area -1', 'icare'),
        'id'            => 'icare-extra-widget-1',
        'description'   => esc_html__('You can use this widgetarea to replace Image on About us section on home page.', 'icare'),
        'before_widget' => '<div id="%1$s" class="icare-widget text-white no-border m-zero %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="icare-widget-title line-bottom">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Extra Widget Area -2', 'icare'),
        'id'            => 'icare-extra-widget-2',
        'description'   => esc_html__('You can use this widgetarea to replace Image on featured Section on home page.', 'icare'),
        'before_widget' => '<div id="%1$s" class="icare-widget text-white no-border m-zero %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="icare-widget-title line-bottom-white text-white">',
        'after_title'   => '</h5>',
    ));

    $col = get_theme_mod('icare_footer_widget_column');
    $col = $col != "" ? $col : 3;
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'icare'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'icare'),
        'before_widget' => '<div class="col-sm-6 col-md-' . $col . '">
                                <div id="%1$s" class="icare-widget dark %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h5 class="icare-widget-title widget-title-border-bottom">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'icare_widgets_init');
/**
 * Enqueue scripts and styles.
 */
function icare_scripts()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.css");
    wp_enqueue_style('animate', get_template_directory_uri() . "/assets/css/animate.css");
    wp_enqueue_style('icare-css-plugin-collections', get_template_directory_uri() . "/assets/css/icare-css-plugin-collections.css");

    // fontawesome-icons
    wp_enqueue_style('font-awesome', get_template_directory_uri() . "/assets/css/font-awesome.css");
    // CSS | Main style file
    wp_enqueue_style('icare-style', get_stylesheet_uri());

    // CSS | Custom Margin Padding Collection
    wp_enqueue_style('icare-custom-margin-padding', get_template_directory_uri() . "/assets/css/icare-custom-margin-padding.css");

    // CSS | Theme Color
    wp_enqueue_style('icare-theme-skin-sky-blue', get_template_directory_uri() . "/assets/css/colors/theme-skin-sky-blue.css");
    //fonts
    wp_enqueue_style('icare-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800|Raleway:400,300,200,500,700,600,800|Playfair+Display:400,400italic,700,700italic|Montserrat:400,700');
    wp_enqueue_script('jquery');
    // external javascripts
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js');
    // JS | jquery plugin collection for this theme
    wp_enqueue_script('icare-jquery-plugin-collection', get_template_directory_uri() . '/assets/js/icare-js-plugin-collection.js');
    wp_enqueue_script('icare-custom', get_template_directory_uri() . '/assets/js/icare-custom.js', array(), '20170301', true);
    wp_enqueue_script('icare-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
    wp_localize_script('icare-custom', 'brand', array(
        'logo' => icare_site_title_or_logo(false),
    ));
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'icare_scripts');

if (!function_exists('icare_register_required_plugins')):
    /**
     * Register the required plugins for this theme.
     *
     * In this example, we register five plugins:
     * - one included with the TGMPA library
     * - two from an external source, one from an arbitrary source, one from a GitHub repository
     * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
     *
     * The variable passed to tgmpa_register_plugins() should be an array of plugin
     * arrays.
     *
     * This function is hooked into tgmpa_init, which is fired within the
     * TGM_Plugin_Activation class constructor.
     */
    function icare_register_required_plugins()
{
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            array(
                'name'     => 'Calder Forms', // The plugin name.
                'slug'     => 'caldera-forms', // The plugin slug (typically the folder name).
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'     => 'Page Builder by SiteOrigin', // The plugin name.
                'slug'     => 'siteorigin-panels', // The plugin slug (typically the folder name).
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'     => 'Fusion Slider', // The plugin name.
                'slug'     => 'fusion-slider', // The plugin slug (typically the folder name).
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'     => 'Photo Video Gallery Master', // The plugin name.
                'slug'     => 'photo-video-gallery-master', // The plugin slug (typically the folder name).
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'     => 'Ultimate Gallery Master', // The plugin name.
                'slug'     => 'ultimate-gallery-master', // The plugin slug (typically the folder name).
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'     => 'Social Media Gallery', // The plugin name.
                'slug'     => 'social-media-gallery', // The plugin slug (typically the folder name).
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),
        );

        /*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
        $config = array(
            'id'           => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '', // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php', // Parent menu slug.
            'capability'   => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true, // Show admin notices or not.
            'dismissable'  => true, // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false, // Automatically activate plugins after installation or not.
            'message'      => '', // Message to output right before the plugins table.

            'strings'      => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'icare'),
                'menu_title'                      => esc_html__('Install Plugins', 'icare'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'icare'), // %s = plugin name.
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'icare'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'icare'), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'icare'), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'icare'), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'icare'), // %1$s = plugin name(s).
                'notice_ask_to_update_maybe'      => _n_noop('There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'icare'), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'icare'), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'icare'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'icare'), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'icare'), // %1$s = plugin name(s).
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'icare'),
                'update_link'                     => _n_noop('Begin updating plugin', 'Begin updating plugins', 'icare'),
                'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins', 'icare'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'icare'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'icare'),
                'activated_successfully'          => esc_html__('The following plugin was activated successfully:', 'icare'),
                'plugin_already_active'           => esc_html__('No action taken. Plugin %1$s was already active.', 'icare'), // %1$s = plugin name(s).
                'plugin_needs_higher_version'     => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'icare'), // %1$s = plugin name(s).
                'complete'                        => esc_html__('All plugins installed and activated successfully. %1$s', 'icare'), // %s = dashboard link.
                'contact_admin'                   => esc_html__('Please contact the administrator of this site for help.', 'icare'),
                'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            ),

        );

        tgmpa($plugins, $config);
    }

endif;
add_action('tgmpa_register', 'icare_register_required_plugins');

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/class-icare-customizer.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * FontAwesome Array
 */
require get_template_directory() . '/inc/font-awesome-list.php';
/**
 * Metabox.
 */

/**
 * Add theme info page
 */
require get_template_directory() . '/inc/dashboard.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Metabox.
 */
require get_template_directory() . '/functions/metabox.php';

/**
 * Load Menu walker.
 */
/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

require get_template_directory() . '/functions/menu/icare_default_menu_walker.php';
require get_template_directory() . '/functions/menu/icare_nav_walker.php';
require 'inc/icare-template-hooks.php';
require 'inc/icare-template-functions.php';

/* add_filter( 'wp_get_nav_menu_object', 'override_wp_get_nav_menu_object', 10, 2 );
function override_wp_get_nav_menu_object( $menu_obj, $menu ) {

    if ( ! is_object( $menu_obj ) ) {
        $menu_obj = (object) array( 'name' => '' );
    }

    return $menu_obj;
} */
