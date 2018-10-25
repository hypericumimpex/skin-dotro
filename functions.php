<?php
/**
 * Enqueue script and styles for child theme
 */


function woodmart_child_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 1000 );

function wpb_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Oferta Produs', 'wpb' ),
        'id' => 'oferta-produs',
        'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    register_sidebar( array(
        'name' =>__( 'Front page sidebar', 'wpb'),
        'id' => 'sidebar-2',
        'description' => __( 'Appears on the static front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );

/**
* Helper for removing the Revslider Metabox from being on every CPT edit screen
*
* @param $post_type
*/
function remove_revslider_metabox($post_type)
{
add_action('do_meta_boxes', function () use ($post_type) {
    remove_meta_box('mymetabox_revslider_0', $post_type, 'normal');
});
}
add_action('registered_post_type', 'remove_revslider_metabox');


/*
You can set the post type for which the editor should be
available by adding the following code to functions.php:
*/
add_action( 'vc_before_init', 'Use_wpBakery' );
function Use_wpBakery() {
$vc_list = array('page','capabilities','add_custom_post_type_here');
vc_set_default_editor_post_types($vc_list);
vc_editor_set_post_types($vc_list);
}

/** Woo Revision */
add_filter( 'woocommerce_register_post_type_product', 'wpse_modify_product_post_type' );

function wpse_modify_product_post_type( $args ) {
 $args['supports'][] = 'revisions';

 return $args;
}

function remove_gravity_forms_nag() {
update_option( 'rg_gforms_message', '' );
remove_action( 'after_plugin_row_gravityforms/gravityforms.php', array( 'GFForms', 'plugin_row' ) );
}
add_action( 'admin_init', 'remove_gravity_forms_nag' );

/* YITH */



