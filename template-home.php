<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<div class="homepage font-sans lg:-mt-[calc(6rem)]">
    <?php if( have_rows('content_info') ): ?>
        <?php while ( have_rows('content_info') ) : the_row(); ?>

            <?php if( get_row_layout() == 'hero' ): ?>
                <?php 
                    $hero_items = get_sub_field('hero_item');
                    $hero_schedule = get_sub_field('hero_schedule');
                ?>
                <?php if( $hero_items || $hero_schedule ): ?>
                    <div class="hero-section flex justify-center bg-white pb-6 sm:pb-8 lg:pb-12 relative h-[90%] lg:h-screen">

                        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
                            <section class="flex flex-col-reverse justify-between gap-6 mb-4 md:mb-0 sm:gap-10 md:gap-10 md:flex-row md:items-center md:h-full">
                            
                                <?php if( $hero_items ): ?>
                                    <?php foreach( $hero_items as $hero_item ): ?>
                                        <!-- Hero Item Content - start -->
                                        <div class="flex flex-col justify-center sm:text-center lg:py-12 md:text-left xl:w-4/6 xl:py-24" data-aos="fade-right" data-aos-offset="300">
                                            <?php if( $hero_item['hero_heading'] ): ?>
                                                <h1 class="mb-8 text-4xl font-bold text-primary sm:text-5xl md:mb-12 md:text-6xl"><?php echo esc_html($hero_item['hero_heading']); ?></h1>
                                            <?php endif; ?>
                                            <?php if( $hero_item['hero_description'] ): ?>
                                                <p class="mb-8 leading-relaxed text-primary md:mb-12 lg:w-4/5 xl:text-lg"><?php echo esc_html($hero_item['hero_description']); ?></p>
                                            <?php endif; ?>
                                            
                                            <?php if( $hero_item['hero_link'] ): 
                                                    $link = $hero_item['hero_link'];
                                                    ?>
                                            <div class="flex flex-col gap-2.5 sm:flex-row justify-start">
                                                <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>" class="inline-block rounded-full bg-default hover:bg-default-hover px-8 py-3 text-center text-sm font-medium text-white outline-none transition duration-100  md:text-base"><?php echo esc_html($link['title']); ?></a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <!-- Hero Item Content - end -->

                                        <!-- Hero Item Image - start -->
                                        <div class="flex justify-end h-auto overflow-hidden xl:w-5/6" data-aos="fade-left" data-aos-offset="300">
                                            <?php if( $hero_item['hero_image'] ): ?>
                                                <img src="<?php echo esc_url($hero_item['hero_image']); ?>" alt="Hero Image" width="600" height="508" class="h-full object-cover object-center" />
                                            <?php endif; ?>
                                        </div>
                                        <!-- Hero Item Image - end -->
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </section>
                        </div>

                        <?php if( $hero_schedule ): ?>
                            <div class="bg-[#27AAE1] bg-opacity-70 w-full schedule">
                                <div class="mx-auto max-w-screen-xl px-4 md:px-8 py-8">
                                    <div class="flex flex-col md:flex-row md:justify-between gap-6">

                                        <?php foreach( $hero_schedule as $schedule ): ?>
                                            <div class="flex items-start gap-4 md:w-1/3">
                                                <?php if( $schedule['sch_image'] ): ?>
                                                    <img src="<?php echo esc_url($schedule['sch_image']); ?>" alt="Schedule Image" class="w-7 md:w-[46px] h-7 md:h-[46px] object-cover">
                                                <?php endif; ?>
                                                <div>
                                                    <?php if( $schedule['sch_title'] ): ?>
                                                        <h3 class="text-lg font-semibold text-white"><?php echo esc_html($schedule['sch_title']); ?></h3>
                                                    <?php endif; ?>
                                                    <?php if( $schedule['sch_excerpt'] ): ?>
                                                        <p class="text-sm text-gray-200"><?php echo esc_html($schedule['sch_excerpt']); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( get_row_layout() == 'aboutus' ): ?>
                <?php 
                $about_heading_title = get_sub_field('about_heading_title');
                $about_content = get_sub_field('about_content');
                $about_main_image = get_sub_field('about_main_image');
                if( $about_heading_title || $about_content || $about_main_image ): ?>
                    <div class="aboutus-section bg-white py-6 sm:py-8 lg:py-20 relative" data-aos="fade-up" data-aos-offset="300">
                        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
                            <div class="mb-8 lg:mb-12">
                                <?php if( $about_heading_title ): ?>
                                    <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
                                        <?php echo esc_html($about_heading_title); ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if( $about_content ): ?>
                                    <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-base !leading-7">
                                        <?php echo esc_html($about_content); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <?php if ($about_main_image): ?>
                                <div class="overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                                    <img src="<?php echo esc_url($about_main_image); ?>" alt="Service Main Image" class="h-full w-full object-cover object-center" />
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( get_row_layout() == 'services' ): ?>
                <?php 
                $service_main_image = get_sub_field('service_main_image');
                $service_main_footage = get_sub_field('service_main_footage');
                $service_items = get_sub_field('service_item');
                $service_link_page = get_sub_field('service_link_page');
                $service_section_title = get_sub_field('service_section_title');
                if( $service_main_image || $service_items || $service_main_footage ): ?>
                    <div class="services-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
                            <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
                                <?php echo esc_html($service_section_title); ?>
                            </h2>
                            <div class="grid gap-8 lg:grid-cols-2 lg:gap-12">                               
                                <?php if ($service_main_image || $service_main_footage): ?>
                                    <div class="dotbg" data-aos="fade-right" data-aos-offset="300">
                                        <?php if ($service_main_image): ?>
                                            <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                                                <img src="<?php echo esc_url($service_main_image); ?>" alt="Service Main Image" class="h-full w-full object-cover object-center" />
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($service_main_footage): ?>
                                            <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto footage">
                                                <?php echo $service_main_footage; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( $service_items ): ?>
                                    <div data-aos="fade-left" data-aos-offset="300">
                                        <?php foreach( $service_items as $service_item ): ?>
                                            <div class="flex gap-4 md:gap-6 mb-6">
                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-default text-white shadow-lg md:h-16 md:w-16 md:rounded-xl">
                                                <?php if (isset($service_item['service_item_image']) && $service_item['service_item_image']): ?>
                                                    <img 
                                                        src="<?php echo esc_url($service_item['service_item_image']); ?>" 
                                                        alt="<?php echo isset($service_item['service_item_title']) ? esc_attr($service_item['service_item_title']) : ''; ?>" 
                                                        class="w-16 h-16" 
                                                    />
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
                            
                            <?php if( $service_link_page ): ?>
                                <div class="mt-8">
                                    <a href="<?php echo esc_url($service_link_page['url']); ?>" class="flex items-center mx-auto max-w-fit rounded-full bg-transparent border border-blue-light text-blue-light px-8 py-3 text-center text-sm font-medium outline-none hover:bg-blue-light hover:text-white transition duration-100 md:text-base"><?php echo esc_html($service_link_page['title']); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if( get_row_layout() == 'featured' ): ?>
                <?php 
                $featured_main_image = get_sub_field('featured_main_image');
                $featured_main_footage = get_sub_field('featured_main_footage');
                $featured_items = get_sub_field('featured_item');
                $featured_link_page = get_sub_field('featured_link_page');
                $featured_section_title = get_sub_field('featured_section_title');
                $featured_title = get_sub_field('featured_title');
                if( $featured_main_image || $featured_items || $featured_main_footage ): ?>
                    <div class="featured-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
                        
                            <div class="grid gap-8 lg:grid-cols-2 lg:gap-12 relative z-[1] bg-white grid-flow-row-dense">    
                                
                                <?php if( $featured_items ): ?>
                                    <div data-aos="fade-up" data-aos-offset="300">
                                        <h4><?php echo esc_html($featured_title); ?></h4>
                                        <h2 class="mb-8 text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
                                            <?php echo esc_html($featured_section_title); ?>
                                        </h2>
                                        <?php foreach( $featured_items as $featured_item ): ?>
                                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 mb-6">
                                                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg  text-white shadow-lg md:h-16 md:w-16 md:rounded-xl">
                                                <?php if (isset($featured_item['featured_item_image']) && $featured_item['featured_item_image']): ?>
                                                    <img 
                                                        src="<?php echo esc_url($featured_item['featured_item_image']); ?>" 
                                                        alt="<?php echo isset($featured_item['featured_item_title']) ? esc_attr($featured_item['featured_item_title']) : ''; ?>" 
                                                        class="w-16 h-16" 
                                                    />
                                                <?php endif; ?>

                                                </div>

                                                <div>
                                                    <?php if( $featured_item['featured_title_item'] ): ?>
                                                        <h3 class="mb-2 text-lg font-semibold md:text-xl"><?php echo esc_html($featured_item['featured_title_item']); ?></h3>
                                                    <?php endif; ?>
                                                    <?php if( $featured_item['featured_item_description'] ): ?>
                                                        <p class="mb-2 text-gray-500"><?php echo esc_html($featured_item['featured_item_description']); ?></p>
                                                    <?php endif; ?>
                                                    <a href="#" class="hidden font-bold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">More</a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php if( $featured_link_page ): ?>
                                            <div class="mt-10">
                                                <a href="<?php echo esc_url($featured_link_page['url']); ?>" class="link-more">
                                                    <?php echo esc_html($featured_link_page['title']); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>                                    
                                <?php endif; ?>     
                                
                                <?php if ($featured_main_image || $featured_main_footage): ?>
                                    <div class="dotbg" data-aos="fade-up" data-aos-offset="300">
                                        <?php if ($featured_main_image): ?>
                                            <div class="h-auto overflow-hidden rounded-lg bg-gray-100 shadow-lg">
                                                <img src="<?php echo esc_url($featured_main_image); ?>" alt="Service Main Image" class="h-full w-full object-cover object-center" />
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($featured_main_footage): ?>
                                            <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto footage">
                                                <?php echo $featured_main_footage; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                                                        
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( get_row_layout() == 'highlight' ): ?>
                <?php 
                $highlight_main_image = get_sub_field('highlight_main_image');
                $highlight_main_footage = get_sub_field('highlight_main_footage');
                $highlight_items = get_sub_field('highlight_item');
                $highlight_link_page = get_sub_field('highlight_link_page');
                $highlight_section_title = get_sub_field('highlight_section_title');
                $highlight_title = get_sub_field('highlight_title');
                if( $highlight_main_image || $highlight_items || $highlight_main_footage ): ?>
                    <div class="highlight-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
                            
                            <div class="grid gap-8 lg:grid-cols-2 lg:gap-12 relative z-[1] bg-white">
                                

                                <?php if ($highlight_main_image || $highlight_main_footage): ?>
                                    <div class="dotbg" data-aos="fade-right" data-aos-offset="300">
                                        <?php if ($highlight_main_image): ?>
                                            <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                                                <img src="<?php echo esc_url($highlight_main_image); ?>" alt="Service Main Image" class="h-full w-full object-cover object-center" />
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($highlight_main_footage): ?>
                                            <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto footage">
                                                <?php echo $highlight_main_footage; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( $highlight_items ): ?>
                                    <div data-aos="fade-left" data-aos-offset="300">
                                        <h4><?php echo esc_html($highlight_title); ?></h4>
                                        <h2 class="mb-8 text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
                                            <?php echo esc_html($highlight_section_title); ?>
                                        </h2>
                                        <?php foreach( $highlight_items as $highlight_item ): ?>
                                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 mb-6">
                                                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg  text-white shadow-lg md:h-16 md:w-16 md:rounded-xl">
                                                <?php if (isset($highlight_item['highlight_item_image']) && $highlight_item['highlight_item_image']): ?>
                                                    <img 
                                                        src="<?php echo esc_url($highlight_item['highlight_item_image']); ?>" 
                                                        alt="<?php echo isset($highlight_item['highlight_item_title']) ? esc_attr($highlight_item['highlight_item_title']) : ''; ?>" 
                                                        class="w-16 h-16" 
                                                    />
                                                <?php endif; ?>

                                                </div>

                                                <div>
                                                    <?php if( $highlight_item['highlight_title_item'] ): ?>
                                                        <h3 class="mb-2 text-lg font-semibold md:text-xl"><?php echo esc_html($highlight_item['highlight_title_item']); ?></h3>
                                                    <?php endif; ?>
                                                    <?php if( $highlight_item['highlight_item_description'] ): ?>
                                                        <p class="mb-2 text-gray-500"><?php echo esc_html($highlight_item['highlight_item_description']); ?></p>
                                                    <?php endif; ?>
                                                    <a href="#" class="hidden font-bold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">More</a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php if( $highlight_link_page ): ?>
                                            <div class="mt-10">
                                                <a href="<?php echo esc_url($highlight_link_page['url']); ?>" class="link-more">
                                                    <?php echo esc_html($highlight_link_page['title']); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>                                    
                                <?php endif; ?>                               
                            </div>
                                                        
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( get_row_layout() == 'pricing' ): ?>
                <?php 
                $variants = get_sub_field('variant');
                $variants_link_page = get_sub_field('variant_link_page');
                $pricing_section_title = get_sub_field('pricing_section_title');
                if( $variants ): ?>
                    <div class="pricing-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                            <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-16 lg:text-3xl">
                                <?php echo esc_html($pricing_section_title); ?>
                            </h2>
                            <div class="grid gap-6 md:grid-cols-3 lg:gap-6">                                
                                <?php foreach( $variants as $index => $variant ): ?>
                                    <div class="pricing-variant mx-auto max-w-screen-xl w-full text-center">
                                        <div class="shadow-md">
                                            <?php if( $variant['pricing_type'] ): ?>
                                                <h4 class="py-8 text-center font-medium text-lg"><?php echo esc_html($variant['pricing_type']); ?></h4>
                                            <?php endif; ?>
                                            <?php if( $variant['pricing_number'] ): ?>
                                                <p class="text-3xl font-normal p-4 md:p-8">Rp. <?php echo esc_html($variant['pricing_number']); ?></p>
                                            <?php endif; ?>
                                            <?php if( $variant['pricing_excerpt'] ): ?>
                                                <div class="pb-10 px-4 md:px-10 content-info"><?php echo $variant['pricing_excerpt']; ?></div>
                                            <?php endif; ?>
                                            <?php if( $variant['pricing_description'] ): ?>
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
                                <?php endforeach; ?>                                
                            </div>
                            <?php if( $variants_link_page ): ?>
                                <div class="mt-8">
                                    <a href="<?php echo esc_url($variants_link_page['url']); ?>" class="flex items-center mx-auto max-w-fit rounded-full bg-transparent border border-blue-light text-blue-light px-8 py-3 text-center text-sm font-medium outline-none hover:bg-blue-light hover:text-white transition duration-100 md:text-base">
                                        <?php echo esc_html($variants_link_page['title']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( get_row_layout() == 'testimonial' ): ?>
                <?php 
                $testimonials = get_sub_field('testimonials');
                $testimonial_section_title = get_sub_field('testimonial_section_title');
                if( $testimonials ): ?>
                    <div class="testimonial-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                            <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
                                <?php echo esc_html($testimonial_section_title); ?>
                            </h2>
                            <div class="grid gap-y-10 sm:grid-cols-2 sm:gap-y-12 lg:grid-cols-3 lg:divide-x">
                                <?php foreach( $testimonials as $testimonial ): ?>
                                    <div class="flex flex-col items-center gap-4 sm:px-4 md:gap-6 lg:px-8">
                                        <?php if( $testimonial['testimonial_content'] ): ?>
                                            <div class="text-center text-gray-600"><p><?php echo esc_html($testimonial['testimonial_content']); ?></p></div>
                                        <?php endif; ?>

                                        <div class="flex flex-col items-center gap-2 sm:flex-row md:gap-3">
                                            <?php if( $testimonial['testimonial_image'] ): ?>
                                                <div class="h-12 w-12 overflow-hidden rounded-full bg-gray-100 shadow-lg md:h-14 md:w-14">
                                                    <img src="<?php echo esc_url($testimonial['testimonial_image']); ?>"alt="Photo by Radu Florin" class="h-full w-full object-cover object-center" />
                                                </div>
                                            <?php endif; ?>

                                            <div>
                                                <?php if( $testimonial['testimonial_name'] ): ?>
                                                    <h5 class="text-center text-sm font-bold text-primary sm:text-left md:text-base"><?php echo esc_html($testimonial['testimonial_name']); ?></h5>
                                                <?php endif; ?>
                                                <?php if( $testimonial['testimonial_position'] ): ?>
                                                    <p class="text-center text-sm text-gray-500 sm:text-left md:text-sm"><?php echo esc_html($testimonial['testimonial_position']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>

    <div class="product-section bg-white py-6 sm:py-8 lg:py-12">
        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">

            <div class="bg-white md:bg-transparent z-[1] relative">
                <?php $catalog_heading = get_option('catalog_heading', 1); ?>
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl"><?php echo esc_html($catalog_heading); ?></h2>
                
                <?php
                // Custom Query to Get catalog_product Posts
                $args = [
                    'post_type'      => 'catalog_product',
                    'posts_per_page' => 6, // Limit to 6 products (adjust as needed)
                ];
                $catalog_query = new WP_Query($args);

                if ($catalog_query->have_posts()) :
                ?>
                    <div class="product-grid grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10">
                        <?php while ($catalog_query->have_posts()) : $catalog_query->the_post(); ?>
                            <div class="product-item" data-aos="fade-up" data-aos-offset="300">
                                <a href="<?php the_permalink(); ?>" class="product-link relative hover:shadow-md inline-block rounded-lg">
                                    <!-- Single Gallery Image -->
                                    <?php 
                                    $gallery_images = get_field('product_images'); // Replace 'product_gallery' with your actual field name
                                    if (!empty($gallery_images)) : 
                                        $first_image = $gallery_images[0]; // Get the first image
                                    ?>
                                        <div class="product-image">
                                            <img src="<?php echo esc_url($first_image['url']); ?>" alt="<?php echo esc_attr($first_image['alt']); ?>" />
                                        </div>
                                    <?php elseif (has_post_thumbnail()) : ?>
                                        <div class="product-image">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Product Title -->
                                    <h2 class="product-title text-center text-lg font-semibold leading-7 text-default hover:text-default-hover my-5"><?php the_title(); ?></h2>
                                    
                                    <!-- Product Price -->
                                    <?php 
                                    $product_price = get_field('price'); // Get price field
                                    if ($product_price) : 
                                    ?>
                                        <p class="product-price"><?php echo esc_html($product_price); ?></p>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        // Custom Pagination
                        echo paginate_links([
                            'total' => $catalog_query->max_num_pages,
                        ]);
                        ?>
                    </div>

                <?php
                else :
                    echo '<p>No products found.</p>';
                endif;

                // Reset Post Data
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

    
    <div class="article-section bg-white py-6 sm:py-8 lg:py-12">
        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">

            <?php
            $post_objects = get_field('home_content_blog');

            if ( $post_objects ): // Only display section if posts exist ?>
                <div class="flex items-center justify-center">
                    <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">Artikel</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                    <?php setup_postdata($post); ?>
                    <?php
                        // get image alt
                        $thumb_id = get_post_thumbnail_id(get_the_id());
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $title = get_the_title($thumb_id);
                    ?>
                    <div class="relative z-[1]">
                        <div class="unibox uniblog uniblog__duo transform">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <div class="unibloginner">
                                    <?php if ( wp_is_mobile() ) : ?>
                                        <div class="unimages">
                                            <?php
                                                if ( has_post_thumbnail() ) {
                                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'album-grid' );
                                                    echo '<img src="'.$image[0].'" data-id="'.$post->ID.'" class="img-responsive" alt="'.$alt.'" title="'.$title.'">';
                                                }
                                            ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="unimages">
                                            <?php
                                                if ( has_post_thumbnail() ) {
                                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'album-grid' );
                                                    echo '<img src="'.$image[0].'" data-id="'.$post->ID.'" class="img-responsive" alt="'.$alt.'" title="'.$title.'">';
                                                }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="info">
                                        <div class="meta">
                                            <span class="time">
                                                <i class="ti-calendar" aria-hidden="true"></i> <span class="ml-2"><?php echo get_the_date('d F Y', strtotime('post_date')); ?></span>
                                            </span>
                                        </div>
                                        <h3><?php the_title(); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                </div>


            <?php endif; ?>  


        </div>
    </div>

</div>

<?php get_footer(); ?>
