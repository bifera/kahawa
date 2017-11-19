<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * kahawa child theme for storefront
 */

?>

<?php 

if (get_post_type() == 'product') {
    $shop = get_option('woocommerce_shop_page_id');
    $array =  wp_get_attachment_image_src( get_post_thumbnail_id( $shop ), 'full');
    $heroImage = $array[0];
} elseif (get_post_type() == 'wydarzenie') {
    $heroImage = get_the_post_thumbnail_url(61);
} elseif (get_field('hero_image')) {
    $heroImage = get_field('hero_image');
} else {
    if (has_post_thumbnail()) {
        $heroImage = get_the_post_thumbnail_url();
    } else {
        $heroImage = get_stylesheet_directory_uri().'/images/hero-1.jpg';
    }
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <?php do_action( 'storefront_before_site' ); ?>

        <div id="page" class="hfeed site">
            <?php do_action( 'storefront_before_header' ); ?>
                <?php 
            if (!is_page(get_option('page_on_front'))){ ?>
                <div class="kahawa-hero" style="background-image:url(<?php echo $heroImage;?>);">
                     <div class="overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/texture.svg);"></div>
                </div>
                <?php }?>
            <header id="masthead" class="site-header" role="banner">
                <div class="col-full kahawa-header-content">
                    <?php
                    /**
			 * Functions hooked into storefront_header action
			 *
			 * @hooked storefront_skip_links                       - 0
			 * @hooked storefront_social_icons                     - 10
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */

                    do_action( 'storefront_header' );
                    ?>
                </div>
            </header><!-- #masthead -->

            <?php
            /**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
            do_action( 'storefront_before_content' );

            ?>

            <div id="content" class="site-content" tabindex="-1">
                <div class="<?php if (is_page_template('template-main.php')) {echo 'homepage-content'; } else {echo 'col-full';} ?>">
                    <?php
                    /**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
                    do_action( 'storefront_content_top' );

