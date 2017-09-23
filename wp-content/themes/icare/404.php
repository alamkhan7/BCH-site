<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
		  <h2 class="title"><?php esc_html_e('Error 404', 'icare');?></h2>
		</div>
		<div class="col-sm-4">
		  <?php icare_breadcrumbs(); ?>
		</div>
	  </div>
	</div>
  </div>
</section>
<section id="fof">
  <div class="display-table text-center">
	<div class="display-table-cell">
	  <div class="container pt-zero pb-zero">
		<div class="row">
		  <div class="col-md-8 col-md-offset-2">
			<h1 class="font-one50 icare-text-colored mt-zero mb-zero"><i class="fa fa-map-signs text-gray-silver"></i><?php esc_html_e( '404!', 'icare'); ?></h1>
			<h2 class="mt-zero"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'icare' ); ?></h2>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'icare' ); ?></p>
			<?php get_search_form(); ?>
			<a class="btn btn-border btn-default btn-circled" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'icare'); ?></a>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</section>
<?php
get_footer();
