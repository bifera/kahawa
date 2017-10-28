<?php
/**
 * The template for displaying full width pages other than store pages.
 *
 * Template Name: Wydarzenia
 *
 * kahawa child theme for storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <h1><?php the_title();?></h1>
        <?php

        // The Query

        $args = array('post_type'=> 'wydarzenie', 'post_status' =>'publish','posts_per_page' => -1, 'orderby' => 'date');
        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post(); ?>
        <?php 
                if (get_field('wydarzenie_nazwa', $post->ID)) {
                    $title = get_field('wydarzenie_nazwa', $post->ID);
                } else {
                    $title = get_the_title();
                }
        ?>
        <h2><?php echo $title; ?></h2>
        <?php 
        if (get_field('wydarzenie_miejsce', $post->ID)){ ?>
        <div>Miejsce wydarzenia: <span><?php echo get_field('wydarzenie_miejsce'); ?></span></div>
        <?php } else { ?>
        <div>Miejsce wydarzenia: <span>wkrótce</span></div>
        <?php }?>
        <?php 
        if (get_field('wydarzenie_data', $post->ID)){ ?>
        <div>Data wydarzenia: <span><?php echo get_field('wydarzenie_data');?></span></div>
        <?php } else { ?>
        <div>Data wydarzenia: <span>wkrótce</span></div>
        <?php } ?>
        <?php 
        if (get_field('wydarzenie_opis_short', $post->ID)) { ?>
        <div><?php echo get_field('wydarzenie_opis_short', $post->ID); ?></div>
        <?php } ?>
        <a href="<?php the_permalink();?>">Szczegóły</a>
        <?php
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            // no posts found
        } ?>


    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
