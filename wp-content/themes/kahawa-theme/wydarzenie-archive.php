<?php
/**
 * The template for displaying full width pages other than store pages.
 *
 * Template Name: Wydarzenia
 *
 * kahawa child theme for storefront
 */

get_header();



if (has_post_thumbnail()) {
    $image = get_the_post_thumbnail_url();
} else {
    $image = get_stylesheet_directory_uri().'/images/hero.jpg';
}

?>



<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="kahawa-hero" style="background-image: url(<?php echo $image; ?>);">
            <div class="overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/texture.svg);"></div>
            <div class="col-full"><h1 class="subpage-title"><?php the_title();?></h1></div>
        </div>
        <div class="col-full">
            <?php

            // The Query

            $args = array('post_type'=> 'wydarzenie', 'post_status' =>'publish','posts_per_page' => -1, 'orderby' => 'date');
            $the_query = new WP_Query( $args );

            // The Loop
            if ( $the_query->have_posts() ) { ?>
            <div class="kahawa-row">
                <?php
                while ( $the_query->have_posts() ) {
                    $the_query->the_post(); ?>
                <?php 
                    if (get_field('wydarzenie_nazwa', $post->ID)) {
                        $title = get_field('wydarzenie_nazwa', $post->ID);
                    } else {
                        $title = get_the_title();
                    }
                ?>
                <div class="col-third">
                    <div class="single-tab">
                        <div><?php echo get_the_post_thumbnail($post->ID, array('650', '650'));?></div>
                        <h2 class="wydarzenie-title"><a href="<?php the_permalink();?>"><?php echo $title; ?></a></h2>
                        <div class="wydarzenie-details">
                            <?php 
                    if (get_field('wydarzenie_miejsce', $post->ID)){ ?>
                            <p>Miejsce wydarzenia: <span class="wydarzenie-accent"><?php echo get_field('wydarzenie_miejsce'); ?></span></p>
                            <?php } else { ?>
                            <p>Miejsce wydarzenia: <span>wkrótce</span></p>
                            <?php }?>
                            <?php 
                    if (get_field('wydarzenie_data', $post->ID)){ ?>
                            <p>Data wydarzenia: <span class="wydarzenie-accent"><?php echo get_field('wydarzenie_data');?></span></p>
                            <?php } else { ?>
                            <p>Data wydarzenia: <span>wkrótce</span></p>
                            <?php } ?>
                            <?php 
                    if (get_field('wydarzenie_opis_short', $post->ID)) { ?>
                            <p><?php echo get_field('wydarzenie_opis_short', $post->ID); ?></p>
                            <?php } ?>
                            <p class="wydarzenie-link"><a href="<?php the_permalink();?>">Czytaj więcej</a></p>
                        </div>
                    </div>
                </div>
                <?php
                } ?>

            </div>
            <?php
                wp_reset_postdata();
            } else {
                // no posts found
            } ?>

        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
