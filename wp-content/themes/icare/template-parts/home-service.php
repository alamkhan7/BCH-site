<!-- Section: Why Choose Us  -->
<?php if (get_theme_mod('icare_show_services') == 'on') {    ?>
<section id="icare-home-service-section" >
  <div class="container pb-thirty"><?php
if (get_theme_mod('icare_service_head') != "" || get_theme_mod('icare_service_desc') != "") {?>
	<div class="section-heading text-center">
	  <div class="row">
		<div class="col-md-12">
		<?php if (get_theme_mod('icare_service_head') != "") {?>
		  <h2 class="mt-zero mb-fifteen line-height-one service title"><?php echo esc_attr(get_theme_mod('icare_service_head')); ?></h2>
		  <?php } if (get_theme_mod('icare_service_desc') != "") {?>
          <p id="service_desc"><?php echo esc_attr(get_theme_mod('icare_service_desc')); ?></p>
          <?php } ?>
		</div>
	  </div>
	</div><?php
}?>
	<div class="section-content">
	  <div class="row mtli-row-clearfix"><?php
		for ($i = 1; $i < 7; $i++) {
        	$icare_service_page_id   = get_theme_mod('icare_service_page' . $i);
        	$icare_service_page_icon = get_theme_mod('icare_service_page_icon' . $i);

	        if ($icare_service_page_id) {
	            $args  = array('page_id' => absint($icare_service_page_id));
	            $query = new WP_Query($args);
	            if ($query->have_posts()):
	                while ($query->have_posts()): $query->the_post();
	                    ?>
					<div class="col-xs-12 col-sm-6 col-md-4">
			          <div class="icare-icon-box p-twenty mb-thirty border-1pt hvr-float-shadow">
			            <div class="media-left">
			            <a id="service_ico_img<?php echo $i;?>" class="icon icon-color flip mb-zero mr-zero mt-five" href="<?php the_permalink(); ?>">
			             <?php if(get_theme_mod('icare_service_img_or_icon' . $i)=='img' && get_theme_mod('icare_service_page_img' . $i)!=""):?>
			              	<img src="<?php echo esc_url_raw(get_theme_mod('icare_service_page_img' . $i));?>" alt="<?php the_title(); ?>">
			              <?php else: ?>
			                <i class="<?php echo esc_attr($icare_service_page_icon); ?> icare-text-colored"></i>
			            <?php endif; ?>
			            </a>
			              </div>
			            <div class="icon-box-details media-body">
			              <h5 class="icon-box-title m-zero mb-five"><?php the_title(); ?></h5>
			              <p class="mb-zero"><?php 
								if(has_excerpt()){
									echo get_the_excerpt();
								}else{
									echo icare_excerpt( get_the_content(), 100);
								}
							 ?>
							</p>
			              <a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'icare' ); ?></a>
			            </div>
			          </div>
			        </div>
			        <?php
	   				 endwhile;
	            endif;
            	wp_reset_postdata();
        	}
    	}	?>
	  </div>
	</div>
  </div>
</section>
<?php }?>