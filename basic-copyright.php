<?php
/**
 * Plugin Name: Basic Copyright
 * Plugin URI: https://jimmitchell.org/basic-copyright-wp-plugin/
 * Description: A super-simple WordPress plugin for embedding a dynamic "[basic_copyright]" shortcode in your theme footer, beginning with your first post year to the current year.
 * Tags: copyright, dynamic copyright, shortcode
 * Author: Jim Mitchell
 * Author URI: https://jimmitchell.org
 * Donate link: https://ko-fi.com/jimmitchellmedia/
 * Requires at least: 6.0
 * Tested up to: 6.7
 * Version: 1.1.0
 * Requires PHP: 7.4
 * Text Domain: basic-copyright
 * Domain Path: /languages
 * License: GPL-2.0-or-later
 *
 * @package Basic_Copyright
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

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Look up the year of the oldest published post, cached in a transient.
 *
 * @return string Four-digit year of the oldest published post, or '0' if there are none.
 */
function jmitch_basic_copyright_first_year() {

	$first_post_year = get_transient( 'basic_copyright_first_year' );

	if ( false === $first_post_year ) {

		$first_post_query = get_posts(
			array(
				'numberposts' => 1,
				'post_status' => 'publish',
				'orderby'     => 'date',
				'order'       => 'ASC',
			)
		);

		// '0' marks "no published posts" so the empty result is cached too.
		$first_post_year = ! empty( $first_post_query ) ? get_the_date( 'Y', $first_post_query[0] ) : '0';

		set_transient( 'basic_copyright_first_year', $first_post_year, WEEK_IN_SECONDS );

	}

	return $first_post_year;
}

/**
 * Clear the cached first post year whenever a post is published or unpublished.
 *
 * @param string $new_status New post status.
 * @param string $old_status Old post status.
 */
function jmitch_basic_copyright_flush_cache( $new_status, $old_status ) {

	if ( 'publish' === $new_status || 'publish' === $old_status ) {
		delete_transient( 'basic_copyright_first_year' );
	}
}
add_action( 'transition_post_status', 'jmitch_basic_copyright_flush_cache', 10, 2 );

/**
 * Determine the year range and output the dynamic copyright as a shortcode.
 *
 * @param array $atts {
 *     Optional. Shortcode attributes.
 *
 *     @type string $start_year Override the first year instead of using the oldest post.
 *     @type string $holder     Copyright holder name. Default is the site title.
 *     @type string $separator  Character between the years in a range. Default en dash.
 * }
 * @return string The escaped copyright notice.
 */
function jmitch_basic_copyright( $atts = array() ) {

	$atts = shortcode_atts(
		array(
			'start_year' => '',
			'holder'     => get_bloginfo( 'name' ),
			'separator'  => '–',
		),
		$atts,
		'basic_copyright'
	);

	$current_year = wp_date( 'Y' );

	// An explicit start_year attribute skips the first post lookup entirely.
	$start_year = absint( $atts['start_year'] );
	if ( ! $start_year ) {
		$start_year = absint( jmitch_basic_copyright_first_year() );
	}

	if ( ! $start_year || $start_year >= (int) $current_year ) {
		$years = $current_year;
	} else {
		$years = sprintf( '%s %s %s', $start_year, $atts['separator'], $current_year );
	}

	/* translators: 1: copyright year or year range, 2: copyright holder name. */
	$basic_copyright = sprintf( __( '© %1$s %2$s', 'basic-copyright' ), $years, $atts['holder'] );

	return apply_filters( 'basic_copyright', esc_html( $basic_copyright ), $atts );
}
add_shortcode( 'basic_copyright', 'jmitch_basic_copyright' );


/**
 * Inject a donation link on the plugin overview page.
 *
 * @param string[] $links Plugin action links.
 * @return string[] Action links with the donate link appended.
 */
function jmitch_basic_copyright_settings_link( $links ) {

	$url     = esc_url( 'https://ko-fi.com/jimmitchellmedia/' );
	$links[] = '<a href="' . $url . '" target="_blank" rel="noopener">' . esc_html__( 'Donate', 'basic-copyright' ) . '</a>';

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'jmitch_basic_copyright_settings_link' );
