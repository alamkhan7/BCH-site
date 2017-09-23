<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package iCare
 */

if (!function_exists('icare_posted_on')):
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
    function icare_posted_on()
{
        if (get_the_title() == "") {
            $time_string = '<ul class="feed-date"><li class="border-bottom"><a href="' . get_the_permalink() . '">%2$s</a></li><li class="font-twelve text-uppercase"><a href="' . get_the_permalink() . '">%3$s</a></li><li><time class="meta-date published updated" datetime="%1$s"></time></li></ul>';
        } else {
            $time_string = '<ul class="feed-date"><li class="border-bottom">%2$s</li><li class="font-twelve text-uppercase">%3$s</li><li><time class="meta-date published updated" datetime="%1$s"></time></li></ul>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date('d')),
            esc_html(get_the_date('M'))
        );

        $byline = sprintf(
            esc_html_x('by %s', 'post author', 'icare'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo $time_string; // WPCS: XSS OK.

    }
endif;

if (!function_exists('icare_entry_footer')):
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
    function icare_entry_footer()
{
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'icare'));
            if ($categories_list && icare_categorized_blog()) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'icare') . '</span>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'icare'));
            if ($tags_list) {
                printf('<span class="tagcloud-links">' . esc_html__('Tagged %1$s', 'icare') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link(sprintf(wp_kses(esc_html__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'icare'), array('span' => array('class' => array()))), get_the_title()));
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                /* translators: %s: Name of current post */
                esc_html__('Edit %s', 'icare'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function icare_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('icare_categories'))) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('icare_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so icare_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so icare_categorized_blog should return false.
        return false;
    }
}
/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function icare_excerpt_more($more)
{
    return sprintf('<br><a class="btn-read-more" href="%1$s">%2$s</a>',
        get_permalink(get_the_ID()),
        esc_html__('Read More', 'icare')
    );
}
add_filter('excerpt_more', 'icare_excerpt_more');

/**
 * Flush out the transients used in icare_categorized_blog.
 */
function icare_category_transient_flusher()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('icare_categories');
}
add_action('edit_category', 'icare_category_transient_flusher');
add_action('save_post', 'icare_category_transient_flusher');

/* Tags and links */
function icare_tags_links()
{?>
<div class="tagline p-zero pt-twenty mt-five">
	<div class="row">
	  <div class="col-md-8"><?php
if (get_the_tags()) {?>
		<div class="tags">
		  <p class="mb-zero"><i class="fa fa-tags icare-text-colored"></i> <span><?php esc_html_e('Tags:', 'icare');?></span><?php esc_attr(the_tags(' ', ', ', ''));?></p>
		</div><?php
}?>
	  </div>
	  <div class="col-md-4">
		<div class="share text-right flip">
		  <ul class="pager">
			<li class="previous"><?php previous_post_link('%link', esc_html__('&laquo; Older', 'icare'));?></li>
			<li class="next"><?php next_post_link('%link', esc_html__('Newer &raquo;', 'icare'));?></li>
		</ul>
		</div>
	  </div>
	</div>
</div><?php
}

/* About Author */
function icare_about_author()
{?>
	<div class="author-info author-bio">
	<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="meta-thumb mb-zero pull-left flip pr-twenty"><?php echo get_avatar(get_the_author_meta('ID'), 126); ?></a>
	<div class="post-right">
	  <h5 class="post-title mt-zero mb-zero"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="font-eightheen"><?php esc_attr(the_author());?></a></h5>
	  <p><?php esc_attr(the_author_meta('description'));?></p>
	</div>
	<div class="clearfix"></div>
  </div><?php
}
?>
