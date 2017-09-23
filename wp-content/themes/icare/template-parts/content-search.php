<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iCare
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if(has_post_thumbnail()): ?>
	<div class="content_entry">
	  <div class="meta-thumb thumb"> 
		<?php the_post_thumbnail('icare_blog_classic_img'); ?>
	  </div>
	</div>
	<?php endif; ?>
	<div class="meta-content border-1px p-twenty pr-ten">
	  <div class="entry-meta media mt-zero no-bg no-border">
	  	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="meta-date media-left text-center flip icare-theme-bg-colored pt-five pr-fifteen pb-five pl-fifteen">
			<div class="entry-meta">
				<?php icare_posted_on(); ?>
			</div><!-- .entry-meta -->
		</div>
		<?php endif; ?>
		<div class="media-body <?php if ( 'post' === get_post_type() ) {echo "pl-fifteen"; }?> ">
		  <div class="event-content pull-left flip">
			<?php if ( is_single() ) :
			the_title( '<h4 class="meta-title text-uppercase m-zero mt-five">', '</h4>' );
		else :
			the_title( '<h5 class="meta-title text-white text-uppercase m-zero mt-five"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
		endif;?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<span class="mb-ten text-gray-darkgray mr-ten font-13 author vcard"><i class="fa fa-user mr-five icare-text-colored"></i> <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
			<span class="mb-ten text-gray-darkgray mr-ten font-13 post-cats"><i class="fa fa-folder-open mr-five icare-text-colored"></i><?php echo get_the_category_list(','); ?> </span>
			<span class="mb-ten text-gray-darkgray mr-ten font-13"><i class="fa fa-commenting-o mr-five icare-text-colored"></i> <?php esc_url(comments_popup_link(esc_html__('No Comments', 'icare'), esc_html__('1 Comment', 'icare'), esc_html__('% Comments', 'icare'))); ?></span>
			<?php endif; ?>
		  </div>
		</div>
	  </div>
	 <?php the_excerpt(); ?>
	  <div class="clearfix"></div>
	</div>
</article>