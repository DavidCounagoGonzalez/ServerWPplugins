<?php
/**
 * The file that defines the core plugin class.
 *
 * @package    Ventus
 * @subpackage Ventus/classes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The core plugin class.
 *
 * @package    Ventus
 * @subpackage Ventus/classes
 */
class Ventus {

	/**
	 * The class constructor.
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'setup_widget' ) );
		$this->setup_shortcode();
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_css' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Register the widget.
	 */
	public function setup_widget() {
		require plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-ventus-widget.php';
		register_widget( 'Weather_Map_Widget' );
	}

	/**
	 * Instantiate the shortcode class.
	 */
	public function setup_shortcode() {
		require plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-ventus-shortcode.php';
		new Ventus_Shortcode();
	}

	/**
	 * Load the admin stylesheet.
	 */
	public function admin_css() {
		wp_enqueue_style( 'ventus-admin-css', plugins_url( 'css/admin.css', dirname( __FILE__ ) ), array(), VENTUS_VERSION );
	}

	/**
	 * Load the required translation if available.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'ventus', FALSE, basename( dirname( dirname( __FILE__ ) ) ) . '/languages/' );
	}
}
