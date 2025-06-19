<?php

/*
 * Template Name: Static Page
 */

get_header();

?>

<div id="content" class="page singlepage static-page">

    <div class="page-intro">

    <?php if( get_field('page_contact_us', 'option') ): ?>
        <div class="intro-inner" style="background-image: url('<?php the_field('page_contact_us', 'option'); ?>')">
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
        </div>
        <!-- end .intro-inner -->
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
            		if (have_posts()): while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>

            	<?php endwhile; ?>
            	<?php endif; ?>
            	<?php wp_reset_postdata(); ?>
            </div>
        </div>
     </div>

</div>

<?php get_footer(); ?>
