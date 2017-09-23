<?php
/**
 * Plugin Name: Fusion Slider
 * Version: 1.2
 * Description: Fusion Slider is an awesome WordPress Slider Plugin with many nice features. Just need to install and build slider in a few minutes.
 * Author: WebHunt Infotech
 * Author URI: https://www.webhuntinfotech.com/
 * Plugin URI: http://demo.webhuntinfotech.com/fusion-slider-pro/
 */

/**
 * Constant Variable
 */
define("FSL_PLUGIN_URL", plugin_dir_url(__FILE__));

add_action('plugins_loaded', 'FSL_GetReadyTranslation');
function FSL_GetReadyTranslation() {
	load_plugin_textdomain('FSL_TEXT_DOMAIN', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

/**
* Crop Images In Desire Format
*/
add_image_size( 'FSL_gallery_admin_thumb', 300, 300, array( 'top', 'center' ) );
add_image_size( 'FSL_gallery_image', 1280, 720, array( 'top', 'center' ) );
add_image_size( 'FSL_gallery_el_thumb', 150, 59, array( 'top', 'center' ) );

/**
* Remove post image
*/
function FSL_remove_image_box() {
	remove_meta_box('postimagediv','fsl_slider','side');
}
add_action('do_meta_boxes', 'FSL_remove_image_box');

/**
* Short Code Detach Function To UpLoad JS And CSS
*/
function FSL_ShortCodeDetect() {
	/** Responsive Slider **/
	wp_enqueue_script('FSL-responsiveslides-js', FSL_PLUGIN_URL.'assets/sliders/responsive/responsiveslides.js', array('jquery'));
	wp_enqueue_style('FSL-responsiveslides-css', FSL_PLUGIN_URL.'assets/sliders/responsive/responsiveslides.css');
}
add_action( 'wp_enqueue_scripts', 'FSL_ShortCodeDetect' );
add_filter( 'widget_text', 'do_shortcode' );

class FSL {
    private static $instance;
    private $admin_thumbnail_size = 150;
    private $thumbnail_size_w = 150;
    private $thumbnail_size_h = 150;
	var $counter;

    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

	private function __construct() {
		$this->counter = 0;
        add_action('admin_print_scripts-post.php', array(&$this, 'fsl_admin_print_scripts'));
        add_action('admin_print_scripts-post-new.php', array(&$this, 'fsl_admin_print_scripts'));
        add_image_size('fsl_gallery_admin_thumb', $this->admin_thumbnail_size, $this->admin_thumbnail_size, true);
        add_image_size('fsl_gallery_thumb', $this->thumbnail_size_w, $this->thumbnail_size_h, true);
        add_shortcode('fslgallery', array(&$this, 'shortcode'));
        if (is_admin()) {
			add_action('init', array(&$this, 'FusionSlider'), 1);
			add_action('add_meta_boxes', array(&$this, 'add_all_fsl_meta_boxes'));
			add_action('admin_init', array(&$this, 'add_all_fsl_meta_boxes'), 1);
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this,'fsl_activate_sublink') );

			add_action('save_post', array(&$this, 'FSL_image_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'FSL_settings_meta_save'), 9, 1);

			add_action('wp_ajax_FSL_get_thumbnail', array(&$this, 'ajax_get_thumbnail'));
		}
    }
	
	public function fsl_activate_sublink($links){
		$plugin_submenu_added_link=array();		
		 $added_link = array(
		 '<a target="_blank" style="color: rgba(10, 154, 62, 1); font-weight: bold; font-size: 13px;" href="https://www.webhuntinfotech.com/plugin/fusion-slider-pro/">Upgrade to Pro</a>',
		 );
		$plugin_submenu_added_link=array_merge( $plugin_submenu_added_link, $added_link );
		$plugin_submenu_added_link=array_merge( $plugin_submenu_added_link, $links );
		return $plugin_submenu_added_link;
	}

	//Required JS & CSS
	public function fsl_admin_print_scripts() {
		if ( 'fsl_slider' == $GLOBALS['post_type'] ) {
			wp_enqueue_script('jquery');
			
			//custom add image box css
			wp_enqueue_style('meta-css', FSL_PLUGIN_URL.'assets/admin-scripts/css/meta.css');
			
			// Image box jquery ui js and css
			wp_enqueue_style('jquery-ui-css', FSL_PLUGIN_URL.'assets/admin-scripts/css/jquery-ui.css');
			if( !wp_script_is('jquery-ui-tabs') ) {     
			  wp_enqueue_script('jquery-ui-tabs');
			}
			
			wp_enqueue_media();
			
			wp_enqueue_script('media-upload');
			wp_enqueue_script('media-uploader-js', FSL_PLUGIN_URL . 'assets/admin-scripts/js/multiple-media-uploader.js', array('jquery'));
			
			// Settings form css and js
			wp_enqueue_style('smart-forms.css', FSL_PLUGIN_URL.'assets/admin-scripts/css/smart-forms.css');
		}
	}

	// Register Custom Post Type
	public function FusionSlider() {
		$labels = array(
			'name' => __('Fusion Slider','FSL_TEXT_DOMAIN' ),
			'singular_name' => __('Fusion Slider','FSL_TEXT_DOMAIN' ),
			'add_new' => __('Add New Slider', 'FSL_TEXT_DOMAIN' ),
			'add_new_item' => __('Add New Slider', 'FSL_TEXT_DOMAIN' ),
			'edit_item' => __('Edit Slider', 'FSL_TEXT_DOMAIN' ),
			'new_item' => __('New Slider', 'FSL_TEXT_DOMAIN' ),
			'view_item' => __('View Slider', 'FSL_TEXT_DOMAIN' ),
			'search_items' => __('Search Slider', 'FSL_TEXT_DOMAIN' ),
			'not_found' => __('No Slider found', 'FSL_TEXT_DOMAIN' ),
			'not_found_in_trash' => __('No Slider found in Trash', 'FSL_TEXT_DOMAIN' ),
			'parent_item_colon' => __('Parent Slider:', 'FSL_TEXT_DOMAIN' ),
			'all_items' => __('All Sliders', 'FSL_TEXT_DOMAIN' ),
			'menu_name' => __('Fusion Slider', 'FSL_TEXT_DOMAIN' )
		);
		
		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title','thumbnail'),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 10,
			'menu_icon' => FSL_PLUGIN_URL.'assets/admin-scripts/img/slider_icon.png',
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => false,
			'capability_type' => 'post'
		);

        register_post_type( 'fsl_slider', $args );
		add_filter( 'manage_edit-fsl_slider_columns', array(&$this, 'fsl_gallery_columns' )) ;
        add_action( 'manage_fsl_slider_posts_custom_column', array(&$this, 'fsl_gallery_manage_columns' ), 10, 2 );
	}

	function fsl_gallery_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Slider Galleries','FSL_TEXT_DOMAIN' ),
            'shortcode' => __( 'Slider Shortcodes','FSL_TEXT_DOMAIN' ),
            'date' => __( 'Date','FSL_TEXT_DOMAIN' )
        );
        return $columns;
    }

    function fsl_gallery_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input type="text" value="[FSL id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }

	public function add_all_fsl_meta_boxes() {
		add_meta_box( __('Add Slider Images', 'FSL_TEXT_DOMAIN'), __('Add Slider Images', 'FSL_TEXT_DOMAIN'), array(&$this, 'FSL_generate_add_image_meta_box_function'), 'fsl_slider', 'normal', 'low' );
		add_meta_box( __('Apply Setting on Slider', 'FSL_TEXT_DOMAIN'), __('Apply Setting On Slider', 'FSL_TEXT_DOMAIN'), array(&$this, 'FSL_settings_meta_box_function'), 'fsl_slider', 'normal', 'low');
		add_meta_box ( __('Slider Shortcode', 'FSL_TEXT_DOMAIN'), __('Slider Shortcode', 'FSL_TEXT_DOMAIN'), array(&$this, 'FSL_shotcode_meta_box_function'), 'fsl_slider', 'side', 'low');
		
		// Rate Us Meta Box
		add_meta_box(__('Show us some love, Rate Us', 'FSL_TEXT_DOMAIN') , __('Show us some love, Rate Us', 'FSL_TEXT_DOMAIN'), array(&$this,'rate_us_meta_box_fsl'), 'fsl_slider', 'side', 'low');
		
		add_meta_box(__('Plugin Support', 'FSL_TEXT_DOMAIN') , __('Plugin Support', 'FSL_TEXT_DOMAIN'), array(&$this,'fsl_support_meta_box'), 'fsl_slider', 'side', 'low');
		
		// Pro Features Meta Box
		add_meta_box(__('PRO Features List', 'FSL_TEXT_DOMAIN') , __('PRO Features List', 'FSL_TEXT_DOMAIN'), array(&$this,'fsl_pro_features'), 'fsl_slider', 'side', 'low');
	}
	
	// Rate Us Meta Box Function
	function rate_us_meta_box_fsl() { ?>
		<style>
		.imgStar{
			width:180px;
			height:33px;
			background: url(<?php echo  esc_url(FSL_PLUGIN_URL.'assets/admin-scripts/img/5-star-review-logo.jpg'); ?>) no-repeat;
			background-size: 180px 33px;
		}
		.imgStar:hover { 
			width:180px;
			height:33px;
			background: url(<?php echo  esc_url(FSL_PLUGIN_URL.'assets/admin-scripts/img/5-star-review-logo-golden.jpg'); ?>) no-repeat;
			background-size: 180px 33px;
		}
		</style>
		<div align="center">
			<p>Please Review & Rate Us On WordPress</p>
			<div class="stars">
				<a href="https://wordpress.org/support/plugin/fusion-slider/reviews/?filter=5" target="_blank"><div class="imgStar"></div></a>
			</div>
		</div>
		<div style="text-align:center;margin-bottom:15px;margin-top:25px;">
			<a href="https://wordpress.org/support/plugin/fusion-slider/reviews/?filter=5" target="_blank" title="rate us" class="btn-web button-4"><?php _e('RATE US','FSL_TEXT_DOMAIN'); ?></a>
		</div>
		<?php
	}
	
	function fsl_support_meta_box() { ?>
		<div class="" style="text-align:center;margin-bottom:40px;margin-top:25px;">	
			<a href="https://www.webhuntinfotech.com/fusion-slider-lite-documentation/" target="_blank" class="btn-web button-2"><?php _e('Documention (Lite)','FSL_TEXT_DOMAIN'); ?></a>
		</div>
		<div class="" style="text-align:center;margin-bottom:40px;margin-top:25px;">
			<a href="http://wordpress.org/support/plugin/fusion-slider" target="_blank" class="btn-web button-1"><?php _e('Support Fourm (Lite)','FSL_TEXT_DOMAIN'); ?></a>
		</div>
	<?php
	}
	
	function fsl_pro_features(){
	?>
		<ul style="">
			<li class="plan-feature">(1) <?php _e('100% Responsive Design.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(2) <?php _e('7 Type of sliders.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(3) <?php _e('Slider Effects.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(4) <?php _e('Video Slider.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(5) <?php _e('Flex Slider One & Two.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(6) <?php _e('Jssor Image Slider.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(7) <?php _e('Carousel Slider.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(8) <?php _e('Elastic Slider.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(9) <?php _e('Nivo Slider.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(10) <?php _e('Responsive Slider.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(11) <?php _e('Easing Effects.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(12) <?php _e('Multiple Image Uploader.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(13) <?php _e('Drag and Drop image Position.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(14) <?php _e('All Slider Shortcode & Unique Settings.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(15) <?php _e('100% Width Option.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(16) <?php _e('Customize Width and Height.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(17) <?php _e('Custom Color Option.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(18) <?php _e('Font Typography Option.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(19) <?php _e('Button Option in Flex Slider One.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(20) <?php _e('Feature Options.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(21) <?php _e('Enable/Disable Navigation Option.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(22) <?php _e('Shortcode Button on post or page.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(23) <?php _e('Custom CSS Option.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(24) <?php _e('Extensive Documentation.','FSL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(25) <?php _e('And many more..','FSL_TEXT_DOMAIN'); ?></li>
		</ul>
	<?php
	}

	public function FSL_shotcode_meta_box_function() { ?>
		<Script>
		jQuery( function() {
			jQuery( "#tabs_shortcode" ).tabs();
		 } );
		</script>
		<div id="tabs_shortcode">
			<ul>
				<li><a href="#tabs-1"><?php _e('Shortcode','FSL_TEXT_DOMAIN'); ?></a></li>
				<li><a href="#tabs-2"><?php _e('PHP File','FSL_TEXT_DOMAIN'); ?></a></li>
			</ul>
			  <div id="tabs-1" style="padding: 0.6em 1.0em;">
				<p><?php _e('Copy and paste the shortcode directly into any WordPress post or page','FSL_TEXT_DOMAIN'); ?>.</p>
				<input readonly="readonly" type="text" style="width: 215px;" value="<?php echo "[FSL id=".get_the_ID()."]"; ?>">
			  </div>
			  <div id="tabs-2" style="padding: 0.6em 1.0em;">				
				<p><?php _e('Copy and paste this code into a PHP file to include the slideshow within your theme','FSL_TEXT_DOMAIN'); ?>.</p>
				<input readonly="readonly" type="text" style="width: 215px; height: 25px; font-size: 10px;" value="<?php echo "<?php echo do_shortcode([FSL id=".get_the_ID()."]); ?>" ?>">
			</div>
		</div>		
		<?php
	}

	/**
	 * This function display Add New Image interface
	 * Also loads all saved Slider photos into gallery
	 */
    public function FSL_generate_add_image_meta_box_function($post) { ?>
		<div class="" style="padding:20px;text-align: center;">
		  <a  href="https://www.webhuntinfotech.com/fusion-slider-lite-documentation/" target="_blank" class="btn-web button-1"><?php _e('Documention (Lite)','FSL_TEXT_DOMAIN'); ?></a>
		  <a href="http://demo.webhuntinfotech.com/demo?theme=fsp-pro" target="_blank" class="btn-web button-2"><?php _e('View Live Demo (PRO)','FSL_TEXT_DOMAIN'); ?></a>
		  <a href="https://www.webhuntinfotech.com/amember/signup/fsp/" target="_blank" class="btn-web button-3"><?php _e('Upgrade to PRO','FSL_TEXT_DOMAIN'); ?></a>
		</div>
		<div >
			<div class="fsl-tips-div">
				<p><strong><?php _e('Tips','FSL_TEXT_DOMAIN'); ?>:</strong> <?php _e('Upload all slider images using "Add Slides" button. Do not use/add pre-uploaded images which are uploaded previously using Media/Post/Page. Minimum Dimensions for Upload Image is 1280*720.','FSL_TEXT_DOMAIN'); ?></p>
			</div>
			<input id="FSL_delete_all_button" class="button" type="button" value="Remove All Images" rel="">
			<input type="hidden" id="FSL_wl_action" name="FSL_wl_action" value="FSL-save-settings">
			
			<div class="fsl-mediabar">
				<p><?php _e('Slides Images','FSL_TEXT_DOMAIN'); ?></p>
				<div class="fsl-mediabar-right">
					<a href="#" class="button" title="Add Slide" id="fsl_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select">
						<span class="wp-media-buttons-icon"></span> <?php _e('Add Slides','FSL_TEXT_DOMAIN'); ?>                                               
					</a>
				</div>
			</div>

            <ul id="fsl_gallery_thumbs" class="clearfix">
				<?php
				/* Load saved photos */
				$WPGP_AllPhotosDetails = unserialize(get_post_meta( $post->ID, 'FSL_all_photos_details', true));
				$TotalImages =  get_post_meta( $post->ID, 'FSL_total_images_count', true );
				if($TotalImages) {
					$i=0;
					foreach($WPGP_AllPhotosDetails as $WPGP_SinglePhotoDetails) {
						$name = $WPGP_SinglePhotoDetails['FSL_image_label'];
						$alt = $WPGP_SinglePhotoDetails['FSL_image_alt'];
						$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
						$image_url = $WPGP_SinglePhotoDetails['FSL_image_url'];
						$gallery_image = $WPGP_SinglePhotoDetails['FSL_gallery_image'];
						$gallery_thumb = $WPGP_SinglePhotoDetails['FSL_gallery_admin_thumb'];
						$el_thumb = $WPGP_SinglePhotoDetails['FSL_gallery_el_thumb'];
						$description = $WPGP_SinglePhotoDetails['FSL_image_descp'];
						$link = $WPGP_SinglePhotoDetails['FSL_external_link'];
						?>
						<script>
						  jQuery( function() {
							jQuery( "#tabs<?php echo $i; ?>" ).tabs();
						  } );
						</script>
						<li class="fsl-image-entry" id="fsl_img">
							<a class="image_gallery_remove fslgallery_remove" href="#gallery_remove" id="fsl_remove_bt" ><img src="<?php echo  esc_url(FSL_PLUGIN_URL.'assets/admin-scripts/img/image-close-icon.png'); ?>" /></a>
							<div class="fsl-admin-inner-div1" >
								<img src="<?php echo esc_url($gallery_thumb); ?>" class="fsl-meta-image" alt=""  style="">
								<input type="hidden" id="unique_string[]" name="unique_string[]" value="<?php echo esc_attr($UniqueString); ?>" />
							</div>
							<div class="fsl-admin-inner-div2" >
								<div id="tabs<?php echo $i; ?>">
								  <ul>
									<li><a href="#tabs-1"><?php _e('General','FSL_TEXT_DOMAIN'); ?></a></li>
									<li><a href="#tabs-2"><?php _e('SEO','FSL_TEXT_DOMAIN'); ?></a></li>
								  </ul>
								  <div id="tabs-1">
									<input type="text" id="FSL_image_url[]" name="FSL_image_url[]" class="fsl_label_text"  value="<?php echo esc_url($image_url); ?>"  readonly="readonly" style="display:none;" />
									<input type="text" id="FSL_gallery_image[]" name="FSL_gallery_image[]" class="fsl_label_text"  value="<?php echo esc_url($gallery_image); ?>"  readonly="readonly" style="display:none;" />
									<input type="text" id="FSL_gallery_admin_thumb[]" name="FSL_gallery_admin_thumb[]" class="fsl_label_text"  value="<?php echo esc_url($gallery_thumb); ?>"  readonly="readonly" style="display:none;" />
									<input type="text" id="FSL_gallery_el_thumb[]" name="FSL_gallery_el_thumb[]" class="fsl_label_text"  value="<?php echo esc_url($el_thumb); ?>"  readonly="readonly" style="display:none;" />
										<label class="fsl_label"><?php _e('Image Title','FSL_TEXT_DOMAIN')?></label>
										<input type="text" id="FSL_image_label[]" name="FSL_image_label[]" value="<?php echo esc_attr($name); ?>" placeholder="Enter Slider Title Here" class="fsl_label_text">

										<label class="fsl_textarea_label"><?php _e('Description','FSL_TEXT_DOMAIN')?></label>
										<textarea id="FSL_image_descp[]" name="FSL_image_descp[]" class="fsl_textarea" placeholder="Enter Slider Description Here"><?php echo $description; ?></textarea>	
								  </div>
								  <div id="tabs-2">
										<div class="fsl_label"><label ><?php _e('Image Alt','FSL_TEXT_DOMAIN')?></label></div>
										<input type="text" id="FSL_image_alt[]" name="FSL_image_alt[]" value="<?php echo esc_attr($alt); ?>" placeholder="Enter Alt Text Here" class="fsl_label_text">
									<p>	
										<label class="fsl_label"><?php _e('Slider Link','FSL_TEXT_DOMAIN')?></label>
										<input type="text" id="FSL_external_link[]" name="FSL_external_link[]" value="<?php echo esc_url($link); ?>" placeholder="Enter Link URL" class="fsl_label_text">
									</p>	
								  </div>
								</div>
								
							</div>
						</li>
						<?php
						$i++;
					} // end of foreach
				} else {
					$TotalImages = 0;
				}
				?>
            </ul>
        </div>

		<div style="clear:left;"></div>
        <?php
    }
	
	/** Plugin Setting Meta Box */
    public function FSL_settings_meta_box_function($post) {
		require_once('inc/fusion-slider-settings.php');
	}

	public function admin_thumb($id) {
		$image  = wp_get_attachment_image_src($id, 'FSL_gallery_admin_original', true);
		$image1 = wp_get_attachment_image_src($id, 'FSL_gallery_image', true);
		$image2 = wp_get_attachment_image_src($id, 'FSL_gallery_admin_thumb', true);
		$image3 = wp_get_attachment_image_src($id, 'FSL_gallery_el_thumb', true);
		$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        ?>
		<script>
		  jQuery( function() {
			jQuery( "#tabs<?php echo $id; ?>" ).tabs();
		  } );
		</script>
		<li class="fsl-image-entry" id="fsl_img">
			<a class="image_gallery_remove fslgallery_remove" href="#gallery_remove" id="fsl_remove_bt" ><img src="<?php echo  esc_url(FSL_PLUGIN_URL.'assets/admin-scripts/img/image-close-icon.png'); ?>" /></a>
			<div class="fsl-admin-inner-div1" >
				<img src="<?php echo esc_url($image2[0]); ?>" class="fsl-meta-image" alt=""  style="">
			</div>
			<div class="fsl-admin-inner-div2" >
				<div id="tabs<?php echo $id; ?>">
				  <ul>
					<li><a href="#tabs-1"><?php _e('General','FSL_TEXT_DOMAIN'); ?></a></li>
					<li><a href="#tabs-2"><?php _e('SEO','FSL_TEXT_DOMAIN'); ?></a></li>
				  </ul>
				  <div id="tabs-1">
					<input type="text" id="FSL_image_url[]" name="FSL_image_url[]" class="fsl_label_text"  value="<?php echo esc_url($image[0]); ?>"  readonly="readonly" style="display:none;" />
					<input type="text" id="FSL_gallery_image[]" name="FSL_gallery_image[]" class="fsl_label_text"  value="<?php echo esc_url($image1[0]); ?>"  readonly="readonly" style="display:none;" />
					<input type="text" id="FSL_gallery_admin_thumb[]" name="FSL_gallery_admin_thumb[]" class="fsl_label_text"  value="<?php echo esc_url($image2[0]); ?>"  readonly="readonly" style="display:none;" />
					<input type="text" id="FSL_gallery_el_thumb[]" name="FSL_gallery_el_thumb[]" class="fsl_label_text"  value="<?php echo esc_url($image3[0]); ?>"  readonly="readonly" style="display:none;" />
					
						<label class="fsl_label"><?php _e('Image Title','FSL_TEXT_DOMAIN')?></label>
						<input type="text" id="FSL_image_label[]" name="FSL_image_label[]" value="" placeholder="Enter Slider Title Here" class="fsl_label_text">
						<label class="fsl_textarea_label"><?php _e('Description','FSL_TEXT_DOMAIN')?></label>
						<textarea id="FSL_image_descp[]" name="FSL_image_descp[]" class="fsl_textarea" placeholder="Enter Slider Description Here"></textarea>
				  </div>
				  <div id="tabs-2">
						<div class="fsl_label"><label ><?php _e('Image Alt','FSL_TEXT_DOMAIN')?></label></div>
						<input type="text" id="FSL_image_alt[]" name="FSL_image_alt[]" value="" placeholder="Enter Alt Text Here" class="fsl_label_text">
					<p>	
						<label class="fsl_label"><?php _e('Slider Link','FSL_TEXT_DOMAIN')?></label>
						<input type="text" id="FSL_external_link[]" name="FSL_external_link[]" value="" placeholder="Enter Link URL" class="fsl_label_text">
					</p>	
				  </div>
				</div>
			</div>
		</li>
        <?php
    }

    public function ajax_get_thumbnail() {
        echo $this->admin_thumb($_POST['imageid']);
        die;
    }

    public function FSL_image_meta_box_save($PostID) {
		if(isset($PostID) && isset($_POST['FSL_wl_action'])) {
			if(isset($_POST['FSL_image_url'])){
				$TotalImages = count($_POST['FSL_image_url']);
				$ImagesArray = array();
				if($TotalImages) {
					for($i=0; $i < $TotalImages; $i++) {
						$image_label 	= $_POST['FSL_image_label'][$i];
						$image_alt 		= $_POST['FSL_image_alt'][$i];
						$image_url 		= $_POST['FSL_image_url'][$i];
						$gallery_image 	= $_POST['FSL_gallery_image'][$i];
						$admin_thumb 	= $_POST['FSL_gallery_admin_thumb'][$i];
						$el_thumb 		= $_POST['FSL_gallery_el_thumb'][$i];
						$link 			= $_POST['FSL_external_link'][$i];
						$description 	= $_POST['FSL_image_descp'][$i];
						$ImagesArray[] = array(
							'FSL_image_label' 			=> stripslashes( $image_label ),
							'FSL_image_alt' 			=> stripslashes( $image_alt ),
							'FSL_image_url' 			=> esc_url_raw( $image_url ),
							'FSL_gallery_image' 		=> esc_url_raw( $gallery_image ),
							'FSL_gallery_admin_thumb' 	=> esc_url_raw( $admin_thumb ),
							'FSL_gallery_el_thumb'=> esc_url_raw( $el_thumb ),
							'FSL_external_link' 		=> esc_url_raw( $link ),
							'FSL_image_descp' 			=> stripslashes(esc_attr($description))
						);
					}
					
					update_post_meta($PostID, 'FSL_all_photos_details', serialize($ImagesArray));
					update_post_meta($PostID, 'FSL_total_images_count', $TotalImages);
				}
			} else {
				$TotalImages = 0;
				update_post_meta($PostID, 'FSL_total_images_count', $TotalImages);
				$ImagesArray = array();
				update_post_meta($PostID, 'FSL_all_photos_details', serialize($ImagesArray));
			}
		}
    }

	//save settings meta box values
	public function FSL_settings_meta_save($PostID) {
	  if(isset($PostID) && isset($_POST['fsl_type'])){
		$fsl_type  			= sanitize_text_field( $_POST['fsl_type'] );
		$fsl_fullWidth	   	= sanitize_text_field( $_POST['fsl_fullWidth'] );
		$fsl_width 			= sanitize_text_field( $_POST['fsl_width'] );
		$fsl_height 		= sanitize_text_field( $_POST['fsl_height'] );
		$fsl_links      	= sanitize_text_field( $_POST['fsl_links'] );
		$fsl_arrowcolor     = sanitize_text_field( $_POST['fsl_arrowcolor'] );
		$fsl_prevText       = sanitize_text_field( $_POST['fsl_prevText'] );
		$fsl_nextText       = sanitize_text_field( $_POST['fsl_nextText'] );
		$fsl_navigation     = sanitize_text_field( $_POST['fsl_navigation'] );
		$fsl_textstyle 		= sanitize_text_field( $_POST['fsl_textstyle'] );
		$fsl_tbgcolor 		= sanitize_text_field( $_POST['fsl_tbgcolor'] );
		$fsl_tfontfamily 	= sanitize_text_field( $_POST['fsl_tfontfamily'] );
		$fsl_tfontcolor 	= sanitize_text_field( $_POST['fsl_tfontcolor'] );
		$fsl_tfontsize 		= sanitize_text_field( $_POST['fsl_tfontsize'] );
		$fsl_tlineheight 	= sanitize_text_field( $_POST['fsl_tlineheight'] );
		$fsl_tspacetop 		= sanitize_text_field( $_POST['fsl_tspacetop'] );
		$fsl_tspaceleft 	= sanitize_text_field( $_POST['fsl_tspaceleft'] );
		$fsl_dbgcolor 		= sanitize_text_field( $_POST['fsl_dbgcolor'] );
		$fsl_dfontfamily 	= sanitize_text_field( $_POST['fsl_dfontfamily'] );
		$fsl_dfontcolor 	= sanitize_text_field( $_POST['fsl_dfontcolor'] );
		$fsl_dfontsize 		= sanitize_text_field( $_POST['fsl_dfontsize'] );
		$fsl_dlineheight 	= sanitize_text_field( $_POST['fsl_dlineheight'] );
		$fsl_dspacetop 		= sanitize_text_field( $_POST['fsl_dspacetop'] );
		$fsl_dspaceleft 	= sanitize_text_field( $_POST['fsl_dspaceleft'] );
		$fsl_textalign	   	= sanitize_text_field( $_POST['fsl_textalign']);
		$fsl_center	   		= sanitize_text_field( $_POST['fsl_center']);
		$fsl_autoPlay       = sanitize_text_field( $_POST['fsl_autoPlay'] );
		$fsl_random      	= sanitize_text_field( $_POST['fsl_random'] );
		$fsl_hoverPause     = sanitize_text_field( $_POST['fsl_hoverPause'] );
		$fsl_delay          = sanitize_text_field( $_POST['fsl_delay'] );
		$fsl_animationSpeed = sanitize_text_field( $_POST['fsl_animationSpeed'] );
		$fsl_customCss      = wp_filter_nohtml_kses( $_POST['fsl_customCss'] );
		$FSL_Settings_Array = serialize( array(
			'fsl_type'          	=> $fsl_type,
			'fsl_fullWidth'     	=> $fsl_fullWidth,
			'fsl_width'         	=> $fsl_width,
			'fsl_height'       		=> $fsl_height,
			'fsl_links'				=> $fsl_links,
			'fsl_arrowcolor'		=> $fsl_arrowcolor,
			'fsl_prevText'   		=> $fsl_prevText,
			'fsl_nextText'   		=> $fsl_nextText,
			'fsl_navigation'    	=> $fsl_navigation,
			'fsl_textstyle'    		=> $fsl_textstyle,
			'fsl_tfontstyle'		=> array('bgcolor' => $fsl_tbgcolor, 'bgopacity' => '0.8', 'fontfamily' => $fsl_tfontfamily, 'color' => $fsl_tfontcolor, 'size' => $fsl_tfontsize, 'lineheight' => $fsl_tlineheight),
			'fsl_tspacetop'    		=> $fsl_tspacetop,
			'fsl_tspaceleft'    	=> $fsl_tspaceleft,
			'fsl_dfontstyle'		=> array('bgcolor' => $fsl_dbgcolor, 'bgopacity' => '0.8', 'fontfamily' => $fsl_dfontfamily, 'color' => $fsl_dfontcolor, 'size' => $fsl_dfontsize, 'lineheight' => $fsl_dlineheight),
			'fsl_dspacetop'     	=> $fsl_dspacetop,
			'fsl_dspaceleft'     	=> $fsl_dspaceleft,
			'fsl_center'     		=> $fsl_center,
			'fsl_autoPlay'     		=> $fsl_autoPlay,
			'fsl_random'			=> $fsl_random,
			'fsl_hoverPause'		=> $fsl_hoverPause,
			'fsl_delay'         	=> $fsl_delay,
			'fsl_animationSpeed'   	=> $fsl_animationSpeed,
			'fsl_customCss'   		=> $fsl_customCss
		) );

		$FSL_Gallery_Settings = "FSL_Gallery_Settings_".$PostID;
		update_post_meta($PostID, $FSL_Gallery_Settings, $FSL_Settings_Array);
	  }
	}
}

global $FSL;
$FSL = FSL::forge();

/**
 * Fusion Slider Short Code [FSL].
 */
require_once("fusion-slider-short-code.php");

/**
 * Adds the media button to the editor
 */

add_action('media_buttons', 'fsL_add_media_custom_button');
add_action('admin_footer', 'fsL_inline_popup_content');

function fsL_add_media_custom_button() {
    $title =  __("Select Slider to Insert into Page or Post",'FSL_TEXT_DOMAIN');
	$button = __(" FSL Shortcode",'FSL_TEXT_DOMAIN');

	$img = plugins_url( '/assets/admin-scripts/img/slider_icon.png' , __FILE__ );
	$container_id = 'FSL';
	echo '<a class="button button-primary thickbox"  title="'. $title .'" href="#TB_inline?width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.esc_url( $img ).'); background-repeat: no-repeat; background-position: left bottom;"></span>'. $button .'</a>';
} 

function fsL_inline_popup_content() {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#fsl_sliderinsert').on('click', function() {
			var id = jQuery('#fsl-slider-select option:selected').val();
			window.send_to_editor('<p>[FSL id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>
	
	<?php
	echo '<div id="FSL" style="display:none;">';
		$all_posts = wp_count_posts( 'fsl_slider')->publish;
		$args = array('post_type' => 'fsl_slider', 'posts_per_page' =>$all_posts);
		global $fsl_sliders;
		$fsl_sliders = new WP_Query( $args );
		if( $fsl_sliders->have_posts() ) { 
			echo "<h3>" . __( "Insert Fusion Slider Shortcode", "FSL_TEXT_DOMAIN" ) . "</h3>";
			echo "<select id='fsl-slider-select'>";	
			while ( $fsl_sliders->have_posts() ) : $fsl_sliders->the_post(); 
				echo "<option value=".get_the_ID().">". get_the_title(). "</option>";
			endwhile;
			echo "</select>";
			echo "<button class='button primary' id='fsl_sliderinsert'>" . __( "Insert Slider Shortcode", "FSL_TEXT_DOMAIN" ) . "</button>";
		} else {
			_e('No Slider found','FSL_TEXT_DOMAIN');
		}
	echo '</div>';
}

/* Get Video Type */
function fslvideoType($url) {
    if (strpos($url, 'youtube') > 0) {
        $pos = strrpos($url, 'v=');
        $str = substr($url, $pos+2);
        return 'https://www.youtube.com/embed/'.$str;
    } elseif (strpos($url, 'vimeo') > 0) {
        $pos = strrpos($url, '/');
        $str = substr($url, $pos+1);
        return 'https://player.vimeo.com/video/'.$str;
    } 
}

function fsl_get_gallery_value($PostId){
	$FSL_Default_Options = array(
		'fsl_type'  			=> 'responsive',
		'fsl_fullWidth'    		=> 'false',
		'fsl_width' 			=> 900,
		'fsl_height' 			=> 500,
		'fsl_links'   			=> 'true',
		'fsl_arrowcolor'   		=> '#ec0b0b',
		'fsl_prevText'			=> 'Prev',
		'fsl_nextText'			=> 'Next',
		'fsl_navigation'   		=> 'true',
		'fsl_textstyle'			=> 'one',
		'fsl_tfontstyle'		=> array('bgcolor' => '#ec0b0b', 'fontfamily' => 'Georgia', 'color' => '#ffffff', 'size' => '14', 'lineheight' => '18'),
		'fsl_tspacetop'			=> 65,
		'fsl_tspaceleft'		=> 5,
		'fsl_dfontstyle'		=> array('bgcolor' => '#000000', 'fontfamily' => 'Georgia', 'color' => '#ffffff', 'size' => '14', 'lineheight' => '18'),
		'fsl_dspacetop'			=> 74,
		'fsl_dspaceleft'		=> 5,
		'fsl_textalign'    		=> 'left',
		'fsl_center'     		=> 'false',
		'fsl_autoPlay'			=> 'true',
		'fsl_random'           	=> 'false',
		'fsl_hoverPause'		=> 'false',
		'fsl_delay'           	=> 4000,
		'fsl_animationSpeed'   	=> 500,
		'fsl_customCss'			=> ''
	);
	
	$FSL_Settings = "FSL_Gallery_Settings_".$PostId;
	$FSL_Settings = unserialize(get_post_meta( $PostId, $FSL_Settings, true));
	
	$FSL_Settings = wp_parse_args($FSL_Settings , $FSL_Default_Options);
	
	return $FSL_Settings;
}
?>