<?php
/**
 * The file containing the shortcode.
 *
 * @package    Ventus
 * @subpackage Ventus/classes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The shortcode class.
 *
 * @package    Ventus
 * @subpackage Ventus/classes
 */
class Ventus_Shortcode {

	/**
	 * The class constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'add_the_shortcode' ) );
	}

	/**
	 * Add the shortcode.
	 */
	public function add_the_shortcode() {
		add_shortcode( 'weather-map', array( $this, 'create_the_shortcode' ) ); // maintained for backward-compatibility
		add_shortcode( 'ventus', array( $this, 'create_the_shortcode' ) );
	}

	/**
	 * Create the shortcode.
	 *
	 * @param array $attributes The shortcode attributes.
	 */
	public function create_the_shortcode( $attributes ) {

		// Initialize the output.
		$output = '';

		// Initialize the attributes and their default values.
		$atts = shortcode_atts(
			array(
				'width'    => '100%',
				'height'   => '350px',
				'radius'   => '0',
				'lat'      => '53.199',
				'lon'      => '-7.603',
				'zoom'     => '5',
				'layer'    => 'wind',
				'scale'    => 'C',
				'units'    => 'default',
				'marker'   => '',
				'pressure' => '',
				'forecast' => '',
				'time'     => 'now'
			),
			$attributes
		);

		// Start the iframe.
		$output .= '<iframe ';

		// Style the iframe.
		$output .= 'style="width: ' . esc_attr( $atts['width'] ) . '; height: ' . esc_attr( $atts['height'] ) . '; border-radius: ' . esc_attr( $atts['radius'] ) . '" ';

		// The iframe source URL.
		$output .= 'src="https://embed.windy.com/embed2.html?';

		// Latitude and longitude.
		$output .= 'lat=' . esc_attr( $atts['lat'] ) . '&lon=' . esc_attr( $atts['lon'] );

		// Zoom level.
		$output .= '&zoom=' . esc_attr( $atts['zoom'] );

		// The weather layer (overlay).
		$output .= '&overlay=' . esc_attr( $atts['layer'] );

		// Show or hide the marker.
		$output .= '&marker=' . esc_attr( $atts['marker'] );

		// Show or hide pressure isolines.
		$output .= '&pressure=' . esc_attr( $atts['pressure'] );

		// Detail latitude and longitude.
		$output .= '&detailLat=' . esc_attr( $atts['lat'] ) . '&detailLon=' . esc_attr( $atts['lon'] );

		// The wind measurement units.
		$output .= '&metricWind=' . esc_attr( $atts['units'] );

		// The temperature scale.
		$output .= '&metricTemp=°' . esc_attr( strtoupper( $atts['scale'] ) );

		// The spot forecast.
		$output .= '&detail=' . esc_attr( $atts['forecast'] );

		// The forecast time.
		$output .= '&calendar=' . esc_attr( $atts['time'] );

		// Complete the iframe.
		$output .= '&product=ecmwf&level=surface&menu=&message=true&type=map&location=coordinates&radarRange=-1" frameborder="0"></iframe>';

		// Return the complete output.
		return $output;
	}

}
