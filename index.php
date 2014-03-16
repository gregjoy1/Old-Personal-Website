<?php

	require_once dirname(__FILE__).'/src/config/load_all.php';

	$uri = (isset($_GET['do']) ? $_GET['do'] : '');

	Router::Route($uri)

?>