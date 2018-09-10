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

        ?>
        <div class="entry-header">
            <h1 class="subpage-title"><?php echo get_the_title();; ?></h1>
        </div>
        <div class="entry-content">
            <div class="entry-details kahawa-row">
                <div class="entry-thumbnail col-third">
                    <?php echo get_the_post_thumbnail($post->ID, 'wydarzenie'); ?>
                </div>
                <div class="entry-date col-three-quart">
                    <?php 
                    if (get_field('wydarzenie_data')){ ?>
                    <div class="wydarzenie-date">Data: <span><?php echo get_field('wydarzenie_data');?></span></div>
                    <?php } else { ?>
                    <div>Data: <span>wkrótce</span></div>
                    <?php } ?>

                    <?php
                    if (get_field('wydarzenie_opis_short')) { ?>
                       <div class="wydarzenie-short-description">
                           <?php the_field('wydarzenie_opis_short'); ?>
                       </div>
                    <?php } ?>
                    <div class="wydarzenie-full-description"><?php the_content(); ?></div>
                </div>
            </div>   
        </div>
        <div class="entry-footer">
            <a class="back-link" href="<?php echo get_page_link(61); ?>">&lt; &lt; Powrót do Wydarzeń</a>
        </div>
        <?php
        endwhile; // End of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
