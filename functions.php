<?php
add_filter('acf/rest_api/fetch_item', function ($data, $request) {
    return $data;
}, 10, 2);

add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/acf-options/', array(
        'methods' => 'GET',
        'callback' => 'get_acf_options',
    ));
});

function get_acf_options() {
    if (function_exists('get_field')) {
        $footer_logo = get_field('footer_logo', 'option');
        $social_media = get_field('basic_social_media', 'option');
        $footer_info = get_field('basic_footer_info', 'option');
        $header_logo = get_field('header_logo', 'option');
        $header_logo_mobile = get_field('header_logo_mobile', 'option');

        // Format social_media repeater field for the API response
        $formatted_social_media = [];
        if (is_array($social_media)) {
            foreach ($social_media as $item) {
                $icon = '';
                $name = $item['basic_social_name'];

                // Match based on value and encode SVG as base64
                if ($name === 'instagram') {
                    $icon_svg = '<svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>';
                    $icon = 'data:image/svg+xml;base64,' . base64_encode($icon_svg);
                } elseif ($name === 'twitter') {
                    $icon_svg = '<svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>';
                    $icon = 'data:image/svg+xml;base64,' . base64_encode($icon_svg);
                } elseif ($name === 'facebook') {
                    $icon_svg = '<svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>';
                    $icon = 'data:image/svg+xml;base64,' . base64_encode($icon_svg);
                }

                $formatted_social_media[] = [
                    'name' => $name,
                    'link' => isset($item['basic_social_link']) ? $item['basic_social_link'] : '',
                    'icon' => $icon
                ];
            }
        }

        // Format basic_footer_info fields
        $formatted_footer_info = [];

        if (!empty($footer_info) && is_array($footer_info)) {
            $formatted_footer_info = [
                'logo' => !empty($footer_info['basic_footer_logo']) ? $footer_info['basic_footer_logo'] : '',
                'description' => $footer_info['basic_footer_description'] ?? ''
            ];
        }

        $options = array(
            'footer_copyright' => get_field('basic_copyright_text', 'option'),
            'whatsapp_number' => get_field('basic_whatsapp_number', 'option'),
            'basic_phone' => get_field('basic_phone', 'option'),
            'footer_logo' => is_array($footer_logo) ? $footer_logo['url'] : $footer_logo,
            'header_logo' => is_array($header_logo) ? $header_logo['url'] : $header_logo,
            'header_logo_mobile' => is_array($header_logo_mobile) ? $header_logo_mobile['url'] : $header_logo_mobile,
            'basic_social_media' => $formatted_social_media,
            'basic_contact' => get_field('basic_contact', 'option'),
            'basic_footer_info' => $formatted_footer_info
        );
        return $options;
    }
    return null;
}

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Override this method to remove the <ul> that wraps sub-menu items
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // Override this method to remove the </ul> closing tag
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = !empty($item->classes) ? implode(' ', $item->classes) : '';
        $output .= sprintf(
            '<a href="%s" class="%s text-gray-800 hover:text-default px-4 py-2 transition duration-300 uppercase text-sm tracking-wide">',
            esc_url($item->url),
            esc_attr($classes)
        );

        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= ''; // No need for closing tags as we're outputting individual <a> elements
    }
}

