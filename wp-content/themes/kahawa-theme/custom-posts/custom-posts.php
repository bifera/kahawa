<?php 
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Wydarzenia', 'Wydarzenia', 'text_domain' ),
		'singular_name'         => _x( 'Wydarzenie', 'Wydarzenie', 'text_domain' ),
		'menu_name'             => __( 'Wydarzenia', 'text_domain' ),
		'name_admin_bar'        => __( 'Wydarzenia', 'text_domain' ),
		'archives'              => __( 'Archiwum wydarzeń', 'text_domain' ),
		'attributes'            => __( 'Atrybuty', 'text_domain' ),
		'parent_item_colon'     => __( 'Element ndarzędny:', 'text_domain' ),
		'all_items'             => __( 'Wszystkie Wydarzenia', 'text_domain' ),
		'add_new_item'          => __( 'Dodaj Nowe Wydarzenie', 'text_domain' ),
		'add_new'               => __( 'Dodaj Nowe', 'text_domain' ),
		'new_item'              => __( 'Nowe Wydarzenie', 'text_domain' ),
		'edit_item'             => __( 'Edytuj Wydarzenie', 'text_domain' ),
		'update_item'           => __( 'Zaktualizuj Wydarzenie', 'text_domain' ),
		'view_item'             => __( 'Zobacz Wydarzenie', 'text_domain' ),
		'view_items'            => __( 'Zobacz Wydarzenia', 'text_domain' ),
		'search_items'          => __( 'Znajdź Wydarzenie', 'text_domain' ),
		'not_found'             => __( 'Nie znaleziono', 'text_domain' ),
		'not_found_in_trash'    => __( 'Nie znaleziono w Koszu', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Lista', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Wydarzenie', 'text_domain' ),
		'description'           => __( 'Opis Wydarzenia', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
        'rewrite'               => array('slug'=>'wydarzenia'),
	);
	register_post_type( 'wydarzenie', $args );

}

function custom_taxonomy(){
	$labels = array(
		'name'                       => _x( 'Rodzaje', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Rodzaj', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Znajdź Rodzaje', 'textdomain' ),
		'popular_items'              => __( 'Popularne Rodzaje', 'textdomain' ),
		'all_items'                  => __( 'Wszystkie Rodzaje', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edytuj Rodzaj', 'textdomain' ),
		'update_item'                => __( 'Zaktualizuj Rodzaj', 'textdomain' ),
		'add_new_item'               => __( 'Dodaj nowy Rodzaj', 'textdomain' ),
		'new_item_name'              => __( 'Nazwa nowego Rodzaju', 'textdomain' ),
		'separate_items_with_commas' => __( 'Oddzielone przecinkami', 'textdomain' ),
		'add_or_remove_items'        => __( 'Dodaj lub usuń Rodzaje', 'textdomain' ),
		'choose_from_most_used'      => __( 'Wybierz z najczęściej używanych Rodzajów', 'textdomain' ),
		'not_found'                  => __( 'Nie znaleziono Rodzajów.', 'textdomain' ),
		'menu_name'                  => __( 'Rodzaje', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'rodzaj' ),
	);

	register_taxonomy( 'rodzaj', 'wydarzenie', $args );
}


add_action( 'init', 'custom_post_type', 0 );
add_action( 'init', 'custom_taxonomy', 0);