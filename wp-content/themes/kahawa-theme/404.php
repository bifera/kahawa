<?php
/**
 * The template for displaying full width pages other than store pages.
 *
 * Template Name: Kahawa Page
 *
 * kahawa child theme for storefront
 */

get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="entry-header"><h1 class="subpage-title">Nie znaleziono strony</h1></div>
        <div class="entry-content">

            <?php
            do_action( 'storefront_page_before' );

            ?>
            <div class="kahawa-404">
                <p>Strona o podanym adresie nie istnieje.</p>
                <p><a class="button" href="<?php echo get_page_link(get_option('page_on_front'));?>">Wróć na stronę główną</a>
                </p>
            </div>
            <?php

            /**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
            do_action( 'storefront_page_after' ); ?>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
