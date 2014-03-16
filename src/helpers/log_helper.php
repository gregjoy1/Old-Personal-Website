<?php

	class LogHelper
	{

		public static function AddLog($logEntry)
		{
			global $SITE_CONFIG;

			file_put_contents(
				$SITE_CONFIG['log_location'],
				date('Y-m-d H:i:s').'::'.$logEntry.PHP_EOL,
				FILE_APPEND
			);
		}

	}

?>