<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iCare
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if ( have_comments() ) : ?>
<div id="comments" class="comments-area">
	<h5 class="comments-title">
	<?php $comments_number = get_comments_number();
	if ( '1' === $comments_number ) {
		/* translators: %s: post title */
		printf( _x( 'One Comment on &ldquo;%s&rdquo;', 'comments title', 'icare' ), get_the_title() );
	} else {
		printf(
			/* translators: 1: number of comments, 2: post title */
			_nx(
				'%1$s Comment on &ldquo;%2$s&rdquo;',
				'%1$s Comments on &ldquo;%2$s&rdquo;',
				$comments_number,
				'comments title',
				'icare'
			),
			number_format_i18n( $comments_number ),
			'<span>' . get_the_title() . '</span>'
		);
	} ?> </h5>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'icare' ); ?></h2>
			<ul class="pager">
				<li class="previous"><?php previous_comments_link( esc_html__( '&larr; Older', 'icare' ) ); ?></li>
				<li class="next"><?php next_comments_link( esc_html__( 'Newer &rarr;', 'icare' ) ); ?></li>
			</ul>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>
		
	<ul class="comment-list">
		<?php
			wp_list_comments( 'callback=icare_comments&style=li&avatar_size=75' );
		?>
	  <li>
	</ul><?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'icare' ); ?></p>
	<?php
	endif; ?>
</div>
 <?php endif;
 if ( ! comments_open() ) return; ?>
	<div class="comment-box">
			<div class="col-sm-12"><?php
			$fields = array(	
				'author' =>'<div class="col-sm-6 pt-zero pb-zero">
				  <div class="form-group">
					<input type="text" class="form-control" required name="author" id="contact_name" placeholder="' . esc_attr('Name (required)', 'icare') . '">
				  </div>',
				  'email' => '<div class="form-group">
					<input type="text" required class="form-control" name="email" id="contact_email2" placeholder="' . esc_attr('Email (required)', 'icare') . '">
				  </div>',
				  'website' => '<div class="form-group">
					<input type="text" placeholder="' . esc_attr('Website', 'icare') . '" required class="form-control" name="url">
				  </div>
				</div>'
			);
			function icare_comment_defaullt_fields($fields)
			{
				return $fields;
			}

			add_filter('icare_comment_form_default_fields', 'icare_comment_defaullt_fields');
			$comments_args = array(
				'fields' => apply_filters('icare_comment_form_default_fields', $fields),
				'label_submit' => esc_html__('Submit Message', 'icare'),
				'title_reply_to' =>  sprintf('<h5>%s</h5><div class="row">',esc_html__('Leave a Reply to %s', 'icare')),
				'title_reply' => sprintf('<h5>%s</h5><div class="row">',esc_html__("Leave a reply", 'icare')),
				 'comment_notes_after' => '', 
				'comment_field' => ' <div class="col-sm-6">
                          <div class="form-group">
                            <textarea class="form-control" required name="comment" id="contact_message2"  placeholder="' . esc_attr('Comment&hellip;', 'icare') . '" rows="7"></textarea>
                          </div></div>',
				'class_submit' => 'btn btn-dark btn-flat pull-right m-zero',
				'id_form'           => 'comment-form',
				'class_form'      => 'row',
			);
			comment_form($comments_args);
			?>
			</div>
		</div>
	</div>
