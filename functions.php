<?php
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	require_once('config/data.php');
	require_once('inc/database_mysqli.php');
	require_once('inc/database_object.php');
	require_once('inc/trip.php');
	
	//load template part
	if(!function_exists('load_template')) {
		function load_template($template) {
			
			$result = false;
			$template = $template.'.php';
			
			if(file_exists($template)) {
				include_once($template);
				$result = true;
			}
			else {
				include_once('home.php');
			}
			
			return $result;
			
		}
	}

	
	if(!function_exists('base_url')) {
		function base_url() {
			if($_SERVER['HTTPS']) {
				$prefix = 'https';
			}
			else {
				$prefix = 'http';
			}
			return $prefix.'://'.BASE_URL;
		}
	}
	
?>