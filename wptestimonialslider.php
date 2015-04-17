<?php
/**
 *
 * @package   WP Testimonial Slider
 * @author    WP Testimonial Slider <wptestimonialslider@gmail.com>
 * @license   GPL-2.0+
 * @link      http://wptestimonialslider.com
 * @copyright 2015 WP Testimonial Slider
 *
 * @wordpress-plugin
 * Plugin Name:			WP Testimonial Slider
 * Plugin URI:			http://wptestimonialslider.com/wpt-plugin
 * Description:       	Best Responsive Testimonials slider to display client's testimonials / recommendations. Display anywhere at your site using shortcode like [wpt_testimonial]
 * Version:           	1.0.0
 * Author:       		WP Testimonial Slider
 * Author URI:       	http://wptestimonialslider.com
 * Text Domain:       	wptestimonialslider
 * License:           	GPL-2.0+
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


//--------- CPT Testimonial ----------------------- 
require_once dirname( __FILE__ ) . '/wptestimonialslider-cpt.php';


//--------- CPT's MetaBox ------------------ 
require_once dirname( __FILE__ ) . '/wptestimonialslider-metabox.php';


//--------- CPT's Columns ------------------ 
require_once dirname( __FILE__ ) . '/wptestimonialslider-column.php';


//--------- CPT's Shortcode ---------------- 
require_once dirname( __FILE__ ) . '/wptestimonialslider-shortcode.php';


//--------- Enqueue Scripts & Style Files --
require_once dirname( __FILE__ ) . '/wptestimonialslider-script.php';


add_action('do_meta_boxes', 'wpt_change_image_box');
function wpt_change_image_box()
{
    remove_meta_box( 'postimagediv', 'wptestimonialslider', 'side' );
    add_meta_box('postimagediv', __('Testimonial Author Image'), 'post_thumbnail_meta_box', 'wptestimonialslider', 'side', 'low');
}

