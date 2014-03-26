<?php

	class ContentHelper
	{

		public static function GetAllBlogPosts($page=0)
		{

			$connection = DBHelper::GetConnection();

			DBHelper::EscapeString($page, $connection);

			$lowerLimit = ($page * 5);

			$results = DBHelper::GetListResult(
				'SELECT id FROM Content WHERE zone_id = 1 AND is_blog = 1 ORDER BY date_published DESC LIMIT '.$lowerLimit.', 5',
				$connection
			);

			DBHelper::CloseConnection($connection);

			$blogPosts = array();

			foreach($results as $result)
			{
				$blogPosts[] = new Content($result['id']);
			}

			return $blogPosts;

		}

	}

?>