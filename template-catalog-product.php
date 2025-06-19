<?php
/**
* Template Name: Catalog Product
**/

get_header();
?>

<div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="container w-11/12 lg:w-9/12 mx-auto px-4 md:px-8">

        <div class="catalog">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="product">
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo get_field('product_price'); ?></p>
                    <p><?php the_content(); ?></p>
                </div>
            <?php endwhile; endif; ?>
        </div>

    </div>
</div>
<?php
get_footer();
?>