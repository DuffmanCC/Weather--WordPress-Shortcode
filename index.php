<?php 
/*
Plugin Name: Weather
Plugin URI: http://carlosortiz.co.uk/
Description: Simple shortcode for show weather in a specific city
Author: Carlos Ortiz
Version: 1.0
Author URI: http://carlosortiz.co.uk/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_shortcode( 'weather', function($atts){
	$atts = shortcode_atts( array(
		'place' => 'London',
		), $atts
	);

	extract($atts);

	return get_weather($place);
});

function get_weather($place){
	$weather = curl("http://api.openweathermap.org/data/2.5/weather?q={$place}&mode=html&appid=bd82977b86bf27fb59a04b61b657fb6f");
	echo $weather;
}

function curl($url){
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($c, CURLOPT_TIMEOUT, 5);
	$res = curl_exec($c);
	return $res;
}