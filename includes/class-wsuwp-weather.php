<?php

class WSUWP_Weather {
	/**
	 * @var WSUWP_Weather
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance. Initiate hooks when
	 * called the first time.
	 *
	 * @since 0.0.1
	 *
	 * @return \WSUWP_Weather
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSUWP_Weather();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks to include.
	 *
	 * @since 0.0.1
	*/
	public function setup_hooks() {

		add_shortcode('weather', 'weather_shortcode');
		add_action( 'wp_enqueue_scripts', array( $this, 'wsuf_weather_enqueue_scripts' ), 99 );

		function weather_shortcode(){
    		return '<h1>Hello world!</h1>';
		}

	}

	/* Enqueues JavaScript and CSS files
	*/
	function wsuf_weather_enqueue_scripts() {
		wp_enqueue_script( 'wsuf_weather', plugins_url( '/weather-js.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'wsuf_style', plugins_url( 'css/style.css', dirname( __FILE__ ) ), array( 'spine-theme' ), null );
	}
}
