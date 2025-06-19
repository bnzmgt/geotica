<?php


get_header();

?>


<div id="wrapper" class="singlepage">

  <?php
  	$image = get_field('cover_image');
  	if( !empty($image) ): ?>

  <div class="coverbox" style="background-image:url('<?php echo $image['url']; ?>')">

  <?php endif; ?>

    <div class="outerbox">
      <div class="innerbox clearfix">
        <div class="container">
          <div class="boxtitle">
            <div class="innertitle">
              <h1>Blog dasdas</h1>
              <div class="subtext">Home | <span class="subactive"> Blog</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end coverbox -->

  <?php
		if (have_posts()): while (have_posts()) : the_post();

		 get_template_part('partials', 'loader');
		?>


		<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>



</div>


<?php get_footer(); ?>
