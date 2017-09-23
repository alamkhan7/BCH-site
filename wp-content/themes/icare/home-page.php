<?php
// Template Name: Home
get_header();

	get_template_part('template-parts/home','slider'); 
	$sections = json_decode(get_theme_mod('icare_home_reorder'),true);
	foreach ($sections as $section) {
		get_template_part('template-parts/home', $section);
	}

get_footer(); ?>