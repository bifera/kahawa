<?php
get_header();


$thisTerm = $wp_query->queried_object;
$term = $thisTerm->slug;

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="entry-header">
            <h1 class="subpage-title"><?php echo single_term_title();?></h1>
        </div>
        <div class="entry-content">
            <section class="kahawa-events-section">
                <p><?php echo $thisTerm->description; ?></p>
                <?php
                $queryArgs = array(
                    'post_type'=>'wydarzenie',
                    'post_status'=>'publish',
                    'posts_per_page'=>-1,
                    'orderby'=>'date',
                    'tax_query'=>array(
                        array(
                            'taxonomy'=>'rodzaj',
                            'field'=>'slug',
                            'terms'=>$term
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
                } else {
                    // no posts found
                } ?>

            </section>
        </div>
        <div class="entry-footer">
            <a class="back-link" href="<?php echo get_page_link(61); ?>">&lt; &lt; Powrót do Wydarzeń</a>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->


<?php
get_footer();