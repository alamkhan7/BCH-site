<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iCare
 */
get_header();
get_template_part('breadcrumbs');
$class = esc_attr(get_post_meta(get_the_ID(), 'content_layout', true))=="sidebar-n" ? 'col-md-12' : 'col-md-9 post-content' ?>
<section class="bg-white">
  <div class="container pt-fifty pb-fifty">
	<div class="row">
	  <div class="<?php echo esc_attr($class); ?>">
		<div class="blog-posts single-post"><?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; ?>
			</div>
		  </div>
		  <?php icare_pagination(); ?>
		  <?php if(get_post_meta(get_the_ID(), 'content_layout', true)!="sidebar-n") {get_sidebar(); } ?>
	</div>
  </div>
</section>
<?php get_footer(); ?>
