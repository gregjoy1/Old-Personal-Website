<?php

	class DBHelper
	{

		public static function GetConnection()
		{

			global $DB_CONFIG;

			$dbConnection = new mysqli(
				$DB_CONFIG['db_host'],
				$DB_CONFIG['db_user'],
				$DB_CONFIG['db_password'],
				$DB_CONFIG['db_name']
			);
			
			if ($dbConnection->connect_errno)
			{
			    die('Failed to connect to Database: (' . $dbConnection->connect_errno . ') ' . $dbConnection->connect_error);
			}

			return $dbConnection;

		}

		public static function CloseConnection($connection)
		{
			$connection->close();
		}

		public static function EscapeString($string, $connection = null)
		{
			// if db connection isnt provided, create one
			$dbConnection = (is_null($connection) ? self::GetConnection() : $connection);

			$return = $dbConnection->real_escape_string($string);

			// if db connection wasnt provided, close newly created connection
			if(is_null($connection))
			{
				self::CloseConnection($dbConnection);
			}

			return $return;

		}

		public static function QuoteEscapeString($string, $connection = null)
		{
			// all connection checking takes place in EscapeString
			return '\''.self::EscapeString($string, $connection).'\'';
		}

		public static function ExecuteQuery($query, $connection = null)
		{
			// if db connection isnt provided, create one
			$dbConnection = (is_null($connection) ? self::GetConnection() : $connection);

			$result = $dbConnection->query($query);
			
			if(!$result)
			{
				die('error: '.$dbConnection->error);
			}

			// if db connection wasnt provided, close newly created connection
			if(is_null($connection))
			{
				self::CloseConnection($dbConnection);
			}

			return $result;
		}

		public static function GetListResult($query, $connection = null)
		{
			$result = self::ExecuteQuery($query, $connection);

			$outReturn = array();

			while($row = $result->fetch_assoc())
			{
				$outReturn[] = $row;
			}

			return $outReturn;
		}

		public static function GetSingleResult($query, $connection = null)
		{
			$result = self::ExecuteQuery($query, $connection);

			$result = ($result->num_rows > 0 ? $result->fetch_assoc() : array());

			return $result;
		}
	}

?>