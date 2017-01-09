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

		add_shortcode( 'weather', 'weather_shortcode' );
		add_action( 'wp_enqueue_scripts', array( $this, 'wsuf_weather_enqueue_scripts' ), 99 );

		function weather_shortcode(){
    		
			ob_start();
			?> 
				<div class="container-fluid">
					<div class="row photobox">
						<div class="col-md-4 content-box">
							<h1>What's it like outside?</h1>
							<p>Location: <span id="location"></span></p>
							<p>Latitude: <span id="lat"></span> || Longitude: <span id="lon"></span></p>
							<p>Current conditions: <span id="conditions"></span></p>
							<p>Temperature:</p>
							<div>
								<a id="k-button" class="btn btn-primary" data-toggle="collapse">Kelvin</a>&nbsp;&nbsp;<a id="c-button" class="btn btn-primary" data-toggle="collapse">Celcius</a>&nbsp;&nbsp;<a id="f-button" class="btn btn-primary" data-toggle="collapse">Fahrenheit</a>&nbsp;&nbsp;<span id="temperatureK"></span><span id="temperatureF"></span><span id="temperatureC"></span>
							</div>
							<p>&nbsp;</p>
							<p>Forecast: <span id="foreca"></span></p>
							<p class="small">Weather via <a href="http://openweathermap.org/" target="_blank">openweathermap.org</a> || Photos courtesy of <a href="https://unsplash.com/"	target="_blank">Unsplash</a></p>
						</div> 
						<div class="col-md-8">
						</div>
					</div>
				</div>
			<?php
			return ob_get_clean();
		}

	}

	
	/* Enqueues JavaScript and CSS files
	*/
	function wsuf_weather_enqueue_scripts() {
		wp_enqueue_script( 'wsuf_weather', plugins_url( '../js/weather-js.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'bootstrap_toggle', 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js', array( 'jquery' ), true);
		wp_enqueue_script( 'bootstrap_twitter', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', true );

		wp_enqueue_style( 'wsuf_style', plugins_url( 'css/style.css', dirname( __FILE__ ) ), array( 'spine-theme' ), null );
		wp_enqueue_style( 'bootstrap_min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap_tog2', 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css' );
	}
}





