<?php 
if(get_theme_mod('icare_show_post')!='on'){return;}
$query = array('post_type' => 'post', 'posts_per_page' =>3 ,'post__not_in' => get_option( 'sticky_posts' ));
if (query_posts($query)) {?>
<section id="icare-home-blog-section">
  <div class="container pb-sm-thirty"><?php 
  if(get_theme_mod('icare_home_blog_title')!=""){ ?>
    <div class="section-heading text-center">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
          <h2 class="mt-zero line-height-one text-center text-uppercase" id="home_blog_title"> 
          <?php echo esc_attr(get_theme_mod('icare_home_blog_title'));?></h2>
        </div>
      </div>
    </div><?php 
    } ?>
    <div class="section-content">
      <div class="row"><?php
      while (have_posts()):the_post(); ?>
        <div class="col-sm-4 col-md-4 col-lg-4 wow fadeInLeft hvr-float-shadow" data-wow-duration="1s" data-wow-delay="0.3s">
          <article class="home-posts post clearfix mb-sm-thirty bg-lighter">
            <?php if(has_post_thumbnail()): ?>
              <div class="content_entry">
                <div class="meta-thumb thumb">
    				<?php the_post_thumbnail('icare_home_blog_thumb',array('class'=>'img-responsive img-fullwidth'));?>
          </div>
        </div><?php
    			  endif; ?>
            <div class="meta-content p-twenty pr-ten">
              <div class="entry-meta media mt-zero mb-ten bg-none border-none">
                <div class="meta-date media-left text-center flip icare-theme-bg-colored pt-five pr-fifteen pb-five pl-fifteen">
                  <?php icare_posted_on(); ?>
                </div>
                <div class="media-body pl-fifteen">
                  <div class="event-content pull-left flip">
                    <h5 class="meta-title text-white text-uppercase m-zero mt-five"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <span class="mb-ten text-darkgray mr-ten font-thirteen author vcard"><i class="fa fa-user mr-five icare-text-colored"></i> <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
              			<span class="mb-ten text-darkgray mr-ten font-thirteen"><i class="fa fa-commenting-o mr-five icare-text-colored"></i> <?php esc_url(comments_popup_link(esc_html__('No Comments', 'icare'), esc_html__('1 Comment', 'icare'), esc_html__('% Comments', 'icare'))); ?></span>
                  </div>
                </div>
              </div>
              <?php the_excerpt(); ?>
              <div class="clearfix"></div>
            </div>
          </article>
        </div>
          <?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</section><?php } ?>