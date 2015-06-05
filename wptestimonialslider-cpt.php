<?php 
/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function wpt_Slider() {

	$labels = array(
		'name'               => _x( 'Testimonials', 'wptestimonialslider' ),
		'singular_name'      => _x( 'Testimonial', 'wptestimonialslider' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'wptestimonialslider' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'wptestimonialslider' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'wptestimonialslider' ),
		'add_new_item'       => __( 'Add New Testimonial', 'wptestimonialslider' ),
		'new_item'           => __( 'New Testimonial', 'wptestimonialslider' ),
		'edit_item'          => __( 'Edit Testimonial', 'wptestimonialslider' ),
		'view_item'          => __( 'View Testimonial', 'wptestimonialslider' ),
		'all_items'          => __( 'All Testimonials', 'wptestimonialslider' ),
		'search_items'       => __( 'Search Testimonials', 'wptestimonialslider' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'wptestimonialslider' ),
		'not_found'          => __( 'No testimonials found.', 'wptestimonialslider' ),
		'not_found_in_trash' => __( 'No testimonials found in Trash.', 'wptestimonialslider' ),
	);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'wptestimonialslider' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-editor-quote',
			'supports'           => array( 'title', 'editor','thumbnail')
		);

		register_post_type( 'wptestimonialslider', $args );
}

add_action( 'init', 'wpt_Slider' );