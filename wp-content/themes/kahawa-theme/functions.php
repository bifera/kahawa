<?php

include('custom-posts/custom-posts.php');

/* add custom theme fonts */
wp_enqueue_style( 'kahawa-custom-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Open+Sans+Condensed:300,300i,700&amp;subset=latin-ext');

wp_enqueue_script( "kahawa-scripts", get_stylesheet_directory_uri().'/scripts/app.js' );




function kahawa_custom_image_sizes(){
    add_theme_support( 'post-thumbnails' );
    add_image_size('wydarzenie', 650, 650, true);
}
add_action( 'after_setup_theme', 'kahawa_custom_image_sizes' );

/*****************************************/
/** add kahawa custom header appearance **/
/*****************************************/


// ------ prepare function to be hooked

if ( ! function_exists( 'kahawa_display_custom_header_cart' ) ) {
    /**
	 * Display Kahawa Header Cart
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
    function kahawa_display_custom_header_cart() {
        if (storefront_is_woocommerce_activated()){ ?>
<ul id="kahawa-header-cart" class="kahawa-header-cart menu">
    <li class="<?php echo esc_attr( $class ); ?> kahawa-cart-link">
        <a href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-coffee" title="Mój koszyk"></i><span><?php echo WC()->cart->get_cart_contents_count();?></span></a>

    </li>
    <li><?php if ( is_user_logged_in() ) { ?>
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="Moje konto"><i class="fa fa-user"></i></a>
        <?php } else { ?>
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="Logowanie/Rejestracja"><i class="fa fa-user"></i></a>
        <?php } ?>
    </li>
    <li>
        <a href="<?php echo WC()->cart->get_checkout_url(); ?>" title="Zamówienie"><i class="fa fa-shopping-basket"></i></a>
    </li>
</ul><?php 
                                                  }
    }
}

if ( ! function_exists( 'kahawa_site_branding' ) ) {
    function kahawa_site_branding(){ ?>
<div class="site-branding">
    <a href="<?php echo site_url(); ?>" title="Kahawa Kawa i Książka"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-black.png" alt="Kahawa Kawa i Książka"></a>
</div> <?php
                                   }
}

// ------ the hook

add_action( 'init', 'kahawa_custom_menu_appearance');
function kahawa_custom_menu_appearance() {
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_site_branding', 20);
    add_action( 'storefront_header', 'kahawa_display_custom_header_cart', 60 );
    add_action( 'storefront_header', 'kahawa_site_branding', 20 );
}


/*****************************************/
/******* remove breadcrumbs **************/
/*****************************************/

add_action('init', 'kahawa_custom_content_appearance');
function kahawa_custom_content_appearance(){
    remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10 );
}


/*****************************************/
/** add kahawa custom footer appearance **/
/*****************************************/

// ------ prepare functions to be hooked
// kahawa credit

if ( ! function_exists( 'kahawa_footer_credit' ) ) {
    /**
	 * Display Kahawa Footer Credit
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
    function kahawa_footer_credit() {
        if (storefront_is_woocommerce_activated()){ ?>
<div class="kahawa-info">&copy;&nbsp;<?php echo get_bloginfo('name')." ".date("Y"); ?></div>
<?php 
                                                  }
    }
}

// register kahawa footer widgets
add_action('widgets_init', 'kahawa_sidebars');
if ( ! function_exists('kahawa_sidebars')) {
    function kahawa_sidebars(){
        register_sidebars(2, array('name'=>'Footer Panel %d', 'id'=>'footer-panel-%d', 'before_widget'=>'<div class="kahawa-footer-widget">', 'after_widget'=>'</div>'));
    }
}

// kahawa footer widgets function
if ( ! function_exists( 'kahawa_footer_widgets' ) ) {
    /**
	 * Display Kahawa Footer Widgets
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
    function kahawa_footer_widgets() {
        if (storefront_is_woocommerce_activated()){ ?>
<div class="kahawa-row">
    <div class="col-half"><?php dynamic_sidebar('footer-panel-1');?></div>
    <div class="col-half"><?php dynamic_sidebar('footer-panel-2');?></div>
</div>
<?php 
                                                  }
    }
}


// ------ the hook

add_action( 'init', 'kahawa_custom_footer_appearance');
function kahawa_custom_footer_appearance() {
    remove_action('storefront_footer', 'storefront_footer_widgets', 10);
    add_action('storefront_footer', 'kahawa_footer_widgets', 10);
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'kahawa_footer_credit', 20 );
}
