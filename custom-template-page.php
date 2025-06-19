<?php
/*
Template Name: Custom Page Template
*/

get_header(); 

// Get the current page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>


<div class="page-intro">
    <?php if( get_field('basic_top_image', 'options') ): ?>
    <div class="intro-inner" style="background-image: url('<?php the_field('basic_top_image', 'options'); ?>')">
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

<div id="breadcrumbs">
    <div class="container">
        <div class="my-4">        
            <?php breadcrumbs(); ?>
        </div>
    </div>
</div>

<section class="mb-wide">
    <div class="container">
        
            <?php
            // Get the selected option from the URL
            $selected_option = isset($_GET['selected_option']) ? sanitize_text_field($_GET['selected_option']) : '';

            if ($selected_option) {
                // echo '<h1>Posts for Selected Option: ' . esc_html($selected_option) . '</h1>';

                echo '<div class="row">';

                // Array of category slugs to count posts
                $categories = array('rumah-dijual', 'rumah-disewa', 'tanah-dijual'); // Replace with your category slugs

                foreach ($categories as $category_slug) {
                    // Get category object
                    $category = get_category_by_slug($category_slug);

                    // Arguments for the custom query
                    $args = array(
                        'category_name' => $category_slug,
                        'orderby' => 'date',
                        'order' => 'DESC', // Sort by newest date first
                        'meta_query' => array(
                            array(
                                'key' => 'wilayah_property', // Replace with your select field name
                                'value' => $selected_option,
                                'compare' => '='
                            )
                        ),
                        'posts_per_page' => 12, // -1 retrieves all posts
                        'paged' => $paged, // Add pagination support
                    );

                    // Create a new instance of WP_Query
                    $query = new WP_Query($args);

                    // Check if there are posts
                    if ($query->have_posts()) {
                        // echo '<h2>Category: ' . $category->name . '</h2>';
                        // echo '<ul>';

                        // Loop through posts
                        while ($query->have_posts()) {                        
                            $query->the_post();

                            $featured_image = get_the_post_thumbnail(get_the_ID(), 'album-grid');

                            echo '<div class="col-12 col-md-4 col-lg-3">';
                                echo '<div class="card category-landing mb-0 mb-md-4">';
                                    echo '<div class="card-inner">';
                                        echo '<div class="uni_images">';
                                            if ($featured_image) {
                                                echo '<a href="'. get_permalink() .'">' . $featured_image . '</a>';
                                            }  
                                        echo '<div class="label-type"><span>' . $category->name . '</span></div>';
                                        if (get_field('harga_property')) {
                                            $harga_property = get_field('harga_property');
            
                                            if (is_numeric($harga_property)) {
                                                // Format the number with number_format
                                                echo '<div class="info-price d-none d-lg-block">Rp. ' . number_format($harga_property, 0, ',', '.') . '</div>';
                                            } else {
                                                // Output the text as it is
                                                echo '<div class="info-price d-none d-lg-block">Rp. ' . $harga_property . '</div>';
                                            }
                                        }
                                        echo '</div>'; // end uni_images    
                                        echo '<div class="uni_info p-3">';
                                            echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                                                if (get_field('wilayah_property')) {
                                                    echo '<div class="info-location"><i class="icon-ks-marker"></i><span>' . get_field('wilayah_property') . '</span></div>';
                                                }
                                                if (get_field('tipe_property')) {
                                                    echo '<div class="info-type"><span>' . get_field('tipe_property') . '</span></div>';
                                                }
                                            echo '</div>'; // end 
                                            echo '<h3 class="py-3"><a href="' . get_permalink() . '">' . mb_strimwidth(get_the_title(), 0, 55, '...') . '</a></h3>';
                                            if (get_field('harga_property')) {
                                                $harga_property = get_field('harga_property');
        
                                                if (is_numeric($harga_property)) {
                                                    // Format the number with number_format
                                                    echo '<div class="info-price d-lg-none d-flex">Rp. ' . number_format($harga_property, 0, ',', '.') . '</div>';
                                                } else {
                                                    // Output the text as it is
                                                    echo '<div class="info-price d-lg-none d-flex">Rp. ' . $harga_property . '</div>';
                                                }
                                            }
                                            echo '<p>'. get_the_excerpt() .'</p>';
                                            echo '<div class="d-flex info-qualification mt-4 pt-4">';
                                                if (get_field('kamar_tidur')) {
                                                    echo '<div class="q_item bedroom"><i class="icon-ks-bed mr-2"></i><span>' . get_field('kamar_tidur') . '</span></div>';
                                                }
                                                if (get_field('kamar_mandi')) {
                                                    echo '<div class="q_item bathroom"><i class="icon-ks-bathroom mr-2"></i><span>' . get_field('kamar_mandi') . '</span></div>';
                                                }
                                                if (get_field('luas_tanah')) {
                                                    echo '<div class="q_item space"><i class="icon-ks-space mr-2"></i><span>' . get_field('luas_tanah') . '</span></div>';
                                                }
                                            echo '</div>';
                                        echo '</div>'; // end uni_info    
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        //echo '</ul>';
                    } else {
                        //echo '<p>No posts found for category: ' . $category->name . '</p>';
                    }
                    
                    // Reset post data
                    wp_reset_postdata();
                }
                echo '</div>';
                // Pagination
                echo '<div class="col-md-12"><div class="pagination">';
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                ));
                echo '</div></div>';
            } else { ?>
                <div class="box-area">
                    <?php
                        // Array of category slugs to count posts
                        $categories = array('rumah-dijual', 'rumah-disewa', 'tanah', 'tanah-dijual', 'rumah-kos-dijual'); // Replace with your category slugs

                        // Array of select field options
                        $select_field_options = array('kota yogyakarta', 'sleman', 'bantul', 'kulon progo', 'gunung kidul'); // Replace with your select field options

                        foreach ($select_field_options as $option) {
                            $total_post_count = 0; // Initialize the total post count for the current option

                            foreach ($categories as $category_slug) {
                                // Get category object
                                $category = get_category_by_slug($category_slug);

                                // Arguments for the custom query
                                $args = array(
                                    'category_name' => $category_slug,
                                    'meta_query' => array(
                                        array(
                                            'key' => 'wilayah_property', // Replace with your select field name
                                            'value' => $option,
                                            'compare' => '='
                                        )
                                    ),
                                    'posts_per_page' => -1 // -1 retrieves all posts
                                );

                                // Create a new instance of WP_Query
                                $query = new WP_Query($args);

                                // Get the number of posts and add to the total count
                                $total_post_count += $query->found_posts;

                                // Reset post data
                                wp_reset_postdata();
                            }

                            // URL to the custom template with the selected option as a query parameter
                            $custom_page_url = add_query_arg('selected_option', $option, get_permalink(get_page_by_path('wilayah')));

                            // Output the area item with the total post count
                            echo '
                                <div class="area-item">
                                    <div class="item-inner">
                                        <a href="' . esc_url($custom_page_url) . '">

                                            <div class="area-info">
                                                <p class="area-title">' . $option . '</p>
                                                <span class="area-number">' . $total_post_count . ' Properti</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            <?php } ?>
        </div>
    
</section>

<?php get_footer(); ?>
