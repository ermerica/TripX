<?php	
	
	//PROGRAM CONSTANTS
	
	
	if(!defined('BASE_URL')) {
		define('BASE_URL', $_SERVER['SERVER_NAME']);
	}
	
	if(!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}
	
	if(!defined('BASE_MEAL')) {
		define('BASE_MEAL', 7.00);
	}
	
	if(!defined('BASE_HOTEL')) {
		define('BASE_HOTEL', 60.00);
	}
	
	if(!defined('AVERAGE_SPEED')) {
		define('AVERAGE_SPEED', 70);
	}
	
	if(!defined('GALLON_GAS')) {
		define('GALLON_GAS', 2.20);
	}
	
	if(!defined('TOLL_PER_MILE')) {
		define('TOLL_PER_MILE', .02);
	}
	
	if(!defined('COST_RANGE_MODIFIER')) {
		define('COST_RANGE_MODIFIER', .2);
	}

?>