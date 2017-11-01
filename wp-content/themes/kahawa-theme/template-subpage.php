<?php
/**
 * The template for displaying full width pages other than store pages.
 *
 * Template Name: Kahawa Page
 *
 * kahawa child theme for storefront
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post();

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

			
<?php
				do_action( 'storefront_page_before' );

				get_template_part( 'template-parts/content', 'subpage' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
