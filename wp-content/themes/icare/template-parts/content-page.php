<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iCare
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix mb-zero'); ?>>
<?php if(has_post_thumbnail()): ?>
	<div class="content_entry pb-twenty">
	  <div class="meta-thumb thumb"> 
		<?php the_post_thumbnail('icare_blog_classic_img',array('class'=>'img-responsive img-fullwidth')); ?>
	  </div>
	</div>
	<?php endif; ?>
	 <?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'icare' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'icare' ),
				'after'  => '</div>',
			) );
		?>
</article>
<?php if ( get_edit_post_link() ) : ?>
<footer class="entry-footer">
	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'icare' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	?>
</footer><!-- .entry-footer -->
<?php endif; ?>
