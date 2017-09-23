<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iCare
 */

get_header(); ?>
<section class="inner-header-transform divider parallax section-overlay breadcrumb-overlay">
  <div class="container pt-thirty pb-thirty">
	<!-- Section Content -->
	<div class="section-content">
	  <div class="row"> 
		<div class="col-sm-8 text-left flip xs-text-center">
			<?php the_archive_title( '<h2 class="title">', '</h2>' );
			the_archive_description( '<div class="archive-description">', '</div>' );?>
		</div>
		<div class="col-sm-4">
		  <?php icare_breadcrumbs(); ?>
		</div>
	  </div>
	</div>
  </div>
</section>
<section>
  <div class="container mt-thirty mb-thirty pt-thirty pb-thirty">
	<div class="row">
	  <div class="col-md-9">
		<div class="blog-posts">
		  <div class="col-md-12">
			<div class="row list-dotted">
			  
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

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
			</div>
		  </div>
		  <?php icare_pagination(); ?>
		</div>
	  </div>
		  <?php get_sidebar(); ?>
	</div>
  </div>
</section>
<?php
get_footer();
