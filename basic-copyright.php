<?php
/**
 * Plugin Name: Basic Copyright
 * Plugin URI: https://jimmitchell.org/basic-copyright-wp-plugin/
 * Description: A super-simple WordPress plugin for embedding a dynamic "[basic_copyright]" shortcode in your theme footer, beginning with your first post year to the current year.
 * Tags: copyright, dynamic copyright, shortcode
 * Author: Jim Mitchell
 * Author URI: https://jimmitchell.org
 * Dontate link: https://ko-fi.com/jimmitchellmedia/
 * Requires at least: 4.6
 * Test up to: 6.6.1
 * Version: 1.0.3
 * Requires PHP: 5.6.20
 * Text Domain: basic-copyright
 * Domain Path: /languages
 * License: GPL-2.0-or-later
 */
 
/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 
	2 of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	with this program. If not, visit: https://www.gnu.org/licenses/
	
	Copyright 2024 Jim Mitchell Media. All rights reserved.
*/

if ( ! defined( 'ABSPATH' ) ) die();

// *** Query for the first post, determine the current year, and output the dynamic copyright as a shortcode...
function jmitch_basic_copyright() {

	$first_post_query = get_posts( array(
		'numberposts' => 1,
		'post_status' => 'publish',
		'order' => 'ASC'
	) );

	$first_post = $first_post_query[0];
	$first_post_date = $first_post->post_date;

	$first_post_year = gmdate( 'Y', strtotime( $first_post_date ) );
	$current_year = gmdate( 'Y' );

	if ( $current_year === $first_post_year ) {
		$basic_copyright = sprintf( '&copy; %s %s', $current_year, get_bloginfo( 'name' ) );
	}
	else {
		$basic_copyright = sprintf( '&copy; %s &ndash; %s %s', $first_post_year, $current_year, get_bloginfo( 'name' ) );
	}

	return esc_html( $basic_copyright );

}
add_shortcode( 'basic_copyright', 'jmitch_basic_copyright' );


// *** Inject a donation link to the plugin overview page...
function jmitch_basic_copyright_settings_link( $links ) {

	$url = esc_url( 'https://ko-fi.com/jimmitchellmedia/' );
    $donate_link = '<a href="'. $url .'" target="_blank">' . esc_html__( 'Donate', 'jmitch-basic-copyright' ) . '</a>';
	
    array_push(
		$links,
		$donate_link
	);

	return $links;

}
add_filter( 'plugin_action_links_basic-copyright/basic-copyright.php', 'jmitch_basic_copyright_settings_link' );
