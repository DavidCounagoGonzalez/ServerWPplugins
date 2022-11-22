<?php
/**
 * The main plugin file.
 *
 * @package           Ventus
 * Plugin Name:       Ventus - Weather Map Widget & Shortcode
 * Description:       Easily customise and embed the windy.com widget as a native WordPress widget or shortcode.
 * Version:           1.3.0
 * Author:            David Matthew
 * Author URI:        https://davidmatthew.ie
 * License:           GPL-3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       ventus
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Current plugin version, manually defined for performance reasons.
define( 'VENTUS_VERSION', '1.3.0' );

// Load the core plugin class and create a plugin instance.
require plugin_dir_path( __FILE__ ) . 'classes/class-ventus.php';
new Ventus();
