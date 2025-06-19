<?php
/**
 * Template Name: About Us
 */

get_header();

?>
<div id="content" class="page">
    <div class="page-intro">
        <?php if( get_field('cover_image_about') ): ?>
        <div class="intro-inner" style="background-image: url('<?php the_field('cover_image_about'); ?>')">
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
    </div>
    <!-- end .page-intro -->

    <div class="bg-white py-6 sm:py-8 lg:py-16">
        <div class="container w-11/12 lg:w-9/12 mx-auto px-4 md:px-8">

            <main>                
                <?php the_field('pa_description'); ?>
            </main>

        </div>
    </div>
    <!-- end .content-wrap -->

</div>

<?php get_footer(); ?>
