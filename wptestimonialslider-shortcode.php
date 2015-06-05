<?php 

function wpt_slider_trigger(){
?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery( ".cycle-slideshow, .cycle-nav" ).on( "mouseenter", function() {
		jQuery(".cycle-nav").css("display", "block");
	}).on( "mouseleave", function() {
		jQuery(".cycle-nav").css("display", "none");
	});
});
</script>

<?php
}
add_action('wp_footer','wpt_slider_trigger');


add_shortcode( 'wpt_testimonial', 'wpt_shortcode' );

function wpt_shortcode() {

	$loop = new WP_Query(
		array(
			'post_type'	=> 'wptestimonialslider',
			'order_by'	=> 'title',
			'title'		=> 'yes'
			)
		);

	$output = '<div class="gs_testimonial_container">';
		if ( $loop->have_posts() ) {

			$output .= '<div class="cycle-slideshow composite-example" 
						data-cycle-fx="carousel"
						data-cycle-carousel-fluid="true"
						data-cycle-center-horz="true"
    					data-cycle-center-vert="true"
						data-cycle-carousel-visible="1"
						data-cycle-slides="> div"
						data-cycle-next="#next"
						data-cycle-prev="#prev"
						data-cycle-pager="#custom-pager"
						data-cycle-pager-template="<a>{{slideNum}}</a>"
						data-cycle-timeout="3000">';

			while ( $loop->have_posts() ) {
				$loop->the_post();
				$meta = get_post_meta( get_the_id() );

				$wpt_id = get_post_thumbnail_id();
				$gs_testimonial_url = wp_get_attachment_image_src($wpt_id, array(86,86),true);

				$gs_testimonial = $gs_testimonial_url[0];
				$gs_testimonial_alt = get_post_meta($wpt_id,'_wp_attachment_image_alt',true);

				$output .= '<div class="gs_testimonial_single">';
				$output .= '<div class="testimonial-box">';
				$output .= '<div class="box-content"><p>'. get_the_content() .'</p></div>';
				$output .= '<h3 class="box-title">'. get_the_title() .'</h3>';
				$output .= '<div class="box-image"><img src="'. $gs_testimonial .'" alt="'. $gs_testimonial_alt .'"></div>';

				if($meta['gs_t_client_company'][0]){

					$output .= '<div class="box-companyname"><span>Company Name:</span> '. $meta['gs_t_client_company'][0] .'</div>';

				}

				if($meta['gs_t_client_design'][0]){

					$output .= '<div class="box-designation"><span>Designation:</span> '. $meta['gs_t_client_design'][0] .'</div>';
				}

				$output .= '</div></div>';
			}

			$output .= '</div>';
			$output .= '<div class="center cycle-nav"><a id="prev">Prev</a><a id="next">Next</a></div>';
			$output .= '<div class="cycle-pager" id="custom-pager"></div>';

		} else {
			$output .= "No Testimonial Added!";
		}

		wp_reset_postdata();
		wp_reset_query();

	$output .= '</div>';
	return $output;
}



