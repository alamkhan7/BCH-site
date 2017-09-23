<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Icare_Pro_Control' ) ) :
class Icare_Pro_Control extends WP_Customize_Control {

    /**
    * Render the content on the theme customizer page
    */
    public function render_content() {
        ?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md-2 col-sm-6 upsell-btn">                  
                    <a style="margin-bottom:20px;margin-left:20px;" href="http://www.webhuntinfotech.com/webhunt_theme/icare-premium/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Icare Premium','icare'); ?> </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <img class="icare_img_responsive " src="<?php echo get_template_directory_uri() .'/assets/images/Icare_Pro.png'?>">
            </div>          
            <div class="col-md-3 col-sm-6">
                <h3 style="margin-top:10px;margin-left: 20px;text-decoration:underline;color:#333;"><?php echo _e( 'icare Premium - Features','icare'); ?></h3>
                    <ul style="padding-top:10px">
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Responsive Design','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Beautiful & Amazing Shortcodes','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Revolution Slider','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('About us temaplate ','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Contact Us template','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Testimonial Sections','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('2 Types Our Features Sections','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Team Section','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Department Section','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Pricing Tables','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('3 Types Footer Call to actions','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Stylish Custom Widgets','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Redux Options Panel','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Unlimited Colors Scheme','icare'); ?></li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Patterns Background','icare'); ?>   </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Woo-commerce Compatible','icare'); ?>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Coming Soon/Maintenance Mode Option','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Translation Ready','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Free Updates','icare'); ?> </li>
                        <li class="upsell-icare"> <div class="dashicons dashicons-yes"></div> <?php _e('Quick Support','icare'); ?> </li>
                    </ul>
            </div>
            <div class="col-md-2 col-sm-6 upsell-btn upsell-btn-bottom">                    
                    <a style="margin-bottom:20px;margin-left:20px;" href="http://www.webhuntinfotech.com/webhunt_theme/icare-premium/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Icare Premium','icare'); ?> </a>
            </div>
            
            <p>
                <?php
                    printf( __( 'If you Like our Products , Please Rate us 5 star on %sWordPress.org%s.  We\'d really appreciate it! </br></br>  Thank You', 'icare' ), '<a target="" href="https://wordpress.org/support/view/theme-reviews/icare?filter=5">', '</a>' );
                ?>
            </p>
        </label>
        <?php
    }
}
endif;