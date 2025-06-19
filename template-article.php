<?php

/**
 * Template Name: Articles
 */

get_header();

?>

<div id="content" class="page">
	<div class="page-intro">
   	 	<?php if( get_field('article_cover') ): ?>
      	<div class="intro-inner" style="background-image: url('<?php the_field('article_cover'); ?>')">
		<?php endif; ?>
			<div class="outer-inner">
				<div class="container inner-box clearfix">
					<div class="inner-box-container">
						<div class="intro-title">
							<h1><?php the_title(); ?> </h1>
						</div>
					</div><!-- end .inner-container -->
				</div><!-- end .inner-box -->
			</div><!-- end .outer-inner -->
		</div><!-- end .intro-inner -->
  	</div><!-- end .page-intro -->

    <div class="content-wrap margintb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
					<?php
					// the query
					$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>

					<?php if ( $wpb_all_query->have_posts() ) : ?>

					    <!-- the loop -->
					    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
					        <div class="box-list">
								<?php
				                    // get image alt
				                    $thumb_id = get_post_thumbnail_id(get_the_id());
				                    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
				                    $title = get_the_title($thumb_id);
				                    count(array($alt));
				                ?>
								<?php
	                                if ( has_post_thumbnail() ) {
	                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	                                    echo '<img src="'.$image[0].'" data-id="'.$post->ID.'" class="img-fluid" alt="'.$alt.'" title="'.$title.'">';
	                                }
                                ?>
								<div class="meta">
                                    <span class="author"><i class="ti-user"></i>by <?php the_author(); ?></span>
                                    <span class="date"><i class="ti-calendar"></i><?php echo get_the_date('d F Y', strtotime('post_date')); ?></span>
                                </div>

                                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h4>
                                <?php echo the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="btn unibtn unibtn__background unibtn__arrow">read more article</a>
							</div>
					    <?php endwhile; ?>
					    <!-- end of the loop -->

					    <?php wp_reset_postdata(); ?>

					<?php else : ?>
					    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>

                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <aside class="sidebar sidebar-right">
                        <div class="widget">
                            <div class="widget blog-heading blog-recent-post">
                                <h3 class="widget-title">Recent Post</h3>
                                <ul>
                                    <?php
                                        $args = array( 'posts_per_page' => '3' );
                                        $recent_posts = new WP_Query($args);
                                        while( $recent_posts->have_posts() ) :
                                            $recent_posts->the_post() ?>
                                            <li>
                                                <a href="<?php echo get_permalink() ?>" class="category-link" title="<?php the_title() ?>"><?php the_title() ?></a>
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail('thumbnail', array('title' => get_the_title() )); ?>
                                                <?php endif ?>
                                                <span class="comment"><i class="ti-calendar"></i><?php echo get_the_date('d F Y', strtotime('post_date')); ?></span>
                                                <span class="category"><i class="ti-tag"></i><?php echo get_the_category_list( ', ', '' ); ?></span>
                                            </li>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); # reset post data so that other queries/loops work
                                    ?>
                                </ul>
                            </div><!-- end .widget -->
                        </div><!-- end .widget -->
						<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
							<label>
								<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
								<input type="search" class="search-field"
									placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
									value="<?php echo get_search_query() ?>" name="s"
									title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
							</label>
							<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
						</form>
                    </aside>
                </div><!-- end .col-md-4 -->
            </div>
        </div><!-- end .container -->
    </div><!-- end .content-wrap -->

	<section class="part-invitation marginbot-40 padding-tbxlarge">
        <div class="container">
            <div class="box-invitation">
                <?php the_field('invitation_note', 'option'); ?>
                <a href="https://api.whatsapp.com/send?phone=<?php the_field('whatsapp_number', 'option'); ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_bloginfo('template_url') ?>/img/icon_whatsapp.png" alt="Page Not Found" title="Page Not Found" class="img-fluid"> Konsultasi Sekarang</a>
            </div>
        </div>
    </section>
</div><!-- end .content -->

<?php get_footer(); ?>