function add_whatsapp_link_to_menu($items, $args) {
    // Check if ACF is active and the WhatsApp number field exists
    if (function_exists('get_field') && $whatsapp_number = get_field('basic_whatsapp_number', 'option')) {
        // Define the WhatsApp URL
        $whatsapp_url = 'https://api.whatsapp.com/send?phone=' . $whatsapp_number;
        
        // Loop through each menu item to replace the WhatsApp link placeholder
        foreach ($items as $item) {
            if ($item->url === '#') { // Check for the placeholder URL
                $item->url = esc_url($whatsapp_url); // Update to WhatsApp link
                $item->target = '_blank'; // Open link in new tab
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'add_whatsapp_link_to_menu', 10, 2);



// -----------------------------------------------------------------------------
// Title Tag
// -----------------------------------------------------------------------------
add_theme_support('title-tag');

// -----------------------------------------------------------------------------
// Body class
// -----------------------------------------------------------------------------
add_filter('body_class', 'custombodyclass');
function custombodyclass($classes){
	if(is_home() || is_front_page())
		$classes[] = 'mainpage';
		return $classes;
}

// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
return 35;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );

// -----------------------------------------------------------------------------
// Main Menu / Navwalker
// -----------------------------------------------------------------------------
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
register_nav_menus(array(
	'primary' => __( 'Primary Menu', 'header-menu' ),
));

function mytheme_add_woocommerce_support(){
  add_theme_support('woocommerce', array(
  'thumbnail_image_width' => 150,
  'single_image_width' => 300,
  'product_grid' => array(
    'default_rows' => 3,
    'min_rows' => 2,
    'max_rows' => 8,
    'default_columns' => 4,
    'min_columns' => 2,
    'max_columns' => 5,
    ),
  ));
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

// -----------------------------------------------------------------------------
// woocommerce zoom
// -----------------------------------------------------------------------------
function mytheme_add_woocommerce_zooming(){
  add_theme_support('wc-product-gallery-zoom');
  //add_theme_support('wc-product-gallery-lightbox');
  //add_theme_support('wc-product-gallery-slider');
}
add_action('wp', 'mytheme_add_woocommerce_zooming', 99);

function cl (){
    the_excerpt();
}
add_action('woocommerce_after_shop_lopp_item_title', 'cl', 40);

// -----------------------------------------------------------------------------
// ACF Option page
// -----------------------------------------------------------------------------
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
		'page_title' 	=> 'Company Profile Management System',
		'menu_title'	=> 'Complements',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
}


// -----------------------------------------------------------------------------
// Other / Related Blog Post
// -----------------------------------------------------------------------------
function example_cats_related_post() {
  $post_id = get_the_ID();
  $cat_ids = array();
  $categories = get_the_category( $post_id );

  if(!empty($categories) && is_wp_error($categories)):
    foreach ($categories as $category):
        array_push($cat_ids, $category->term_id);
    endforeach;
  endif;

  $current_post_type = get_post_type($post_id);
  $query_args = array(
      'category__in'   => $cat_ids,
      'post_type'      => $current_post_type,
      'post_not_in'    => array($post_id),
      'posts_per_page'  => '3'
 	);

  $related_cats_post = new WP_Query( $query_args );

	if($related_cats_post->have_posts()):
		while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box-image">
					<span>
						<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								echo '<img src="'.$image[0].'" data-id="'.$post->ID.'" class="img-responsive">';
							}
						?>
					</span>
				</div><!-- end .box-image -->
	      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<span>Post by <?php the_author(); ?>, <?php the_time('F jS, Y'); ?></span>
	      <?php the_content(); ?>
		  </div>
		<?php endwhile;

		// Restore original Post Data
		wp_reset_postdata();
	endif;
}


add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field', 20);
function add_default_value_to_image_field($field) {
  $args = array(
    'label' => 'Default Image',
    'instructions' => 'Appears when creating a new post',
    'type' => 'image',
    'name' => 'default_value'
  );
  acf_render_field_setting($field, $args);
}

add_action('admin_enqueue_scripts', 'enqueue_uploader_for_image_default');
function enqueue_uploader_for_image_default() {
  $screen = get_current_screen();
  if ($screen && $screen->id && ($screen->id == 'acf-field-group')) {
    acf_enqueue_uploader();
  }
}

add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);

function reset_default_image($value, $post_id, $field) {
  if (!$value) {
    $value = $field['default_value'];
  }
  return $value;
}

// loading the field
add_action('acf/load_field/name=SF_uImage', 'load_select_field_name_choices');
function load_select_field_name_choices($field) {
  $choices = array();
  if (have_rows('sf_uno', 'options')) {
    while (have_rows('sf_uno', 'options')) {
      the_row();
      $title = get_sub_field('SF_uImage');
      $choices[$title] = $title;
    } // end while have rows
  }  // end if get field
} // end function

function my_acf_admin_head() {
    ?>
    <style type="text/css">

        .postbox-container .meta-box-sortables .postbox {
            width: 80%;
            margin: 0 auto;
        }

        #editor .postbox > .postbox-header .hndle  {
            padding-left: 0px;
        }
    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

// -----------------------------------------------------------------------------
// Main Image Size Setting
// -----------------------------------------------------------------------------
if (function_exists('add_theme_support')) {
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true);
    add_image_size('medium', 320, 200, true);
    add_image_size('small', 120, '', true);
    add_image_size('full');
    add_image_size('admin-list-thumb', 80, 80, true);
    add_image_size('album-grid', 450, 450, true );
    add_image_size('gallery-slide', 900, 500, true);
    add_image_size('custom-size', 900, 300, true);
    add_image_size('gallery-slide-main', 1920, 1080, true);
}

