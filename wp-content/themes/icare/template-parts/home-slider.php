<?php
if(get_theme_mod('icare_slider_shortcode') && get_theme_mod('icare_slider_shortcode')!="" && get_theme_mod('icare_show_hero')=='on'){
	echo do_shortcode(get_theme_mod('icare_slider_shortcode'));
}elseif(get_theme_mod('icare_hero_image') && get_theme_mod('icare_hero_image')!="" && get_theme_mod('icare_show_hero')=='on') {?>
<section id="icare-home-slider-section">
	<div class="container-fluid p-zero wrap">
		<div class="h_bg"><img class="img-reponsive" alt="<?php echo esc_attr(get_theme_mod('icare_hero_title'));?>" src="<?php echo esc_url(get_theme_mod('icare_hero_image'));?>"/></div>
		<div class="text-wrap">
		<?php if(get_theme_mod('icare_hero_title')!=""){?>
		<h2 id="h_title" class="tp-caption tp-resizeme text-uppercase text-white font-raleway icare-theme-bg-colored-transparent"><?php echo esc_attr(get_theme_mod('icare_hero_title'));?></h2>
		<?php } ?>
		<?php if(get_theme_mod('icare_hero_desc')!=""){?>
		<h2 id="h_subtitle" class="tp-caption tp-resizeme text-uppercase text-white font-raleway"><?php echo esc_attr(get_theme_mod('icare_hero_desc'));?></h2>
		<?php } ?>
		</div>
	</div>
</section>
<?php } ?>