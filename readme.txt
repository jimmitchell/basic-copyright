=== Basic Copyright ===

Plugin Name: Basic Copyright
Plugin URI: https://jimmitchell.org/basic-copyright-wp-plugin/
Description: A super-simple WordPress plugin to embed a dynamic copyright shortcode in your theme footer, beginning with your first post year to the current year.
Tags: copyright, dynamic copyright, shortcode
Author: Jim Mitchell
Author URI: https://jimmitchell.org
Donate link: https://ko-fi.com/jimmitchellmedia
Requires at least: 6.0
Tested up to: 6.7
Version: 1.1.0
Stable tag: 1.1.0
Requires PHP: 7.4
Text Domain: basic-copyright
Domain Path: /languages
License: GPL-2.0-or-later
Contributors: jimmitchell


Makes "[basic_copyright]" available as a shortcode for use in your WordPress site theme footer.



== Description ==

This plugin makes "[basic_copyright]" available as a shortcode for use in your site theme footer.



### Features ###

* No configuration necessary. Set it and forget it, even beyond multiple years.
* If all your content is published in the current year, a simple "© 2024 Blog Name" will be output.
* If your content spans multiple years, a range like "© 2008 - 2024 Blog Name" will be output.
* This plugin is dynamic and will update to the current year automatically. No need to update copyright references anymore.
* Optional shortcode attributes let you override the defaults when you need to (see the FAQ).
* The first post year is cached, so the shortcode adds no database query to normal page loads.



### Privacy ###

__User Data:__ This plugin does not collect any user data.

__Cookies:__ This plugin does not set or rely on any cookies whatsoever.

Basic Copyright is developed and maintained by [Jim Mitchell](https://social.lol/@jim).


### Support development ###

I develop and maintain this free plugin with love for the WordPress community. To show support, you can [make a donation](https://ko-fi.com/jimmitchellmedia/). 

Links, toots, boosts, tweets and likes also appreciated. Thank you! :)



== Installation ==

### How to install the plugin ###

1. Upload the plugin to your blog and activate. No settings need to be configured.

[More info on installing WP plugins](https://wordpress.org/support/article/managing-plugins/#installing-plugins)


### How to use the plugin ###

Basic Copyright makes a "[basic_copyright]" shortcode available for use in your theme files. For more information how to leverage WordPress shortcodes, refer to this [documentation](https://wordpress.org/documentation/article/shortcode-block/).


### Plugin Upgrades ###

Just click "Update" from the Plugins screen and let WordPress do it for you automatically.

For more information, visit the [Basic Copyright Homepage](https://jimmitchell.org/basic-copyright-wp-plugin/).


### Like this plugin? ###

If you like Basic Copyright, please take a moment to [give a 5-star rating](https://wordpress.org/support/plugin/basic-copyright/reviews/?rate=5#new-post). It helps to keep development and support going strong. Thank you!



== Frequently Asked Questions ==

= Can I customize the output? =

The shortcode supports optional attributes:

* `start_year` — override the first year instead of using your oldest published post, e.g. `[basic_copyright start_year="2005"]`
* `holder` — override the copyright holder name (defaults to your site title), e.g. `[basic_copyright holder="Acme Inc."]`
* `separator` — the character between the years in a range (defaults to an en dash), e.g. `[basic_copyright separator="-"]`

Developers can also modify the final output with the `basic_copyright` filter.

= What happens on a site with no published posts? =

The shortcode outputs just the current year, e.g. "© 2026 Blog Name".



== Upgrade Notice ==

Just click "Update" from the Plugins screen and let WordPress do it for you automatically.

For more information, visit the [Basic Copyright Plugin Homepage](https://jimmitchell.org/basic-copyright-wp-plugin/).



== Changelog ==

*Thank you to everyone who shares feedback for Basic Copyright!*

If you like Basic Copyright, please take a moment to [give a 5-star rating](https://wordpress.org/support/plugin/basic-copyright/reviews/?rate=5#new-post). It helps to keep development and support going strong. Thank you!

**Version 1.1.0 (07-15-2026)**

* Added optional shortcode attributes: `start_year`, `holder` and `separator`.
* Added a `basic_copyright` filter so developers can modify the output.
* The first post year is now cached in a transient, removing the database query from normal page loads. The cache clears automatically when posts are published or unpublished.
* The copyright output is now translatable.
* Added an uninstall routine to clean up the cached data.
* Raised minimum requirements to WordPress 6.0 and PHP 7.4.

**Version 1.0.4 (07-15-2026)**

* Fixed a PHP error when the shortcode is used on a site with no published posts. The current year is now shown as a fallback.
* Fixed the copyright year respecting the site's timezone setting instead of UTC around the new year.
* Output now uses literal © and – characters instead of HTML entities for more reliable escaping.
* Fixed typos in the plugin header.

**Version 1.0.2 (03-11-2024)**

* Initial release.
