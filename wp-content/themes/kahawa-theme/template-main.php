<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Home Page
 *
 * kahawa child theme for storefront
 */

get_header(); ?>

<?php 
if (has_post_thumbnail()) {
    $image = get_the_post_thumbnail_url();
} else {
    $image = get_stylesheet_directory_uri().'/images/hero.jpg';
}


?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="kahawa-hero" style="background-image: url(<?php echo $image;?>);">
            <div class="overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/texture.svg);"></div>
            <?php 
            if (get_field('czy_wlasny_naglowek') == 1) {
                $naglowek = get_field('naglowek_naglowek');
                $podtytul = get_field('naglowek_podtytul');
                $button = get_field('naglowek_button_tresc');
                $button_link = get_field('naglowek_button_odnosnik');
            } else {
                $naglowek = "Kahawa";
                $podtytul = "Kawa i książka";
                $button = "Dowiedz się więcej";
                $button_link = "#pierwsza";
            }
            ?>
            <div class="kahawa-intro col-full">
                <h1 class="site-title">KAHAWA</h1>
                <h2 class="site-subtitle">Kawa i Książka</h2>
                <p class="kahawa-subtitle"><?php echo $podtytul;?></p>
                <p><a href="<?php echo $button_link;?>" class="button button-open"><?php echo $button;?></a></p>
            </div>
        </div>

        <?php
        /**
			 * Functions hooked in to homepage action
			 *
			 * @hooked storefront_homepage_content      - 10
			 * @hooked storefront_product_categories    - 20
			 * @hooked storefront_recent_products       - 30
			 * @hooked storefront_featured_products     - 40
			 * @hooked storefront_popular_products      - 50
			 * @hooked storefront_on_sale_products      - 60
			 * @hooked storefront_best_selling_products - 70
			 */
        //do_action( 'homepage' ); ?>
        <div class="kahawa-content col-full">
            <?php 
            if (have_posts()){
                while (have_posts()){
                    the_post();
                    the_content();
                }
            }
            ?>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
