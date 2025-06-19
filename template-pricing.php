<?php
/**
 * Template Name: Pricing Template
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
        

    <?php if( have_rows('pricing_info') ): ?>
        <?php while ( have_rows('pricing_info') ) : the_row(); ?>
            
            <!-- Pricing Layout -->
            <?php if( get_row_layout() == 'pricing' ): ?>
                <?php 
                $variants = get_sub_field('variant');
                $pricing_section_title = get_sub_field('pricing_section_title');
                $show_booking_button = get_sub_field('show_booking', 'option'); // Toggle for Booking Button
                $show_pricing_description = get_sub_field('show_description', 'option'); // Toggle for Description
                $whatsapp_number = get_field('basic_whatsapp_number', 'option'); // WhatsApp number
                //$booking_message = 'Hallo, saya ingin tahu lebih lanjut tentang Klinevo'; // Default booking message
                
                if( $variants ): ?>
                    <div class="pricing-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                            <!-- Main Price Section -->
                            <div class="main-price max-w-screen-md mx-auto mb-12">
                                <?php foreach( $variants as $index => $variant ): ?>
                                    <?php 
                                        // Construct the dynamic booking message
                                        $pricing_type = $variant['pricing_type'];
                                        $booking_message = 'Hallo, saya ingin tahu lebih lanjut tentang Paket ' . esc_html($pricing_type); 
                                    ?>
                                    <?php if( isset($variant['highlight_main_price']) && $variant['highlight_main_price'] ): ?>
                                        <div class="pricing-variant rounded-lg border hover:shadow-md text-center p-6">
                                            <div class="flex flex-col md:flex-row">
                                                <div class="img w-full md:w-1/3">
                                                    <?php if( $variant['pricing_image'] ): ?>
                                                        <div class="py-4">
                                                            <img src="<?php echo esc_url($variant['pricing_image']); ?>" aria-label="Logo Klinevo" class="img-fluid" height="34">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="info w-full md:w-2/3">
                                                    <?php if( $variant['pricing_type'] ): ?>
                                                        <h2 class="py-4 text-center font-bold text-2xl  text-blue-light">
                                                            <?php echo esc_html($variant['pricing_type']); ?>
                                                        </h2>
                                                    <?php endif; ?>

                                                    <?php if( $variant['pricing_number'] ): ?>
                                                        <p class="text-3xl font-semibold py-4">
                                                            Rp. <?php echo esc_html($variant['pricing_number']); ?>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php if ($show_booking_button && in_array('1', $show_booking_button) && $whatsapp_number): ?>
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp_number); ?>&text=<?php echo urlencode($booking_message); ?>" 
                                                        class="flex items-start max-w-fit rounded-full border border-white bg-orange text-white px-8 py-2 text-center text-sm font-normal outline-none transition duration-100 mx-auto" 
                                                        target="_blank" rel="noopener">
                                                        Booking Sekarang!
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if( $variant['pricing_excerpt'] ): ?>
                                                        <div class="pb-10 px-2 md:px-2 content-info mt-8">
                                                            <?php echo $variant['pricing_excerpt']; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if( $variant['pricing_description'] && $show_pricing_description && in_array('1', $show_pricing_description) ): ?>
                                                        <!-- Add Fancybox Trigger -->
                                                        <div class="pb-10 px-4 md:px-8">
                                                            <a href="#modal-description-<?php echo $index; ?>" data-fancybox class="inline-block text-blue-light px-6 py-2 text-center text-sm font-medium transition duration-100 md:text-base">
                                                                Selengkapnya
                                                            </a>
                                                            <!-- Fancybox Modal Content -->
                                                            <div style="display: none;" id="modal-description-<?php echo $index; ?>">
                                                                <div class="p-4">
                                                                    <h3 class="mb-4 text-xl font-bold"><?php echo esc_html($variant['pricing_type']); ?></h3>
                                                                    <p><?php echo $variant['pricing_description']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <!-- Pricing Section Title -->
                            <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
                                <?php echo esc_html($pricing_section_title); ?>
                            </h2>
                            
                            <!-- All Pricing Variants -->
                            <div class="grid gap-6 md:grid-cols-4 lg:gap-6">
                                <?php foreach( $variants as $index => $variant ): ?>
                                    <?php 
                                    // Skip variants already shown in the main-price section
                                    if( isset($variant['highlight_main_price']) && $variant['highlight_main_price'] ) {
                                        continue;
                                    }
                                    ?>
                                    <?php 
                                        // Construct the dynamic booking message
                                        $pricing_type = $variant['pricing_type'];
                                        $booking_message = 'Hallo, saya ingin tahu lebih lanjut tentang ' . esc_html($pricing_type); 
                                    ?>
                                    <div class="pricing-variant rounded-lg border hover:shadow-md text-center overflow-auto">
                                        <?php if( $variant['pricing_type'] ): ?>
                                            <h4 class="py-8 text-center font-light text-lg bg-blue-light text-white">
                                                <?php echo esc_html($variant['pricing_type']); ?>
                                            </h4>
                                        <?php endif; ?>

                                        <?php if( $variant['pricing_image'] ): ?>
                                            <div>
                                                <img src="<?php echo esc_url($variant['pricing_image']); ?>" aria-label="Logo Klinevo" class="img-fluid" height="34">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if( $variant['pricing_number'] ): ?>
                                            <p class="text-3xl font-normal p-4 md:p-8">
                                                Rp. <?php echo esc_html($variant['pricing_number']); ?>
                                            </p>
                                        <?php endif; ?>
                                        
                                        <?php if ($show_booking_button && in_array('1', $show_booking_button) && $whatsapp_number): ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp_number); ?>&text=<?php echo urlencode($booking_message); ?>" 
                                            class="flex items-start max-w-fit rounded-full border border-white bg-orange text-white px-8 py-2 text-center text-sm font-normal outline-none transition duration-100 mx-auto" 
                                            target="_blank" rel="noopener">
                                            Booking Sekarang!
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if( $variant['pricing_excerpt'] ): ?>
                                            <div class="pb-10 px-2 md:px-2 content-info mt-8">
                                                <?php echo $variant['pricing_excerpt']; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if( $variant['pricing_description'] && $show_pricing_description && in_array('1', $show_pricing_description) ): ?>
                                            <!-- Add Fancybox Trigger -->
                                            <div class="pb-10 px-4 md:px-8">
                                                <a href="#modal-description-<?php echo $index; ?>" data-fancybox class="inline-block text-blue-light px-6 py-2 text-center text-sm font-medium transition duration-100 md:text-base">
                                                    Selengkapnya
                                                </a>
                                                <!-- Fancybox Modal Content -->
                                                <div style="display: none;" id="modal-description-<?php echo $index; ?>">
                                                    <div class="p-4">
                                                        <h3 class="mb-4 text-xl font-bold"><?php echo esc_html($variant['pricing_type']); ?></h3>
                                                        <p><?php echo $variant['pricing_description']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>