// -----------------------------------------------------------------------------
// Style and vendor
// -----------------------------------------------------------------------------
function my_theme_enqueue_styles() {

    $parent_style = 'offizt-style';
    $css_file = get_template_directory() . '/main.css';
    $version = file_exists($css_file) ? filemtime($css_file) : '1.0.0';
    //wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js', array(), null, true );
    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js', array(), null, true );    
    wp_enqueue_script('jsflexslider', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/jquery.flexslider-min.js', array(), null, true );
    
		// wp_enqueue_script('jsowl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), null, true );
		wp_enqueue_script('jsfancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array(), null, true );
    // wp_enqueue_script('jsvendor', get_stylesheet_directory_uri() .  '/asset/js/vendor/vendor.min.js', array(), null, true );
    wp_enqueue_script('jsglobal', get_stylesheet_directory_uri() .  '/asset/js/global.js', array(), null, true );

    // wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.4/css/all.css', array(), null,'all' );
    wp_enqueue_style('flexslider', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/flexslider.min.css', array(), null,'all' );
		// wp_enqueue_style('owlcarousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), null,'all' );
		wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), null,'all' );
    // wp_enqueue_style('fontello', get_stylesheet_directory_uri() . '/asset/fontello/css/marker.css', array(), null,'all' );
		wp_enqueue_style('themify', get_stylesheet_directory_uri() . '/asset/fonts/themify-icons.css', array(), null,'all' );
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/main.css', array(), $version );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 60 );
//add_filter('acf/settings/show_admin', '__return_false');


// -----------------------------------------------------------------------------
// Google Fonts
// -----------------------------------------------------------------------------
function enqueue_selected_google_font() {
    $font_choice = get_field('google_font_choice', 'option'); // Use 'option' for global settings.

    if ($font_choice) {
        $font_name = str_replace(' ', '+', $font_choice);
        wp_enqueue_style('google-font-' . $font_name, "https://fonts.googleapis.com/css2?family={$font_name}:wght@100;200;300;400;500;600;700;800;900&display=swap");
    }
}
add_action('wp_enqueue_scripts', 'enqueue_selected_google_font');

add_filter('acf/load_field/name=google_font_choice', 'load_google_fonts');
function load_google_fonts($field) {
    // Define your Google Fonts
    $google_fonts = [
        'Roboto' => 'Roboto',
        'Open Sans' => 'Open Sans',
        'Outfit' => 'Outfit',
        'Lato' => 'Lato',
        'Montserrat' => 'Montserrat',
        'Poppins' => 'Poppins',
        'Jura' => 'Jura',
        'Michroma' => 'Michroma'
    ];

    // Set the choices for the select field
    $field['choices'] = $google_fonts;

    return $field;
}

function add_font_inline_styles() {
    $font_choice = get_field('google_font_choice', 'option');

    if ($font_choice) {
        echo "
        <style>
            body,
            html,
            h1,
            h2,
            h3,
            h4,
            p {
                font-family: '{$font_choice}', sans-serif;
            }
        </style>";
    }
}
add_action('wp_head', 'add_font_inline_styles');

function custom_excerpt_length($text) {
    return wp_trim_words($text, 30, '...'); // Adjust the word limit if necessary
}

function custom_trim_excerpt($text) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);

        $text = strip_tags($text);

        $excerpt_length = 50; // Limit to 200 characters
        $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
        $text = substr($text, 0, $excerpt_length) . $excerpt_more;
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

// -----------------------------------------------------------------------------
// Recent Page
// -----------------------------------------------------------------------------
function wpcrux_recent_posts( $num ) {
  // Prepare variables
  global $post;
  $html = null;

  // Build our basic custom query arguments
  $recent_pages_args = array(
    'post_type'      => 'page',
    'posts_per_page' => $num, // Number of recent pages to display
    'post__not_in'   => array( $post->ID ), // Ensure that the current page is not displayed
  );

  // Initiate the custom query
  $recent_pages = new WP_Query( $recent_pages_args );

  // Run the loop and collect data for the matched results
  if ( $recent_pages->have_posts() ) {
    $html = '<h3 class="widget-title">Recent Pages</h3><ul class="recent-pages">';
    while ( $recent_pages->have_posts() ) {
      $recent_pages->the_post();
      $html.= '<li><a href="' . get_permalink() . '" rel="bookmark noopener" target="_blank">' . get_the_title() . '</a></li>';
    }
    $html.= '</ul><!-- .recent-pages -->';
  }

  // Reset the loop
  wp_reset_postdata();

  // Return the final HTML
  return $html;
}

// -----------------------------------------------------------------------------
// Remove Header on 404
// -----------------------------------------------------------------------------
function remove_header() {
   	if ( is_page( 'error404' ) ) {
      	return;
   	}
   ?>
   	<style media="all">
   		body.error404 .navbar {
			display: none;
		}
   	</style>
   <?php
}
add_action('wp_head', 'remove_header');

// -----------------------------------------------------------------------------
// Breadcrumb
// -----------------------------------------------------------------------------
if ( ! function_exists( 'breadcrumbs' ) ) :
    function breadcrumbs() {
        $delimiter = '&rsaquo;';
        $home = 'Home';

        echo '<div xmlns:v="http://rdf.data-vocabulary.org/#" class="breadcrumb py-1">';
        global $post;
        echo '<a rel="v:url" property="v:title" href="'.home_url( '/' ).'" class="breadcrumb-link text-sm">'.$home.'</a>';

        $blog_url_field = get_field('basic_blog_url', 'option'); // Use 'option' to fetch from ACF Options page

        // Check if the field is set and contains a valid URL and title
        if ( !empty($blog_url_field) && isset($blog_url_field['url'], $blog_url_field['title']) ) {
            $blog_url = esc_url($blog_url_field['url']);
            $blog_title = esc_html($blog_url_field['title']); // Get the title
        } else {
            // Fallback if not set
            $blog_url = home_url('/blog/');
            $blog_title = 'Blog'; // Default title
        }

        // Check if the current page is the Blog Page
        $is_blog_page = ( get_permalink() === $blog_url );
        

        // Output the breadcrumb

        if ( $is_blog_page ) {
            // Avoid "Blog > Blog" on the blog list page
            echo '<span class="breadcrumb-current text-sm">' . $blog_title . '</span>';
        } else {
            // Output the breadcrumb link for the Blog
            echo "<span typeof=\"v:Breadcrumb\">
                <a class=\"breadcrumb-link text-sm\" rel=\"v:url\" property=\"v:title\" href=\"{$blog_url}\">{$blog_title}</a>
            </span>";

            // Add the current page title
            echo the_title(' <span class="breadcrumb-current text-sm">', '</span>', false);
        }

        echo '</div>';

    }
endif;

// Step 1: Add the dashboard option
function social_share_settings_init() {
    // Register a new setting
    register_setting('general', 'enable_social_share_buttons', array(
        'type' => 'boolean',
        'sanitize_callback' => 'rest_sanitize_boolean',
        'default' => 1, // Enable by default
    ));

    // Add a new section to the "General" settings page
    add_settings_field(
        'enable_social_share_buttons',
        __('Enable Social Share Buttons', 'textdomain'),
        'social_share_settings_callback',
        'general',
        'default',
        array(
            'label_for' => 'enable_social_share_buttons'
        )
    );
}
add_action('admin_init', 'social_share_settings_init');

function social_share_settings_callback($args) {
    // Get the current value of the setting
    $value = get_option('enable_social_share_buttons', 1);

    // Output the checkbox
    echo '<input type="checkbox" id="' . esc_attr($args['label_for']) . '" name="enable_social_share_buttons" value="1"' . checked(1, $value, false) . '>';
    echo '<p class="description">' . __('Check to enable social share buttons on posts.', 'textdomain') . '</p>';
}

// Step 2: Add social share buttons function
function add_social_share_buttons($content) {
    // Show only on single post pages
    if (!is_single()) {
        return $content; // Return content without the buttons
    }

    // Check if the setting to enable social share buttons is active
    if (!get_option('enable_social_share_buttons', 1)) {
        return $content;
    }

    // Get the current page URL
    $url = esc_url(get_permalink());

    // Get the current page title
    $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));

    // Create an array of social networks and their respective sharing URLs
    $social_networks = array(
        'Facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
        'Twitter' => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
        'LinkedIn' => 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title,
        'Pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $url . '&description=' . $title,
    );

    // Initialize the share buttons HTML
    $share_buttons = '<div class="social-share-buttons">';

    // Loop through the social networks and generate the share buttons HTML
    foreach ($social_networks as $network => $share_url) {
        $share_buttons .= '<a href="' . esc_url($share_url) . '" target="_blank" rel="noopener" class="' . strtolower($network) . '">' . esc_html($network) . '</a>';
    }

    // Close the share buttons HTML
    $share_buttons .= '</div>';

    // Append the share buttons HTML to the content
    $content .= $share_buttons;

    return $content;
}

// Add the social share buttons after the content
add_filter('the_content', 'add_social_share_buttons');



function select2_adjust() {
  	echo '<style>
			.select2-container--default .select2-selection--multiple .select2-selection__choice,
    		.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        		padding-left: 20px;
    		}
  		</style>';
}
add_action('admin_head', 'select2_adjust'); // admin_head is a hook my_custom_fonts is a function we are adding it to the hook

// -----------------------------------------------------------------------------
// Remove HTML tag
// -----------------------------------------------------------------------------
function register_html_support() {
    add_theme_support( 'html5', array( 'script', 'style' ) );
}

add_action( 'after_setup_theme', 'register_html_support' );

// -----------------------------------------------------------------------------
// Update Checker
// -----------------------------------------------------------------------------
require_once ( get_stylesheet_directory() . '/inc/plugin-update-checker/plugin-update-checker.php' );
    $updateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/bnzmgt/offizt',
        __FILE__,
        'offizt'
    );

    // $updateChecker->setAuthentication( array(
    //     'consumer_key' => 'fgRqxkNVeWkCxpumeT',
    //     'consumer_secret' => 'eJJTb6YYSGjVKZ6LszVgrGPejR79BKH8',
    // ));

    $updateChecker->setBranch( 'develop' );

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

?>
