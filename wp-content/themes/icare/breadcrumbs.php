<?php 
if(get_theme_mod('icare_crumb_and_title')=="not_of_them") return; 
$data_bg_img='';
$classes="icare-breadcrumbs inner-header-transform ";
if(get_theme_mod('icare_breadcrumbs_bg_video')!=""){
  $classes = 'inner-header no-bg breadcrumb-overlay';
}elseif(get_theme_mod('icare_breadcrumbs_bg_image')!=""){$data_bg_img = 'data-bg-img="'.esc_url(get_theme_mod('icare_breadcrumbs_bg_image')).'"'; $classes.=" parallax";
}
if(get_theme_mod('icare_crumb_title_align')=="right"){
  $titleClass = "col-md-8 pull-right flip text-right flip xs-pull-none xs-text-center";
  $brcrumbClass = "pull-left flip xs-pull-none";
}elseif(get_theme_mod('icare_crumb_title_align')=="center"){
  $titleClass = "col-md-12 text-center";
  $brcrumbClass = "col-md-4 pull-left flip xs-pull-none";
}else{
  $titleClass = "col-sm-8 text-left flip xs-text-center";
  $brcrumbClass = '';
}
?>
<section class="<?php echo $classes; ?>" <?php echo $data_bg_img; ?>>
	<?php if(get_theme_mod('icare_breadcrumbs_bg_video')!=""){ ?>
  <div class="bg-video">
    <div id="home-video" class="video">
      <div class="player video-container" data-property="{videoURL:'<?php echo esc_url(get_theme_mod('icare_breadcrumbs_bg_video')); ?>',containment:'#home-video',autoPlay:true, showControls:false, mute:false, startAt:0, opacity:1}"></div>
    </div>
  </div><?php 
  } ?>
  <div class="container brcmb-container">
	<!-- Section Content -->
	<div class="section-content">
	  <div class="row"><?php if(get_theme_mod('icare_crumb_and_title')=="allow_title" || get_theme_mod('icare_crumb_and_title')=="allow_both"):?> 
		<div class="<?php echo $titleClass; ?>">
		  <h2 class="title"><?php single_post_title(); ?></h2>
		  <?php if(get_theme_mod('icare_crumb_title_align')=="center" && get_theme_mod('icare_crumb_and_title')=="allow_both"):
              icare_breadcrumbs();
              endif; ?>
		</div>
		<?php endif; ?>
		<?php if(get_theme_mod('icare_crumb_title_align')!="center" && get_theme_mod('icare_crumb_and_title')=="allow_both"):?>
		<div class="<?php echo $brcrumbClass; ?>">
		  <?php icare_breadcrumbs(); ?>
		</div>
		<?php endif; ?>
	  </div>
	</div>
  </div>
</section>