<?php
 if(get_theme_mod('icare_show_features')=='off'){ return ; }?>
<!-- Section: chooseus -->
<section id="icare-home-feature-section" class="divider parallax layer-overlay overlay-blue" <?php if(get_theme_mod('icare_feature_bg_img')!=""){ echo 'data-bg-img="'.esc_url(get_theme_mod('icare_feature_bg_img')).'"';}?>>
  <div class="container pb-0">
    <div class="section-content">     
      <div class="row">
        <div class="col-md-8 col-md-push-4">              
          <div class="row features-style1">
            <div class="col-sm-12">
              <?php if(get_theme_mod('icare_feature_head')!=''):?>
                <h2 id="feature-title" class="text-white pl-fifteen mb-twenty"><?php echo esc_attr(get_theme_mod('icare_feature_head'));?></h2>
              <?php endif; ?>
              <?php if(get_theme_mod('icare_feature_desc')!=''):?>
              <p id="feature-desc" class="font-twenty text-white-f3 pl-fifteen mb-thirty"><?php echo esc_attr(get_theme_mod('icare_feature_desc'));?></p>
              <?php endif; ?>
              <?php 
                for( $i = 1; $i < 5; $i++ ){
                  $icare_feature_page_id = get_theme_mod('icare_feature_page'.$i); 
                  $icare_feature_page_icon = get_theme_mod('icare_feature_page_icon'.$i);
                  if($icare_feature_page_id){
                    $args = array( 'page_id' => absint($icare_feature_page_id) );
                    $query = new WP_Query($args);
                    if($query->have_posts()):
                      while($query->have_posts()) : $query->the_post();
                    ?>
                      <div class="col-sm-6">
                        <div class="icare-icon-box service left media p-zero">
                        <a id="feature_ico_img<?php echo $i;?>" class="icon icon-md icon-circled border-1pt pull-left flip icon-hov" href="<?php the_permalink(); ?>">
                         <?php if(get_theme_mod('icare_feature_img_or_icon' . $i)=='img' && get_theme_mod('icare_feature_page_img' . $i)!=""):?>
                            <img src="<?php echo esc_url_raw(get_theme_mod('icare_feature_page_img' . $i));?>" alt="<?php the_title(); ?>">
                          <?php else: ?>
                            <i class="<?php echo esc_attr($icare_feature_page_icon); ?>"></i>
                        <?php endif; ?>
                        </a>
                          <div class="media-body">
                           <h5 class="media-heading heading"> <a class="text-white" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p class="text-white-f3">
                              <?php 
                              if(has_excerpt()){
                                echo get_the_excerpt();
                              }else{
                                echo icare_excerpt( get_the_content(), 100);
                              }
                           ?><br/>
                           <a class="text-white ml-five" href="<?php the_permalink();?>"><?php _e('Read More','icare');?> &rarr;</a>
                            </p>
                          </div>
                        </div>
                      </div>

                    <?php
                    endwhile;
                    endif;  
                    wp_reset_postdata();
                  }
                }?>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-md-pull-8" data-margin-top="-45px">
          <?php 
          $icare_feature_widget = get_theme_mod('icare_feature_widget');
          if($icare_feature_widget){
            dynamic_sidebar($icare_feature_widget);
          }else{
            $icare_feature_image = get_theme_mod('icare_feature_image');
            echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($icare_feature_image).'"/>';
          }
        ?>
        </div>
      </div>     
    </div>
  </div>
</section>