<?php if (get_theme_mod('icare_show_team') == 'on') {    ?>
<section id="icare-home-team-section">
  <div class="container pb-30 pb-sm-0">
  <?php if (get_theme_mod('icare_team_head') != "" || get_theme_mod('icare_team_desc') != "") {?>
    <div class="section-title text-center">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <?php if (get_theme_mod('icare_team_head') != "") {?>
          <h2 class="mt-0 line-height-1 text-center text-uppercase"><?php echo esc_attr(get_theme_mod('icare_team_head')); ?></h2>
          <?php } if (get_theme_mod('icare_team_desc') != "") {?>
          <p><?php echo esc_attr(get_theme_mod('icare_team_desc')); ?></p>
          <?php } ?>
        </div>
      </div>
    </div><?php 
    } ?>
    <div class="section-content">
      <div class="row"><?php
        for ($i = 1; $i < 5; $i++) {
          $icare_team_page_id   = get_theme_mod('icare_team_page' . $i);
          if ($icare_team_page_id) {
              $args  = array('page_id' => absint($icare_team_page_id));
              $query = new WP_Query($args);
              if ($query->have_posts()):
                  while ($query->have_posts()): $query->the_post();
                  $icare_team_designation = get_theme_mod('icare_team_designation'.$i);
                  $icare_team_facebook = get_theme_mod('icare_team_facebook'.$i);
                  $icare_team_twitter = get_theme_mod('icare_team_twitter'.$i);
                  $icare_team_google_plus = get_theme_mod('icare_team_google_plus'.$i);?>
        <div class="col-sm-6 col-md-3 mb-sm-30">
          <div class="team-block">
          <a href="<?php the_permalink(); ?>">
            <div class="team-thumb">
            <?php if( has_post_thumbnail() ){
                the_post_thumbnail('icare_home_team_profile',array("class"=>'img-full-width'));
                } ?>
              <div class="team-overlay">
                <p class="text-white font-13 mt-10"><?php 
                  if(has_excerpt()){
                    echo get_the_excerpt();
                  }else{
                    echo icare_excerpt( get_the_content(), 70);
                  }?></p>
              </div>
            </div>
            </a>
            <div class="info bg-white text-center">
              <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?> <small>- <?php echo esc_attr($icare_team_designation); ?></small></h4></a>
              <ul class="styled-icons icon-theme-colored icon-circled icon-dark icon-sm mt-15 mb-0">
                <li><a href="<?php echo esc_url($icare_team_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                <li><a href="<?php echo esc_url($icare_team_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?php echo esc_url($icare_team_google_plus); ?>"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      <?php endwhile; 
      endif; 
      } 
    }?>
      </div>
    </div>
  </div>
</section>
<?php } ?>