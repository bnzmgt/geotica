<?php

/**
 * The template for displaying search results pages
 */

get_header();

?>

<div id="content" class="page">
	<div class="page-intro">
   	 	<?php if( get_field('cover_image_blog') ): ?>
      	<div class="intro-inner" style="background-image: url('<?php the_field('cover_image_blog'); ?>')">
		<?php endif; ?>
			<div class="outer-inner">
				<div class="inner-box clearfix">
					<div class="inner-box-container">
						<div class="intro-title">
							<h1><?php the_title(); ?> </h1>
						</div>
					</div><!-- end .inner-container -->
				</div><!-- end .inner-box -->
			</div><!-- end .outer-inner -->
		</div><!-- end .intro-inner -->
  	</div><!-- end .page-intro -->

    <div class="content-wrap margintb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
					<?php if ( have_posts() ) : ?>
						<ul>
				          <?php while ( have_posts() ) : the_post(); ?>
				            <li>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<?php the_excerpt(); ?>
							</li>
				          <?php endwhile; ?>
				        </ul>
				        <?php wp_reset_query(); ?>
					<?php
					else :
						echo ( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.');
						get_search_form();
					endif;
					?>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <aside class="sidebar sidebar-right">
                        <div class="widget">

                        </div><!-- end .widget -->
                    </aside>
                </div><!-- end .col-md-4 -->
            </div>
        </div><!-- end .container -->
    </div><!-- end .content-wrap -->
</div><!-- end .content -->

<?php get_footer(); ?>
