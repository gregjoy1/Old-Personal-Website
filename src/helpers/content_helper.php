<?php

	class ContentHelper
	{

		public static function GetAllBlogPosts($page=0)
		{

			$connection = DBHelper::GetConnection();

			$page = DBHelper::EscapeString($page, $connection);

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

		public static function GetNumberOfBlogPosts()
		{

			$connection = DBHelper::GetConnection();

			$results = DBHelper::GetSingleResult(
				'SELECT count(id) AS count FROM Content WHERE zone_id = 1 AND is_blog = 1',
				$connection
			);

			DBHelper::CloseConnection($connection);

			return $results['count'];

		}

	}

?>