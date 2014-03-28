<?php

	global $SITE_CONFIG, $publickey, $privatekey;
	
	$SITE_CONFIG = array();

	$SITE_CONFIG['log_location'] = dirname(dirname(__FILE__)).'/log_file.log';
	$SITE_CONFIG['url_prefix'] = '';
	$SITE_CONFIG['email'] = 'greg@gregjoy.co.uk';
	$SITE_CONFIG['default_description'] = 'Greg Joy, Oxford full stack software developer\'s personal website.';

	$publickey = '6Leht_ASAAAAABqhHC7c0u0KVRPmhdGw1TbA1Fj6';
	$privatekey = '6Leht_ASAAAAAMtLZkjQW_ZUSeihGOALwq2SMpSm';

?>