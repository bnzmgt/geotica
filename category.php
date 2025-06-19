<?php
/**
 * The template for displaying category archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();


// get the current taxonomy term
$term = get_queried_object();


// vars
$image = get_field('image', $term);
$color = get_field('color', $term);

?>

<div id="content" class="page">
    <div class="page-intro">
        <?php if( get_field('basic_top_image', 'options') ): ?>
        <div class="intro-inner" style="background-image: url('<?php the_field('basic_top_image', 'options'); ?>')">
        <?php endif; ?>
            <div class="outer-inner">
                <div class="container inner-box clearfix">
                    <div class="inner-box-container">
                        <div class="intro-title">
                            <h1><?php echo get_the_category_list( ', ', '' ); ?></h1>
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

    <div class="content-wrap margintb-50">
        <div class="container">
            <ul>
                <?php while ( have_posts() ) : the_post(); ?>
                <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
            <?php wp_reset_query(); ?>
        </div><!-- end .container -->
    </div><!-- end #content-wrap -->
</div><!-- end #content -->

<?php get_footer(); ?>
