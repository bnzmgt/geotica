<?php
/**
* 404 Page (Not Found) Template
*
* @package WordPress
*
* @subpackage Demo_Theme
*
* @since Demo Theme Version 1.0
*/


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">
              	<div class="fourwrap text-center">
                  	<img src="<?php echo get_bloginfo('template_directory') ?>/img/404.png" alt="Page Not Found" title="Page Not Found" class="img-fluid no-lazy">
                    <p>Sorry! This Page is Not Available!</p>
                  	<p><a href="/" title="back">Back to Homepage</a></p>
              	</div>
	        </div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->