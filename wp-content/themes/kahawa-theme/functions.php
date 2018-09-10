<?php

include('custom-posts/custom-posts.php');

/* add custom theme fonts */
wp_enqueue_style( 'kahawa-custom-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Open+Sans+Condensed:300,300i,700&amp;subset=latin-ext');

function kahawa_child_styles(){
    wp_dequeue_style('storefront-fonts');
}
add_action( 'wp_enqueue_scripts', 'kahawa_child_styles', 999);


/* add custom scripts */
wp_enqueue_script( "kahawa-scripts", get_stylesheet_directory_uri().'/scripts/app.min.js', array ( 'jquery'), '1.0', true );

function kahawa_custom_image_sizes(){
    add_theme_support( 'post-thumbnails' );
    add_image_size('wydarzenie', 600, 600, true);
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
    <a href="<?php echo site_url(); ?>" title="Kahawa Kawa i Książka"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-black.svg" alt="Kahawa Kawa i Książka"></a>
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
<div class="kahawa-row">
    <div class="col-half"><?php wp_nav_menu(array('menu'=> 'Footer Menu'))?></div>
    <div class="col-half kahawa-info">&copy;&nbsp;<?php echo get_bloginfo('name')." ".date("Y"); ?></div>
    <div class="col-half payments-container"><img class="footer-payment-logo" src="<?php echo get_stylesheet_directory_uri();?>/images/dp_logo_alpha.png" width="75" height="22" alt="dotpay payment info"><img class="footer-payment-cards" src="<?php echo get_stylesheet_directory_uri();?>/images/payment_cards.jpg" alt="payment methods"></div>
</div>
<?php 
                                                  }
    }
}

// register kahawa footer widgets
add_action('widgets_init', 'kahawa_sidebars');
if ( ! function_exists('kahawa_sidebars')) {
    function kahawa_sidebars(){



        $argsS01 = array(
            'name'          => __( 'Footer panel 1', 'Kahawa' ),
            'id'            => 'footer-panel-01',
            'description'   => '',
            'class'         => '',
            'before_widget' => '<div class="kahawa-footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>' );    

        $argsS02 = array(
            'name'          => __( 'Footer panel 2', 'Kahawa' ),
            'id'            => 'footer-panel-02',
            'description'   => '',
            'class'         => '',
            'before_widget' => '<div class="kahawa-footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>' );    

        register_sidebar($argsS01);
        register_sidebar($argsS02);
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
    <div class="col-half"><?php dynamic_sidebar('footer-panel-01');?></div>
    <div class="col-half"><?php dynamic_sidebar('footer-panel-02');?></div>
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

// ------- register kahawa footer menu


add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
    register_nav_menu( 'footer-menu', __( 'Footer Menu', 'kahawa' ) );
}

/*****************************************/
/******* fix shipping & payment **********/
/*****************************************/

function my_custom_available_payment_gateways( $gateways ) {
    $chosen_shipping_rates =(array) WC()->session->get( 'chosen_shipping_methods' );

    if ( in_array( 'flat_rate:10', $chosen_shipping_rates ) ) :
    unset( $gateways['cod'] );
    unset ( $gateways['other_payment'] );

    elseif ( in_array( 'flat_rate:13', $chosen_shipping_rates ) ) :
    unset( $gateways['dotpay'] );
    unset ( $gateways['other_payment'] );

    elseif ( in_array( 'flat_rate:11', $chosen_shipping_rates ) ) :
    unset( $gateways['cod'] );
    unset ( $gateways['other_payment'] );

    elseif ( in_array( 'flat_rate:14', $chosen_shipping_rates ) ) :
    unset( $gateways['dotpay'] );
    unset ( $gateways['other_payment'] );

    elseif ( in_array( 'local_pickup:4', $chosen_shipping_rates ) ) :
    unset( $gateways['dotpay'] );
    unset ( $gateways['cod'] );

    endif;
    return $gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'my_custom_available_payment_gateways', 1 );