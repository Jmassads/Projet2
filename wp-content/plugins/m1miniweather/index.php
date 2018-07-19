<?php
/*
Plugin Name: m1.MiniWeather
Plugin URI: http://maennchen1.de
This plugin easily displays a weather widget with a destination of your choice.
Author: maennchen1.de
Version: 0.3
Text Domain: m1mw
Author URI: http://maennchen1.de
*/

/**
 * get data from openweathermap
 */

load_plugin_textdomain('m1mw', false, basename( dirname( __FILE__ ) ) . '/languages' );

class Wx {
    public function getWeather($lat = false, $long = false, $api_key = false) {
	    $data = new stdClass();
    	if($lat && $long && $api_key) {
        	try {
            	$url = 'http://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$long.'&APPID='.$api_key;
            	$ch = curl_init();
                $timeout = 5;
	            curl_setopt($ch,CURLOPT_URL,$url);
    	        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        	    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            	$data = curl_exec($ch);
                $data = json_decode(utf8_encode($data));
	            $data->error = false;
	            if($data->cod != "200") {
    	            $data->error = __("Failed retrieving weather data.", 'm1mw');
        	    } else {
	                $main = $data->main;
	                $data->tempC = round(($main->temp -273.15), 0);
    	            $data->tempF = round(((($data->tempC * 9 ) / 5) + 32) ,0);
    	        }

            } catch(Exception $ex) {
	            $data->error = $ex->getMessage();
    	    }

        } else {
	        $data->error = __("API-key, latitude and longitude must be provided!", 'm1mw');
    	}
        return $data;
	}
}
		

	
/**
 * build widget to display icon and temperature
 * @author roger
 */
class m1_miniweather_widget extends WP_Widget
{
	
	var $id = "m1_miniweather_widget";
	
	function __construct()
	{
				 
    	parent::__construct('m1_miniweather_widget', 'm1.MiniWeather Widget', array(
    		"description" => __("m1.MiniWeather Widget, to display weather-icon and temperature", 'm1mw')
    	));
    	
  	} // function wpsg_login()
 
  	function widget($args, $settings)
  	{
  		//display Frontend  		 	  		
		if (get_option( 'm1_miniweather_renew_last' ) + $settings['m1mw_renewAfter'] * 60 < time())
		{
			//renew!
			$m1mw = new Wx();
			$m1mw_data = $m1mw->getWeather($settings['m1mw_lat'], $settings['m1mw_long'], $settings['m1mw_api_key']);
			if (!$m1mw_data->error) 
			{
				update_option( 'm1_miniweather_renew_last', time() );
				update_option( 'm1_miniweather_openweathermap', serialize($m1mw_data) );
			}
			
		} else
		{
			//cache
			$m1mw_data = unserialize ( get_option( 'm1_miniweather_openweathermap' ));
		}
		
		if ($settings['m1mw_value'] == 'C') {
			$m1mw_data->temp = $m1mw_data->tempC;
		}
		else {
			$m1mw_data->temp = $m1mw_data->tempF;
		}
		
		if ($settings['m1mw_fontColor']) $m1mw_fontColor = ' color: ' . $settings['m1mw_fontColor']; else $m1mw_fontColor = '';

		//
		//draw widget
		//
		echo $args['before_widget'];
			echo $args['before_title'];
				echo $settings['m1mw_widget_title'];
			echo $args['after_title'];
			if ($m1mw_data->error ===false) {
				echo '<div class="wi wi-owm-' . $m1mw_data->weather[0]->id .'" title="' . $m1mw_data->weather[0]->description . '" style="font-size: 2em;' . $m1mw_fontColor . '">
			       <span class="m1mw_temp">' . $m1mw_data->temp . '&deg;</span>
			     </div>';
			} else {
				echo $m1mw_data->error;
			}
		echo $args['after_widget'];
		
  	 	
  	} // function widget($args, $settings)
	
