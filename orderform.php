<?php
/*
Plugin Name: Orderform
Plugin URI: http://kgnic.ru
Description: just orderform for kgnic. Just add [orderform] whereever you want to insert the orderform. Yor theme have to use the twitter bootstrap framework in order this plugin to work properly!
Version: 1.0
Author: Radiofisik
Author URI: http://radiofisik.ru
License: none
*/
add_action('init','registerordertag');

//register shortcode [orderform]
function registerordertag()
	{
		add_shortcode('orderform','shordeform');
	}
//ordefrom tag processing
function shordeform($args, $content)
	{
	$frm = ABSPATH . 'wp-content/plugins/orderform/form.php';
	include "$frm"; //show form
	return "";
	}

//load javascript
add_action('wp',loadjscss);
function loadjscss()
	{
	wp_register_script('jq2',plugins_url('/jquery-2.1.1.min.js',__FILE__));
	wp_register_script('js_script',plugins_url('/js_script.js',__FILE__), array('jq2'));
	wp_enqueue_script('jq2');
	wp_enqueue_script('js_script');
	
	wp_register_style('ordestyle',plugins_url('/style.css',__FILE__));
	wp_enqueue_style('ordestyle');
	}
?>