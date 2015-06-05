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


// Ad for PRO version

function wp_testimonial_pro_add_meta_box() {

		add_meta_box(
			'wp_testimonial_sectionid_pro',
			__( "WP Testimonial Slider - Upgrade to PRO" , 'wptestimonialslider' ),
			'wp_testimonial_meta_box_pro',
			'wptestimonialslider'
		);
}
add_action( 'add_meta_boxes', 'wp_testimonial_pro_add_meta_box' );

function wp_testimonial_meta_box_pro() {  ?>
	
	<p>
	<h3 style="padding-left:0">Available features at WP Testimonial Slider - PRO</h3>
    <ol class="">
		<li>9 different Transitions</li>
		<li>9 different Themes / Styles</li>
		<li>6 Different Author image styles</li>
		<li>Tons of shortcode parameters</li>
		<li>Category wise Testimonials</li>
		<li>Great Settings Panel</li>
		<li>Enable / Disable - Stop on Hover</li>
		<li>On / Off Navigation Arrow</li>
		<li>Control Sliding Speed</li>
		<li>On / Off Pagination</li>
		<li>Unlimited Colors & Font styling</li>
		<li>Google fonts</li>
		<li>Different Theming</li>
		<li>Author Image size control</li>
		<li>Works with any WordPress Theme.</li>
		<li>Build with HTML5 & CSS3.</li>
		<li>Responsive. Work on any device.</li>
		<li>Easy and user-friendly setup.</li>
		<li>Well documentation and support.</li>
    	<li>And many more.</li>
    </ol>
  </p>
  <p><!-- <a class="button button-primary button-large" href="http://www.gsamdani.me/product/gs-testimonial-slider" target="_blank">Upgrade to PRO</a> -->
	<h2>Upgrade to PRO</h2>
	<a href="https://www.jvzoo.com/b/0/165193/14"><img src="http://i.jvzoo.com/0/165193/14" alt="WP TESTIMONIAL SLIDER" border="0" /></a>
  </p>
<?php
}


// SIDEBAR Ad for PRO version

function wp_testimonial_pro_sidebar_add_meta_box() {

		add_meta_box(
			'wp_testimonial_sectionid_pro_sidebar',
			__( "Other Info" , 'wptestimonialslider' ),
			'wp_testimonial_meta_box_pro_sidebar',
			'wptestimonialslider',
			'side',
			'low'
		);
}
add_action( 'add_meta_boxes', 'wp_testimonial_pro_sidebar_add_meta_box' );

function wp_testimonial_meta_box_pro_sidebar() { ?>
	
	<a href="http://demo.wptestimonialslider.com/" target="_blank" style="text-decoration: none;width:97%;overflow:hidden;margin:5px;background: #ffffff;border: 1px solid #eeeeee;display: block;float: left;text-align: center;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px; outline: 0!important;" ><h3 style="margin: 0px;background: #eeeeee;-webkit-border-top-left-radius: 3px;-webkit-border-top-right-radius: 3px;-moz-border-radius-topleft: 3px;-moz-border-radius-topright: 5px;border-top-left-radius: 3px;border-top-right-radius: 3px;padding:5px;text-decoration: none;color:#333">WP Testimonial Slider - DEMO</h3><img style="max-width: 100%;height:auto; margin: 5px 0 2px;" src="<?php echo plugins_url('wptestimonialslider/img/wp_testimonial_slider.png'); ?>" /></a>

	<div style="clear:both"></div>
<?php
}