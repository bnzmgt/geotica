<?php
/**
 * Template Name: Service Template
 */

get_header(); ?>

<div class="content-info my-8 md:my-0 font-sans">

    <?php
        // Loop through the posts
        while ( have_posts() ) : the_post(); 
            // Check if there is content for the current post
            if ( trim(get_the_content()) ) : ?>
                <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                    <div class="py-6 sm:py-8 lg:py-20">
                        <div class="entry-content-page">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php 
            endif;
        endwhile; // End of the loop
        wp_reset_query(); // Reset the query
    ?>

    <?php if( have_rows('service_info') ): ?>
        <?php while ( have_rows('service_info') ) : the_row(); ?>

            <!-- Services Layout -->
            <?php if( get_row_layout() == 'services' ): ?>
                <?php 
                $service_main_image = get_sub_field('service_main_image');
                $service_items = get_sub_field('service_item');
                $service_section_title = get_sub_field('service_section_title');
                if( $service_main_image || $service_items ): ?>
                    <div class="services-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                            <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
                                <?php echo esc_html($service_section_title); ?>
                            </h2>
                            <div class="grid gap-8 <?php echo $service_main_image ? 'lg:grid-cols-2 lg:gap-12' : 'lg:grid-cols-1'; ?>">
                                
                                <?php if( $service_main_image ): ?>
                                <div>
                                    <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                                        <img src="<?php echo esc_url($service_main_image); ?>" alt="Service Main Image" class="h-full w-full object-cover object-center" />
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if( $service_items ): ?>
                                <div>
                                    <?php foreach( $service_items as $service_item ): ?>
                                        <div class="flex gap-4 md:gap-6 mb-6">
                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-orange text-white shadow-lg md:h-14 md:w-14 md:rounded-xl">
                                                <?php if( $service_item['service_item_image'] ): ?>
                                                    <img src="<?php echo esc_url($service_item['service_item_image']); ?>" alt="<?php echo esc_attr($service_item['service_item_title']); ?>" class="w-8 h-8" />
                                                <?php endif; ?>
                                            </div>

                                            <div>
                                                <?php if( $service_item['service_title_item'] ): ?>
                                                    <h3 class="mb-2 text-lg font-semibold md:text-xl"><?php echo esc_html($service_item['service_title_item']); ?></h3>
                                                <?php endif; ?>
                                                <?php if( $service_item['service_item_description'] ): ?>
                                                    <p class="mb-2 text-gray-500"><?php echo esc_html($service_item['service_item_description']); ?></p>
                                                <?php endif; ?>
                                                <a href="#" class="hidden font-bold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">More</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>