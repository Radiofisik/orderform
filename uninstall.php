<?php
if(!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;
	//create orders table
	$tablename= $wpdb->prefix."orders";
		if($wpdb->get_var("show tables like '$tablename'")==$tablename)
		{
		$sql="DROP TABLE `$tablename`";
		$wpdb->query($sql);
		}
		//create items table
		$tablename= $wpdb->prefix."items";
		if($wpdb->get_var("show tables like '$tablename'")==$tablename)
		{
		$sql="DROP TABLE `$tablename`";
		$wpdb->query($sql);
		}
?>