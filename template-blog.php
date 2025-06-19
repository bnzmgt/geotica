<?php

/**
 * Template Name: Blog
 */

get_header();

?>

<div id="content" class="page">
    <div class="page-intro">
        <?php if( get_field('basic_top_image', 'options') ): ?>
        <div class="intro-inner" style="background-image: url('<?php the_field('basic_top_image', 'options'); ?>')">
        <?php endif; ?>
            <div class="outer-inner">
                <div class="container inner-box clearfix">
                    <div class="inner-box-container">
                        <div class="intro-title">
                        </div>
                    </div><!-- end .inner-container -->
                </div><!-- end .inner-box -->
            </div><!-- end .outer-inner -->
        </div><!-- end .intro-inner -->
    </div><!-- end .page-intro -->
        
    
    <div class="bg-white py-6 sm:pt-8 sm:pb-8 lg:pt-8 lg:pb-16">
        <div class="container w-11/12 lg:w-9/12 mx-auto px-4 md:px-8">
            
            <?php breadcrumbs(); ?>

            <div class="flex flex-col md:flex-row mt-7">            
                <div class="w-full md:w-10/12">
                    <?php
					// the query
					$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'category_name' => 'artikel')); ?>

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
                                    <span class="author">
                                        <i class="ti-book"></i>
                                        <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) {
                                                foreach ( $categories as $category ) {
                                                    echo esc_html( $category->name );
                                                }
                                            }
                                        ?>
                                    </span>
                                    <span class="date"><i class="ti-calendar"></i><?php echo get_the_date('d F Y', strtotime('post_date')); ?></span>
                                </div>

                                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h4>
                                <?php echo the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="link-more mt-4">Baca selengkapnya</a>
							</div>
					    <?php endwhile; ?>
					    <!-- end of the loop -->

					    <?php wp_reset_postdata(); ?>

					<?php else : ?>
					    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
                </div>
                <div class="w-full md:w-1/3">
                    <aside class="sidebar sidebar-right">
                        <div class="widget">
                            <div class="widget blog-heading blog-recent-post">
                                <h3 class="widget-title">Recent Post</h3>
                                <ul>
                                    <?php
                                        $args = array( 
                                            'posts_per_page' => '3',
                                            'category_name' => 'artikel' 
                                        );
                                        $recent_posts = new WP_Query($args);
                                        while( $recent_posts->have_posts() ) :
                                            $recent_posts->the_post() ?>
                                            <li>
                                                <a href="<?php echo get_permalink() ?>" class="category-link" title="<?php the_title() ?>"><?php the_title() ?></a>
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail('thumbnail', array('title' => get_the_title() )); ?>
                                                <?php endif ?>
                                                <span class="comment"><i class="ti-calendar"></i><?php echo get_the_date('d F Y', strtotime('post_date')); ?></span>
                                            </li>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); # reset post data so that other queries/loops work
                                    ?>
                                </ul>
                            </div><!-- end .widget -->
                        </div><!-- end .widget -->
                    </aside>
                </div>
            </div>
        </div>
    </div>

</div><!-- end .content -->

<?php get_footer(); ?>
