<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package iCare
 */
?>
</div>  
  <!-- end main-content -->

  <!-- Footer -->
  <footer id="footer" class="icare-footer">
	<?php if ( get_theme_mod('icare_show_footer_widget') == true) { ?>
    <div class="container pt-sixty pb-thirty">
      <div class="row border-bottom-black">
        
        <?php 
        if (is_active_sidebar( 'footer-1' ) ):
          dynamic_sidebar( 'footer-1' );
        else:
          $col = get_theme_mod('icare_footer_widget_column');
           $args = array(
                'before_widget' => '<div class="col-sm-6 col-md-'.$col.'"><div class="icare-widget dark">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h5 class="icare-widget-title widget-title-border-bottom">',
                'after_title'   => '</h5>',
            );
        the_widget('WP_Widget_Archives', null, $args);
        the_widget('WP_Widget_Meta', null, $args);
        the_widget('WP_Widget_Pages', null, $args);
        the_widget('WP_Widget_Search', null, $args);
        endif;?>
			
      </div>
    </div><?php
	} 	?>
    <div class="icare-footer-bottom">
      <div class="container pt-twenty pb-twenty">
        <div class="row">
          <div class="col-md-6 sm-text-center">
            <span id="icare-copyright-text"><?php echo esc_attr(get_theme_mod('icare_footer_copyright_text')); ?></span>
			
			<a href="<?php echo esc_url(get_theme_mod('icare_footer_copyright_link'));?>" rel="author" id="icare-copyright-link"><?php echo esc_attr(get_theme_mod('icare_footer_copyright_link_text'));?></a>
          </div>
          <?php if(get_theme_mod('icare_footer_social_or_menu')!=""):?>
          <div class="col-md-6 text-right flip sm-text-center">
            <div class="icare-widget border-none m-zero"><?php
              if(has_nav_menu( 'footer-menu' ) && get_theme_mod('icare_footer_social_or_menu')=='social-links'):
          wp_nav_menu( array(
            'menu_id' => 'footer-menu',
            'theme_location' => 'footer-menu',
            'container'   =>false,
            'menu_class'     => 'styled-icons icon-dark icon-circled  ',
            'depth'          => 1,
            'link_before'    => '<span class="screen-reader-text">',
            'link_after'     => '</span>' . icare_get_svg( array( 'icon' => 'chain' ) ),
          ) );
        elseif(has_nav_menu( 'footer-menu' ) && get_theme_mod('icare_footer_social_or_menu')=='simple-links'):
          wp_nav_menu( array(
            'menu_id' => 'footer-menu',
            'theme_location' => 'footer-menu',
            'container'   =>false,
            'menu_class'     => 'list-inline sm-text-center mb-zero',
            'depth'          => 1
          ) );
        endif;?>
            </div>
          </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </footer>
  <a class="iCareTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<?php wp_footer(); ?>

</body>
</html>
