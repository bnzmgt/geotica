<?php
/**
 * Template Name: Landing - Uno
 */

get_header('landing'); ?>

    <div id="primary" class="content-area mx-auto max-w-screen-md px-6 md:px-8">
        <main id="main" class="site-main mt-4 mb-[88px] relative prose" role="main">
        
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

        <?php 
        // Get the CTA Link fields
        $cta_text = get_field('base_cta_text'); // Text field
        $cta_link = get_field('base_cta_link'); // URL field

        // Check if the fields have values before displaying
        if ($cta_text && $cta_link): ?>
            <div class="fixed w-full py-4 top-auto bottom-0 left-0 bg-white">
                <a href="<?php echo esc_url($cta_link); ?>" class="flex items-center mx-auto max-w-xs rounded-full bg-blue-light border border-blue-light text-white px-8 py-3 text-center text-sm font-medium outline-none hover:bg-blue-light hover:text-white transition duration-100 md:text-base justify-center">
                    <?php echo esc_html($cta_text); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php wp_reset_query(); ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer('landing'); ?>
