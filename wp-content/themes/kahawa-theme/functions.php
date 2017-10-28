<?php

include('custom-posts/custom-posts.php');

/* add custom theme fonts */
wp_enqueue_style( 'kahawa-custom-fonts', 'https://fonts.googleapis.com/css?family=Quando|Lato');

/***********************************/
/** add kahawa custom header cart **/
/**********************************/


// ------ prepare function to be hooked

if ( ! function_exists( 'storefront_display_custom_header_cart' ) ) {
    /**
	 * Display Kahawa Header Cart
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
    function storefront_display_custom_header_cart() {
        if (storefront_is_woocommerce_activated()){ ?>
            <ul id="kahawa-header-cart" class="site-header-cart hooked kahawa menu">
                <li class="<?php echo esc_attr( $class ); ?> hooked">
                    <a href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-coffee"></i><span><?php echo WC()->cart->get_cart_contents_count();?></span></a>
        
                </li>
                <li><?php if ( is_user_logged_in() ) { ?>
 	                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Moje konto','woothemes'); ?>"><i class="fa fa-user"></i></a>
 	                <?php } else { ?>
 	                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Logowanie / Rejestracja','woothemes'); ?>"><i class="fa fa-user"></i></a>
 	                <?php } ?>
                </li>
            </ul><?php 
        }
    }
}

// ------ the hook

add_action( 'init', 'storefront_custom_header_cart');
function storefront_custom_header_cart() {
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    add_action( 'storefront_header', 'storefront_display_custom_header_cart', 60 );
}