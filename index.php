<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 */
 
get_header(); ?>
 
    <div id="primary" class="content-area mx-auto max-w-screen-xl px-4 md:px-8">
        <main id="main" class="site-main my-12" role="main">
        <?php if ( function_exists( 'breadcrumbs' ) ) breadcrumbs(); ?>
        <h1 class="hidden"><?php the_title(); ?></h1>
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            
            the_content();
 
        // End the loop.
        endwhile;
        ?>
        <?php wp_reset_query(); ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
 
<?php get_footer(); ?>