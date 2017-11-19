<?php
/**
 * The template for displaying full width pages other than store pages.
 *
 * Template Name: Wydarzenia
 *
 * kahawa child theme for storefront
 */

get_header();
?>



<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="entry-header">
            <h1 class="subpage-title"><?php the_title();?></h1>
        </div>
        <div class="entry-content">

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
                    <div class="wydarzenie-tab">
                        <a href="<?php the_permalink(); ?>">
                            <div><?php echo get_the_post_thumbnail($post->ID, array('650', '650'));?></div>
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
