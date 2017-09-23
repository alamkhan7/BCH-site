<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package iCare
 */

get_header();
get_template_part('breadcrumbs');
$class = esc_attr(get_post_meta(get_the_ID(), 'content_layout', true))=="sidebar-n" ? 'col-md-12' : 'col-md-9 post-content';?>
<section class="bg-white">
  <div class="container pt-fifty pb-fifty">
	<div class="row">
	  <div class="<?php echo esc_attr($class); ?>">
		<div class="blog-posts single-post">
			  <?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
					// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
			</div>
		  </div>
		  <?php icare_pagination(); ?>
		  <?php if(get_post_meta(get_the_ID(), 'content_layout', true)!="sidebar-n") {get_sidebar(); } ?>
	</div>
  </div>
</section>
<?php
get_footer();
