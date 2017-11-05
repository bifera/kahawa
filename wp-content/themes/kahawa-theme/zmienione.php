<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package storefront
 */

get_header(); ?>
<?php 
$shop = get_option('woocommerce_shop_page_id');
if (is_post_type_archive('product')) {
    $array = wp_get_attachment_image_src( get_post_thumbnail_id( $shop ), 'full');
    $image = $array[0];
    $title = get_the_title($shop);
} else {
    $image = get_stylesheet_directory_uri().'/images/hero.jpg';
    $title = get_the_title();
}

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php if ( have_posts() ) : ?>
        <div class="kahawa-hero" style="background-image: url(<?php echo $image; ?>);">
            <div class="overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/texture.svg);"></div>
            <div class="col-full"><h1 class="subpage-title"><?php echo $title;?></h1></div>
        </div>
        <div class="col-full">

            <div class="kahawa-store-content">

                <?php get_template_part( 'loop' );

                else :

                get_template_part( 'content', 'none' );

                endif; ?>

            </div> <?php
            do_action( 'storefront_sidebar' ); ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
