<?php 

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function wpt_add_meta_box() {

		add_meta_box(
			'wptestimonialslider_sectionid',
			__( "Testimonial Author Details" , 'wptestimonialslider' ),
			'wptestimonialslider_meta_box_callback',
			'wptestimonialslider'
		);
}
add_action( 'add_meta_boxes', 'wpt_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function wptestimonialslider_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'wptestimonialslider_meta_box', 'wptestimonialslider_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */

	?>

	<p><label for="gs_t_client_company"><b><?php _e('Company Name', 'wptestimonialslider'); ?></b></label></p>
	<p><input class="large-text" type="text" name="gs_t_client_company" id="gs_t_client_company" value="<?php echo get_post_meta($post->ID, 'gs_t_client_company', true); ?>" /></p>

	<p><label for="gs_t_client_design"><b><?php _e('Designation:', 'wptestimonialslider'); ?></b></label></p>
	<p><input class="large-text" type="text" name="gs_t_client_design" id="gs_t_client_design" value="<?php echo get_post_meta($post->ID, 'gs_t_client_design', true); ?>" /></p>

	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function wptestimonialslider_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['wptestimonialslider_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['wptestimonialslider_meta_box_nonce'], 'wptestimonialslider_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Testimonial author Name
	if( isset( $_POST['gs_t_client_company'] ) )
		update_post_meta( $post_id, 'gs_t_client_company', $_POST['gs_t_client_company'] );

	// Testimonial author Designation
	if( isset( $_POST['gs_t_client_design'] ) )
		update_post_meta( $post_id, 'gs_t_client_design', $_POST['gs_t_client_design'] );

}
add_action( 'save_post', 'wptestimonialslider_save_meta_box_data' );


