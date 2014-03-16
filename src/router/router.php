<?php

	class Router
	{

		public static function Route($requestArray)
		{
			if(!is_null($requestArray) && count($requestArray) > 0)
			{
				self::ProcessURIRequest(self::_ParseURI($requestArray));
			}
		}

		private static function _ParseURI($uri)
		{

			// return array of uri segments
			return (
				strstr($uri, '/') ? 
					explode('/', $uri) : 
					array($uri)
			);
		}

		public static function ProcessURIRequest($uriArray)
		{

			if(strtolower($uriArray[0]) == 'blog')
			{
				$controller = new cBlog($uriArray);
			}
			else if(strtolower($uriArray[0]) == 'contact')
			{
				$controller = new cContact($uriArray);
			}
			else
			{
				$controller = new cPage($uriArray);
			}

			$controller->execute();

		}

	}

?>