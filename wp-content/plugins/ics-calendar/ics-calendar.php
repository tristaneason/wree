<?php
/*
Plugin Name: ICS Calendar
Plugin URI:
Description: Embed a live updating iCal (ICS) feed in any page using a shortcode.
Version: 7.7.1.2
Author: Room 34 Creative Services, LLC
Author URI: https://room34.com
License: GPL2
Text Domain: r34ics
Domain Path: /i18n/languages/
*/


// Don't load directly
if (!defined('ABSPATH')) { exit; }


// Load required files
require_once(plugin_dir_path(__FILE__) . 'class-r34ics.php');
require_once(plugin_dir_path(__FILE__) . 'functions.php');


// Backward compatibility for WP < 5.3
if (!function_exists('wp_date')) {
	require_once(plugin_dir_path(__FILE__) . 'compatibility.php');
}


// Initialize plugin
add_action('plugins_loaded', function() {
	global $R34ICS;
	$R34ICS = new R34ICS();
});


// Load text domain for translations
add_action('plugins_loaded', function() {
	load_plugin_textdomain('r34ics', false, basename(plugin_dir_path(__FILE__)) . '/i18n/languages/');
});


// Flush rewrite rules when plugin is activated
register_activation_hook(__FILE__, function() { flush_rewrite_rules(); });


// Install/upgrade
register_activation_hook(__FILE__, 'r34ics_install');
add_action('plugins_loaded', function() {
	global $R34ICS;
	if (isset($R34ICS) && get_option('r34ics_version') != @$R34ICS->version) {
		r34ics_install();
	}
}, 11);


// Purge transients on certain option updates
add_action('update_option_timezone_string', function() { r34ics_purge_calendar_transients(); });


// Plugin installation
// See: https://codex.wordpress.org/Creating_Tables_with_Plugins
function r34ics_install() {
	global $R34ICS;
	if (isset($R34ICS)) {
		// Update version
		update_option('r34ics_version', @$R34ICS->version);
		// v. 7.5.0 added ability to purge the plugin's transients
		r34ics_purge_calendar_transients();
		// v. 6.11.1 Renamed option from 'r34ics_transient_expiration' to 'r34ics_transient_expiration' so it's not a transient itself
		if (!get_option('r34ics_transients_expiration')) {
			$transients_expiration = get_option('r34ics_transient_expiration') ? get_option('r34ics_transient_expiration') : 3600;
			update_option('r34ics_transients_expiration', $transients_expiration);
			delete_option('r34ics_transient_expiration');
		}
	}
}
