<?php
/**
 * Uninstall handler for Basic Copyright.
 *
 * Removes the cached first post year when the plugin is deleted.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) die();

delete_transient( 'basic_copyright_first_year' );
