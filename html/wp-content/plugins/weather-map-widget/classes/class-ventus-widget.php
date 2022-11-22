<?php
/**
 * The file containing the widget class.
 *
 * @package    Ventus
 * @subpackage Ventus/classes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The widget class.
 *
 * @package    Ventus
 * @subpackage Ventus/classes
 */
class Weather_Map_Widget extends WP_Widget {

	/**
	 * The class constructor.
	 */
	public function __construct() {
		parent::__construct(
			'weather-map',
			__( 'Ventus Weather Map', 'ventus' ),
			array(
				'classname'   => 'ventus weather-map-widget',
				'description' => __( 'A customisable windy.com weather map widget.', 'ventus' ),
			)
		);
	}

	/**
	 * Front-end widget display.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from the database.
	 */
	public function widget( $args, $instance ) {
		$title    = ( isset( $instance['title'] ) ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$width    = ( isset( $instance['width'] ) ) ? $instance['width'] : '';
		$height   = ( isset( $instance['height'] ) ) ? $instance['height'] : '';
		$radius   = ( isset( $instance['radius'] ) ) ? $instance['radius'] : '';
		$lat      = ( isset( $instance['lat'] ) ) ? $instance['lat'] : '';
		$lon      = ( isset( $instance['lon'] ) ) ? $instance['lon'] : '';
		$zoom     = ( isset( $instance['zoom'] ) ) ? $instance['zoom'] : '';
		$layer    = ( isset( $instance['layer'] ) ) ? $instance['layer'] : '';
		$scale    = ( isset( $instance['scale'] ) ) ? $instance['scale'] : '';
		$marker   = ( isset( $instance['marker'] ) ) ? $instance['marker'] : '';
		$pressure = ( isset( $instance['pressure'] ) ) ? $instance['pressure'] : '';
		$units    = ( isset( $instance['units'] ) ) ? $instance['units'] : '';
		$forecast = ( isset( $instance['forecast'] ) ) ? $instance['forecast'] : '';
		$time     = ( isset( $instance['time'] ) ) ? $instance['time'] : '';

		echo $args['before_widget'];

		if ( isset( $instance['title'] ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// Start the iframe.
		echo '<iframe style="box-sizing: border-box;';

		// Set the width.
		echo ( isset( $instance['width'] ) ) ? ' width: ' . esc_attr( $width ) . '; ' : '100%; ';

		// Set the height.
		echo ( isset( $instance['height'] ) ) ? ' height: ' . esc_attr( $height ) . '; ' : '350px; ';

		// Set the border radius.
		echo ( isset( $instance['radius'] ) ) ? ' border-radius: ' . esc_attr( $radius ) . '" ' : '0"';

		// The iframe source URL.
		echo 'src="https://embed.windy.com/embed2.html?';

		// Set the latitude.
		echo ( isset( $instance['lat'] ) ) ? 'lat=' . esc_attr( $lat ) : 'lat=53.199';

		// Set the longitude.
		echo ( isset( $instance['lon'] ) ) ? '&lon=' . esc_attr( $lon ) : '&lon=-7.603';

		// Zoom level.
		echo ( isset( $instance['zoom'] ) ) ? '&zoom=' . esc_attr( $zoom ) : '&zoom=5';

		// The weather layer (overlay).
		echo ( isset( $instance['layer'] ) ) ? '&overlay=' . esc_attr( $layer ) : '&overlay=wind';

		// Show or hide the marker.
		echo ( isset( $instance['marker'] ) ) ? '&marker=' . esc_attr( $marker ) : '';

		// Show or hide the pressure isolines.
		echo ( isset( $instance['pressure'] ) ) ? '&pressure=' . esc_attr( $pressure ) : '';

		// Detail latitude.
		echo ( isset( $instance['lat'] ) ) ? '&detailLat=' . esc_attr( $lat ) : '&detailLat=53.199';

		// Detail longitude.
		echo ( isset( $instance['lon'] ) ) ? '&detailLon=' . esc_attr( $lon ) : '&detailLon=-7.603';

		// The wind measurement units.
		echo ( isset( $instance['units'] ) ) ? '&metricWind=' . esc_attr( $units ) : '&metricWind=default';

		// The temperature scale.
		echo ( isset( $instance['scale'] ) ) ? '&metricTemp=°' . esc_attr( $scale ) : '&metricTemp=°C';

		// The spot forecast.
		echo ( isset( $instance['forecast'] ) ) ? '&detail=' . esc_attr( $forecast ) : '';
		
		// The spot forecast.
		echo ( isset( $instance['time'] ) ) ? '&calendar=' . esc_attr( $time ) : '&calendar=now';

		// Complete the iframe.
		echo '&product=ecmwf&level=surface&menu=&message=true&type=map&location=coordinates&radarRange=-1" frameborder="0"></iframe>';
		
		echo $args['after_widget'];
	}

	/**
	 * Widget form.
	 *
	 * @param array $instance Previously saved database values.
	 */
	public function form( $instance ) {
		$title    = ( isset( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'New title', 'ventus' );
		$width    = ( isset( $instance['width'] ) ) ? $instance['width'] : '100%';
		$height   = ( isset( $instance['height'] ) ) ? $instance['height'] : '350px';
		$radius   = ( isset( $instance['radius'] ) ) ? $instance['radius'] : '0';
		$lat      = ( isset( $instance['lat'] ) ) ? $instance['lat'] : '53.199';
		$lon      = ( isset( $instance['lon'] ) ) ? $instance['lon'] : '-7.603';
		$zoom     = ( isset( $instance['zoom'] ) ) ? $instance['zoom'] : '5';
		$layer    = ( isset( $instance['layer'] ) ) ? $instance['layer'] : 'wind';
		$marker   = ( isset( $instance['marker'] ) ) ? $instance['marker'] : '';
		$pressure = ( isset( $instance['pressure'] ) ) ? $instance['pressure'] : '';
		$scale    = ( isset( $instance['scale'] ) ) ? $instance['scale'] : 'C';
		$units    = ( isset( $instance['units'] ) ) ? $instance['units'] : 'default';
		$forecast = ( isset( $instance['forecast'] ) ) ? $instance['forecast'] : '';
		$time     = ( isset( $instance['time'] ) ) ? $instance['time'] : '';
		?>
		<div class="ventus-widget-admin">
			<div class="row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ventus' ); ?></label>
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
				<small><?php esc_html_e( 'Appears above the widget', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e( 'Width:', 'ventus' ); ?></label> 
					<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" value="<?php echo esc_attr( $width ); ?>">
				</div>
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Height:', 'ventus' ); ?></label> 
					<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" value="<?php echo esc_attr( $height ); ?>">
				</div>
				<small><?php esc_html_e( 'Accepts any valid CSS values for width and height', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'radius' ) ); ?>"><?php esc_html_e( 'Rounded Corners:', 'ventus' ); ?></label> 
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'radius' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'radius' ) ); ?>" value="<?php echo esc_attr( $radius ); ?>">
				<small><?php esc_html_e( 'Accepts any valid CSS values for border-radius', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'lat' ) ); ?>"><?php esc_html_e( 'Latitude:', 'ventus' ); ?></label> 
					<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'lat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lat' ) ); ?>" value="<?php echo esc_attr( $lat ); ?>">
				</div>
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'lon' ) ); ?>"><?php esc_html_e( 'Longitude:', 'ventus' ); ?></label> 
					<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'lon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lon' ) ); ?>" value="<?php echo esc_attr( $lon ); ?>">
				</div>
				<small><?php esc_html_e( 'Tip: get these from windy.com', 'ventus' ); ?>, e.g. <a href="https://windy.com" target="_blank">windy.com/?53.199,-7.603</a></small>
			</div>
			<div class="row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'layer' ) ); ?>"><?php esc_html_e( 'Layer Type:', 'ventus' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layer' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layer' ) ); ?>">
					<option value="clouds" <?php echo ( 'clouds' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Clouds', 'ventus' ); ?></option>	
					<option value="cosc" <?php echo ( 'cosc' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'CO Concentration', 'ventus' ); ?></option>
					<option value="radar" <?php echo ( 'radar' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Lightning', 'ventus' ); ?></option>
					<option value="rain" <?php echo ( 'rain' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Rain', 'ventus' ); ?></option>
					<option value="sst" <?php echo ( 'sst' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Sea Temperature', 'ventus' ); ?></option>
					<option value="snowcover" <?php echo ( 'snowcover' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Snow Cover', 'ventus' ); ?></option>
					<option value="temp" <?php echo ( 'temp' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Temperature', 'ventus' ); ?></option>
					<option value="waves" <?php echo ( 'waves' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Waves', 'ventus' ); ?></option>
					<option value="wind" <?php echo ( 'wind' === $layer ) ? 'selected' : ''; ?>><?php esc_html_e( 'Wind', 'ventus' ); ?></option>
				</select>
				<small><?php esc_html_e( 'Choose from different primary overlays/layers', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>"><?php esc_html_e( 'Zoom Level:', 'ventus' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'zoom' ) ); ?>">
					<option value="3" <?php echo ( '3' === $zoom ) ? 'selected' : ''; ?>>3</option>
					<option value="4" <?php echo ( '4' === $zoom ) ? 'selected' : ''; ?>>4</option>
					<option value="5" <?php echo ( '5' === $zoom ) ? 'selected' : ''; ?>>5</option>
					<option value="6" <?php echo ( '6' === $zoom ) ? 'selected' : ''; ?>>6</option>
					<option value="7" <?php echo ( '7' === $zoom ) ? 'selected' : ''; ?>>7</option>
					<option value="8" <?php echo ( '8' === $zoom ) ? 'selected' : ''; ?>>8</option>
					<option value="9" <?php echo ( '9' === $zoom ) ? 'selected' : ''; ?>>9</option>
					<option value="10" <?php echo ( '10' === $zoom ) ? 'selected' : ''; ?>>10</option>
					<option value="11" <?php echo ( '11' === $zoom ) ? 'selected' : ''; ?>>11</option>
				</select>
				<small><?php esc_html_e( 'The lower the number, the further out the zoom', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'pressure' ) ); ?>"><?php esc_html_e( 'Pressure Isolines:', 'ventus' ); ?></label>
					<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pressure' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pressure' ) ); ?>">
						<option value="true" <?php echo ( 'true' === $pressure ) ? 'selected' : ''; ?>><?php esc_html_e( 'Show', 'ventus' ); ?></option>
						<option value="" <?php echo ( '' === $pressure ) ? 'selected' : ''; ?>><?php esc_html_e( 'Hide', 'ventus' ); ?></option>
					</select>
				</div>
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'marker' ) ); ?>"><?php esc_html_e( 'Marker:', 'ventus' ); ?></label>
					<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'marker' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'marker' ) ); ?>">
						<option value="true" <?php echo ( 'true' === $marker ) ? 'selected' : ''; ?>><?php esc_html_e( 'Show', 'ventus' ); ?></option>
						<option value="" <?php echo ( '' === $marker ) ? 'selected' : ''; ?>><?php esc_html_e( 'Hide', 'ventus' ); ?></option>
					</select>
				</div>
				<small><?php esc_html_e( 'Show or hide the pressure isolines and marker', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'forecast' ) ); ?>"><?php esc_html_e( 'Spot Forecast:', 'ventus' ); ?></label>
					<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'forecast' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'forecast' ) ); ?>">
						<option value="true" <?php echo ( 'true' === $forecast ) ? 'selected' : ''; ?>><?php esc_html_e( 'Show', 'ventus' ); ?></option>
						<option value="" <?php echo ( '' === $forecast ) ? 'selected' : ''; ?>><?php esc_html_e( 'Hide', 'ventus' ); ?></option>
					</select>
				</div>
				<div class="half">
					<label for="<?php echo esc_attr( $this->get_field_id( 'time' ) ); ?>"><?php esc_html_e( 'Forecast From:', 'ventus' ); ?></label>
					<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'time' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'time' ) ); ?>">
						<option value="now" <?php echo ( 'now' === $time ) ? 'selected' : ''; ?>><?php esc_html_e( 'Now', 'ventus' ); ?></option>
						<option value="12" <?php echo ( '12' === $time ) ? 'selected' : ''; ?>><?php esc_html_e( '12h', 'ventus' ); ?></option>
						<option value="24" <?php echo ( '24' === $time ) ? 'selected' : ''; ?>><?php esc_html_e( '24h', 'ventus' ); ?></option>
					</select>
				</div>
				<small><?php esc_html_e( 'Options to display and set the time of the spot forecast', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'scale' ) ); ?>"><?php esc_html_e( 'Temperature Scale:', 'ventus' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'scale' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'scale' ) ); ?>">
					<option value="C" <?php echo ( 'C' === $scale ) ? 'selected' : ''; ?>><?php esc_html_e( 'Celsius', 'ventus' ); ?></option>
					<option value="F" <?php echo ( 'F' === $scale ) ? 'selected' : ''; ?>><?php esc_html_e( 'Fahrenheit', 'ventus' ); ?></option>
				</select>
				<small><?php esc_html_e( 'Choose your preferred temperature scale', 'ventus' ); ?></small>
			</div>
			<div class="row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'units' ) ); ?>"><?php esc_html_e( 'Wind Units:', 'ventus' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'units' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'units' ) ); ?>">
					<option value="default" <?php echo ( 'default' === $units ) ? 'selected' : ''; ?>><?php esc_html_e( 'Default', 'ventus' ); ?></option>
					<option value="bft" <?php echo ( 'bft' === $units ) ? 'selected' : ''; ?>><?php esc_html_e( 'Beaufort', 'ventus' ); ?></option>
					<option value="km/h" <?php echo ( 'km/h' === $units ) ? 'selected' : ''; ?>><?php esc_html_e( 'Kilometers per hour', 'ventus' ); ?></option>
					<option value="kt" <?php echo ( 'kt' === $units ) ? 'selected' : ''; ?>><?php esc_html_e( 'Knots', 'ventus' ); ?></option>
					<option value="m/s" <?php echo ( 'm/s' === $units ) ? 'selected' : ''; ?>><?php esc_html_e( 'Meters per second', 'ventus' ); ?></option>
					<option value="mph" <?php echo ( 'mph' === $units ) ? 'selected' : ''; ?>><?php esc_html_e( 'Miles per hour', 'ventus' ); ?></option>
				</select>
				<small><?php esc_html_e( 'Choose your preferred wind measurement units', 'ventus' ); ?></small>
			</div>
		</div>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values to save.
	 * @param array $old_instance Previously saved database values.
	 *
	 * @return array Updated safe values to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance['title']    = ( isset( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['width']    = ( isset( $new_instance['width'] ) ) ? sanitize_text_field( $new_instance['width'] ) : '';
		$instance['height']   = ( isset( $new_instance['height'] ) ) ? sanitize_text_field( $new_instance['height'] ) : '';
		$instance['border']   = ( isset( $new_instance['border'] ) ) ? sanitize_text_field( $new_instance['border'] ) : '';
		$instance['radius']   = ( isset( $new_instance['radius'] ) ) ? sanitize_text_field( $new_instance['radius'] ) : '';
		$instance['lat']      = ( isset( $new_instance['lat'] ) ) ? sanitize_text_field( $new_instance['lat'] ) : '';
		$instance['lon']      = ( isset( $new_instance['lon'] ) ) ? sanitize_text_field( $new_instance['lon'] ) : '';
		$instance['zoom']     = ( isset( $new_instance['zoom'] ) ) ? sanitize_text_field( $new_instance['zoom'] ) : '';
		$instance['layer']    = ( isset( $new_instance['layer'] ) ) ? sanitize_text_field( $new_instance['layer'] ) : '';
		$instance['scale']    = ( isset( $new_instance['scale'] ) ) ? sanitize_text_field( $new_instance['scale'] ) : '';
		$instance['marker']   = ( isset( $new_instance['marker'] ) ) ? sanitize_text_field( $new_instance['marker'] ) : '';
		$instance['pressure'] = ( isset( $new_instance['pressure'] ) ) ? sanitize_text_field( $new_instance['pressure'] ) : '';
		$instance['units']    = ( isset( $new_instance['units'] ) ) ? sanitize_text_field( $new_instance['units'] ) : '';
		$instance['forecast'] = ( isset( $new_instance['forecast'] ) ) ? sanitize_text_field( $new_instance['forecast'] ) : '';
		$instance['time']     = ( isset( $new_instance['time'] ) ) ? sanitize_text_field( $new_instance['time'] ) : '';

		return $instance;
	}
}
