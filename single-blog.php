<?php

/*
 * Template Name: Featured Article
 * Template Post Type: post, page, product
 */

get_header();

?>

<div id="content" class="page">
    <div class="bg-white py-6 sm:pt-8 sm:pb-8 lg:pt-8 lg:pb-16">
        <div class="container w-11/12 lg:w-9/12 mx-auto px-4 md:px-8">

            <?php breadcrumbs(); ?>

            <div class="flex flex-col md:flex-row mt-7 gap-10">
                <div class="w-full md:w-10/12">
                    <?php
                    if (have_posts()): while (have_posts()) : the_post(); ?>

                        <div class="box-list">
                            <?php the_post_thumbnail( 'full', array('class' => 'img-fluid') );?>
                            <h1><?php the_title();?></h1>
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
                            <div class="contentblog">
                                <?php the_content(); ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

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
                                                <span class="comment"><i class="ti-calendar"></i><?php the_time('d F Y', strtotime('post_date')); ?></span>
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


</div><!-- end #content -->

<?php get_footer(); ?>
