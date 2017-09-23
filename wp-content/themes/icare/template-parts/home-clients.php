<?php if(get_theme_mod('icare_show_client_logo')=='on'){?>
<!-- Divider: Clients -->
<section class="icare-home-clients-section">
  <div class="container pb-thirty"><?php
    if (get_theme_mod('icare_client_head') != "" || get_theme_mod('icare_client_desc') != "") {?>
    <div class="section-heading text-center">
      <div class="row">
      <div class="col-md-12">
      <?php if (get_theme_mod('icare_client_head') != "") {?>
        <h2 class="mt-zero mb-fifteen line-height-one client title"><?php echo esc_attr(get_theme_mod('icare_client_head')); ?></h2>
        <?php } if (get_theme_mod('icare_client_desc') != "") {?>
            <p id="client_desc"><?php echo esc_attr(get_theme_mod('icare_client_desc')); ?></p>
            <?php } ?>
      </div>
      </div>
    </div><?php
  }?>
  <div class="section-content">
    <div class="row">
      <div class="col-md-12">
        <?php 
        $icare_client_logo_image = get_theme_mod('icare_client_logo_image');
        $icare_client_logo_image = explode(',', $icare_client_logo_image);
        ?>
        <!-- Section: Clients -->
        <div class="owl-carousel-6col text-center">
          <?php
          foreach ($icare_client_logo_image as $icare_client_logo_image_single) {
            $image = wp_get_attachment_image_src( $icare_client_logo_image_single, 'full');
            ?>
            <img src="<?php echo esc_url( $image[0] ); ?>">
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>
<?php } ?>