  	function form($instance) 
  	{ 
		//Backend
		if (isset($instance['m1mw_widget_title'])) { $m1mw_widget_title = $instance['m1mw_widget_title']; } else { $m1mw_widget_title = ''; }
		if (isset($instance['m1mw_api_key'])) { $m1mw_api_key = $instance['m1mw_api_key']; } else { $m1mw_api_key = ''; }
		if (isset($instance['m1mw_long'])) { $m1mw_long = $instance['m1mw_long']; } else { $m1mw_long = ''; }
		if (isset($instance['m1mw_lat'])) { $m1mw_lat = $instance['m1mw_lat']; } else { $m1mw_lat = ''; }
		if (isset($instance['m1mw_renewAfter'])) { $m1mw_renewAfter = $instance['m1mw_renewAfter']; } else { $m1mw_renewAfter = '30'; }
		if (isset($instance['m1mw_fontColor'])) { $m1mw_fontColor = $instance['m1mw_fontColor']; } else { $m1mw_fontColor = ''; }
		$m1mw_value =  array('C' => '', 'F' => '');
		if (isset($instance['m1mw_value'])) { $m1mw_value[$instance['m1mw_value']] = ' checked'; }

		
		
		echo __("widget title:", 'm1mw') .'<br /><input type="text" name="' . $this->get_field_name('m1mw_widget_title') .'" id="' . $this->get_field_name('m1mw_widget_title') . '" value="' . $m1mw_widget_title . '" /><br />';
		echo __("degrees in: ", 'm1mw') .'<br /><input type="radio" name="' . $this->get_field_name('m1mw_value') . '" id="' . $this->get_field_name('m1mw_value') . '" value="C" ' . $m1mw_value['C'] . ' />°C / 
		<input type="radio" name="' . $this->get_field_name('m1mw_value') . '" id="' . $this->get_field_name('m1mw_value') . '" value="F" ' . $m1mw_value['F'] . ' />°F
		<br />';
		echo __("font color (standard: emty):", 'm1mw') .'<br /><input type="text" name="' . $this->get_field_name('m1mw_fontColor') . '" id="' . $this->get_field_name('m1mw_fontColor') . '" style="width: 80px;" value="' . $m1mw_fontColor . '" /><br /><br />';
		echo __("API-key:", 'm1mw') .'<br /><input type="text" name="' . $this->get_field_name('m1mw_api_key') . '" id="' . $this->get_field_name('m1mw_api_key') . '" style="width: 300px;" value="' . $m1mw_api_key . '" /><br />';
		echo __("longitude / latitude:", 'm1mw') .'<br /><input type="text" name="' . $this->get_field_name('m1mw_long') . '" id="' . $this->get_field_name('m1mw_long') . '" style="width: 80px;" value="' . $m1mw_long . '" /> / 
		<input type="text" name="' . $this->get_field_name('m1mw_lat') . '" id="' . $this->get_field_name('m1mw_lat') . '" style="width: 80px;" value="' . $m1mw_lat . '" /><br />';
		echo __("interval:", 'm1mw') .'<br /><input type="text" name="' . $this->get_field_name('m1mw_renewAfter') . '" id="' . $this->get_field_name('m1mw_renewAfter') . '" style="width: 40px;" value="' . $m1mw_renewAfter . '" />min<br /><br />';
		echo __("last update: ", 'm1mw') . ' ' . date_i18n( get_option( 'date_format' ) . ', ' . get_option( 'time_format' ), get_option( 'm1_miniweather_renew_last' ) + (get_option('gmt_offset') * 3600));

		echo '
		<br />
		<br />
		<br />
		<ol>
			<li><a href="https://home.openweathermap.org/users/sign_up" target="_blank">' . __("get a Free OpenWeatherMap-Account (for API-use)", "m1mw") . '</a></li>
			<li>' . __("register an OpenWeatherMap app", "m1mw") . '</li>
			<li>' . __("search your location, longitude & langitude", "m1mw") . '</li>
		</ol>
		';
  		
  	} // function form($instance)
 	  
	function update($new_instance, $old_instance) 
	{ 
		//Admin save
		$instance = array();
		
		$instance['m1mw_widget_title'] = $new_instance['m1mw_widget_title'];
		$instance['m1mw_api_key'] = $new_instance['m1mw_api_key'];
		$instance['m1mw_long'] = $new_instance['m1mw_long'];
		$instance['m1mw_lat'] = $new_instance['m1mw_lat'];
		$instance['m1mw_renewAfter'] = $new_instance['m1mw_renewAfter'];
		$instance['m1mw_fontColor'] = $new_instance['m1mw_fontColor'];
		$instance['m1mw_value'] = $new_instance['m1mw_value'];
		
		return $instance; 
	
	} // function update($new_instance, $old_instance)

	public static function widget_init()
	{
		
		register_widget("m1_miniweather_widget");
			
	} // public function widget_init()	  	

	public static function wp_enqueue_style()
	{
		
		wp_enqueue_style( 'm1mw', plugins_url('css/weather-icons.min.css', __FILE__) );
			
	} // public function wp_enqueue_style()	  	

} // class m1_miniweather_widget extends WP_Widget

add_action('wp_enqueue_scripts', array('m1_miniweather_widget' , 'wp_enqueue_style'));
add_action('widgets_init', array('m1_miniweather_widget','widget_init'));

?>