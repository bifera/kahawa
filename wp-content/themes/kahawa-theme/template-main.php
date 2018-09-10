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
    $image = get_post_thumbnail_id($post->ID);
    $imageMobile = wp_get_attachment_image_src( $image, 'medium_large')[0];
    $imageDesktop = wp_get_attachment_image_src( $image, 'full')[0];
} else {
    $imageMobile = get_stylesheet_directory_uri().'/images/hero.jpg';
    $imageDesktop = get_stylesheet_directory_uri().'/images/hero.jpg';
}


?>
<style>
    .kahawa-hero {background-image: url(<?php echo $imageMobile;?>);}
    @media screen and (min-width: 768px){.kahawa-hero {background-image: url(<?php echo $imageDesktop;?>);}}
</style>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="kahawa-hero">
            <div class="overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/texture.svg);"></div>
            <?php 
            if (get_field('naglowek_rodzaj') == 'tekst') {
                $content = get_field('naglowek_naglowek');
                $header = '<h1 class="site-title">'.$content.'</h1>';

            } else {
                $logo = get_field('naglowek_logo');
                $header = '<h1 class="site-title"><img src="'.$logo["url"].'" width="'.$logo["width"].'" height="'.$logo["height"].'" alt="'.$logo["alt"].'" /></h1>';
            }
            $podtytul = get_field('naglowek_podtytul');
            $button = get_field('naglowek_button_tresc');
            $button_link = get_field('naglowek_button_odnosnik');
            ?>
            <div class="kahawa-intro col-full">
                <?php echo $header; ?>
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
        <?php if (get_field('wydarzenia_wyswietlic')) {?>
        <div class="kahawa-content col-full">
            <h2 class="title-as-link"><a href="<?php echo get_page_link(61);?>"><?php echo get_field('wydarzenia_naglowek');?></a></h2>
            <?php 
                                                       $args = array('post_type'=> 'wydarzenie', 'post_status' =>'publish','posts_per_page' => 3, 'orderby' => 'date');
                                                       $eventsQuery = new WP_Query( $args );

                                                       // The Loop
                                                       if ( $eventsQuery->have_posts() ) { ?>
            <div class="kahawa-row">
                <?php
                                                           while ( $eventsQuery->have_posts() ) {
                                                               $eventsQuery->the_post(); ?>
                <?php 
                                                               if (get_field('wydarzenie_nazwa', $post->ID)) {
                                                                   $title = get_field('wydarzenie_nazwa', $post->ID);
                                                               } else {
                                                                   $title = get_the_title();
                                                               }
                ?>
                <div class="col-third">
                    <div class="wydarzenie-tab">
                        <a href="<?php the_permalink(); ?>">
                            <div><?php echo get_the_post_thumbnail($post->ID, 'wydarzenie');?></div>
                            <h2 class="wydarzenie-title title-as-link"><?php echo $title; ?></h2>
                            <div class="wydarzenie-details">
                                <?php 
                                                               if (get_field('wydarzenie_data', $post->ID)){ ?>
                                <p class="wydarzenie-date">Data: <span class="wydarzenie-accent"><?php echo get_field('wydarzenie_data');?></span></p>
                                <?php } else { ?>
                                <p>Data: <span>wkrótce</span></p>
                                <?php } ?>
                                <?php 
                                                               if (get_field('wydarzenie_opis_short', $post->ID)) { ?>
                                <p class="wydarzenie-short-description"><?php echo get_field('wydarzenie_opis_short', $post->ID); ?></p>
                                <?php } ?>
                                <p class="wydarzenie-link">Czytaj więcej</p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div><?php wp_reset_postdata();
                                                       } else {
                                                           // no posts found
                                                       } ?>
        </div><?php } ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
