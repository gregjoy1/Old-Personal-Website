<?php

	define('ROOT_DIR', dirname(dirname(__FILE__)));

	/*
	--------------------------------------------
	* Config loaders
	--------------------------------------------
	*/
	
	require_once ROOT_DIR.'/config/config.php';
	require_once ROOT_DIR.'/config/db_config.php';

	/*
	--------------------------------------------
	* Model loaders
	--------------------------------------------
	*/

	/*
	--------------------------------------------
	* Controller loaders
	--------------------------------------------
	*/

	require_once ROOT_DIR.'/controllers/controller_blog.php';
	require_once ROOT_DIR.'/controllers/controller_page.php';
	require_once ROOT_DIR.'/controllers/controller_contact.php';

	/*
	--------------------------------------------
	* Router loader
	--------------------------------------------
	*/

	require_once ROOT_DIR.'/router/router.php';

	/*
	--------------------------------------------
	* View loaders
	--------------------------------------------
	*/

	/*
	--------------------------------------------
	* Helper loaders
	--------------------------------------------
	*/
	require_once ROOT_DIR.'/helpers/db_helper.php';
	require_once ROOT_DIR.'/helpers/log_helper.php';
	require_once ROOT_DIR.'/helpers/view_helper.php';

?>