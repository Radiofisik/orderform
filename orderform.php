<?php
/*
Plugin Name: Orderform
Plugin URI: http://kgnic.ru
Description: just orderform for kgnic. Just add [orderform] whereever you want to insert the orderform. Yor theme has to use the twitter bootstrap framework in order this plugin to work properly!
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
	//wp_register_script('jq2',plugins_url('/jquery-2.1.1.min.js',__FILE__));
	wp_register_script('js_script',plugins_url('/js_script.js',__FILE__), array('jquery'));
	wp_enqueue_script('jquery');
	wp_enqueue_script('js_script');
	
	wp_register_style('ordestyle',plugins_url('/style.css',__FILE__));
	wp_enqueue_style('ordestyle');
	}
//installation activation etc
register_activation_hook(__FILE__,activatepl);
function activatepl()
	{
	global $wpdb;
	//create orders table
	$tablename= $wpdb->prefix."orders";
		if($wpdb->get_var("show tables like '$tablename'")!=$tablename)
		{
					$sql="CREATE TABLE IF NOT EXISTS `$tablename` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `fio` varchar(50) COLLATE utf8_bin NOT NULL,
			  `organization` varchar(512) COLLATE utf8_bin NOT NULL,
			  `bik` varchar(9) COLLATE utf8_bin NOT NULL,
			  `inn` varchar(12) COLLATE utf8_bin NOT NULL,
			  `account` varchar(20) COLLATE utf8_bin NOT NULL,
			  `comment` varchar(2048) COLLATE utf8_bin NOT NULL,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=56";
		require_once(ABSPATH.'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		}
		//create items table
		$tablename= $wpdb->prefix."items";
		if($wpdb->get_var("show tables like '$tablename'")!=$tablename)
		{
								$sql="CREATE TABLE IF NOT EXISTS `$tablename` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `order_id` int(11) NOT NULL,
			  `name` varchar(2048) COLLATE utf8_bin NOT NULL,
			  `quantity` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8";
		require_once(ABSPATH.'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		}
	}
register_deactivation_hook(__FILE__,deactivatepl);
function deactivatepl()
	{
	}

	
?>