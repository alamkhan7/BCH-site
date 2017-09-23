<?php if(get_theme_mod('icare_show_funfact')=='on'){ ?>
<!-- Divider: Funfact -->
<section id="icare-home-funfacts-section" class="divider parallax layer-overlay overlay-dark-7" <?php if(get_theme_mod('icare_funfact_bg')!=""){ echo 'data-bg-img="'.esc_url(get_theme_mod('icare_funfact_bg')).'"'; } ?> data-parallax-ratio="0.7">
  <div class="container pt-ninty pb-ninty">
    <div class="row"><?php 
      $anim_dura = 1500;
      $wow_delay = 0.2;
      for( $i = 1; $i < 5; $i++ ){
        $icare_counter_title = get_theme_mod('icare_counter_title'.$i); 
        $icare_counter_count = get_theme_mod('icare_counter_count'.$i);
        $icare_counter_icon = get_theme_mod('icare_counter_icon'.$i);
        if($icare_counter_count){?>
      <div class="col-xs-12 col-sm-6 col-md-3 mb-md-fifty wow fadeInLeft" data-wow-duration="1s" data-wow-delay="<?php echo $wow_delay+=0.1; ?>s">
        <div class="funfact">
          <i class="<?php echo esc_attr($icare_counter_icon); ?> text-white-f1 mt-twenty font-fourty8 pull-left flip"></i>
          <div class="ml-sixty">
            <h2 class="animate-number text-white-f1 mt-zero mb-zero font-fourty8 line-bottom" data-value="<?php echo absint($icare_counter_count); ?>" data-animation-duration="<?php echo absint($anim_dura+=500); ?>">0</h2>
            <div class="clearfix"></div>
            <h5 class="text-white-f1"><?php echo esc_html($icare_counter_title); ?></h5>
          </div>
        </div>
      </div>
      <?php } } ?>
    </div>
  </div>
</section>
<?php } ?>