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
            $categories = get_categories(array('orderby'=>'name'));
            $eventTypes = get_terms(array('taxonomy'=>'rodzaj','orderby'=>'name'));
            foreach($eventTypes as $eventType){
                $eventTypeID = $eventType->term_id; ?>
            <section class="kahawa-events-section event-<?php echo $eventType->slug;?>">
               <a class="kahawa-event-link event-<?php echo $eventType->slug;?>" href="<?php echo get_term_link($eventTypeID); ?>"><h2><?php echo $eventType->name;?></h2></a>
                <?php
                $queryArgs = array(
                    'post_type'=>'wydarzenie',
                    'post_status'=>'publish',
                    'posts_per_page'=>3,
                    'orderby'=>'date',
                    'tax_query'=>array(
                        array(
                            'taxonomy'=>'rodzaj',
                            'field'=>'term_id',
                            'terms'=>$eventTypeID
                        )
                    )   
                );
                $events_query = new WP_Query( $queryArgs );
                if ( $events_query->have_posts() ) { ?>
                <div class="kahawa-row">
                    <?php
                    while ( $events_query->have_posts() ) {
                        $events_query->the_post(); ?>
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
                    <?php
                    } ?>
                </div>
                <?php
                } else {
                // no posts found
            } ?>
            </section>
            <?php

            } ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
