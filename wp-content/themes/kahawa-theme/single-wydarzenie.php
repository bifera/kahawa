<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post();

        if (get_field('wydarzenie_nazwa')) {
            $title = get_field('wydarzenie_nazwa');
        } else {
            $title = get_the_title();
        }

        ?>
        <div class="entry-header">
            <h1 class="page-title"><?php echo $title; ?></h1>
        </div>
        <div class="entry-content">

            <?php 
            if (get_field('wydarzenie_miejsce')){ ?>
            <div>Miejsce wydarzenia: <span><?php echo get_field('wydarzenie_miejsce'); ?></span></div>
            <?php } else { ?>
            <div>Miejsce wydarzenia: <span>wkrótce</span></div>
            <?php }?>
            <?php 
            if (get_field('wydarzenie_data')){ ?>
            <div>Data wydarzenia: <span><?php echo get_field('wydarzenie_data');?></span></div>
            <?php } else { ?>
            <div>Data wydarzenia: <span>wkrótce</span></div>
            <?php } ?>

            <?php the_content(); ?>
        </div>
        <?php
        endwhile; // End of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
