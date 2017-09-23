
<!-- Section: Call To Action -->
 <?php if (get_theme_mod('icare_show_cta') !='on') {return;}?>
<section id="icare-home-cta-section" class="icare-theme-bg-colored border-left border-3pt text-center">
  <div class="container pt-zero pb-zero">
    <div class="row">
      <div class="col-md-12">
        <div class="call-to-action pt-fifty pb-fifty">
        <?php if (get_theme_mod('icare_calltoaction_title') != "") {?>
          <h3 id="cta_title" class="mt-0 text-white"><?php echo esc_attr(get_theme_mod('icare_calltoaction_title')); ?></h3>
        <?php }?>

        <?php if (get_theme_mod('icare_calltoaction_btn1_url') != "" && get_theme_mod('icare_calltoaction_btn1_text') != ""): ?>
              <a href="<?php echo esc_url(get_theme_mod('icare_calltoaction_btn1_url')); ?>" id="cta_btn" class="btn btn-default btn-transparent mr-ten"><?php echo esc_attr(get_theme_mod('icare_calltoaction_btn1_text')); ?></a>
        <?php endif;?>
          <?php if (get_theme_mod('icare_calltoaction_btn2_url') != "" && get_theme_mod('icare_calltoaction_btn2_text') != ""): ?>
              <a href="<?php echo esc_url(get_theme_mod('icare_calltoaction_btn2_url')); ?>" id="cta_btn" class="btn btn-colored btn-dark"><?php echo esc_attr(get_theme_mod('icare_calltoaction_btn2_text')); ?></a>
        <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</section>