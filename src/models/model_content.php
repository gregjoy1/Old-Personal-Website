<?php

	require_once dirname(dirname(__FILE__)).'/config/load_all.php';

	class Content
	{

		// Attributes
		private $_id;
		private $_recordName;
		private $_title;
		private $_zoneId;
		private $_datePublished;
		private $_content;
		private $_isBlog;

		// Constructor
		public function __construct($id = null, $loadByRecordName = false)
		{
			if(!is_null($id))
			{
				if($loadByRecordName)
				{
					$this->loadByRecordName($id);
				}
				else
				{
					$this->loadById($id);
				}
			}
		}

		/* 
		--------------------------------------------
		* Setters
		--------------------------------------------
		*/

		public function setId($id)
		{
			$this->_id = $id;
		}

		public function setRecordName($recordName)
		{
			$this->_recordName = $recordName;
		}

		public function setTitle($title)
		{
			$this->_title = $title;
		}

		public function setZoneId($zoneId)
		{
			$this->_zoneId = $zoneId;
		}

		public function setDatePublished($datePublished)
		{
			$this->_datePublished = $datePublished;
		}

		public function setContent($content)
		{
			$this->_content = $content;
		}

		public function setIsBlog($isBlog)
		{
			$this->_isBlog = $isBlog;
		}

		/* 
		--------------------------------------------
		* Getters
		--------------------------------------------
		*/

		public function getId()
		{
			return $this->_id;
		}

		public function getRecordName()
		{
			return $this->_recordName;
		}

		public function getTitle($useRecordNameFallback = false)
		{
			if($this->_title == '' && $useRecordNameFallback)
			{
				// strip out hypens and replace with spaces, upper case first charactor
				// test-page-name => Test page name
				return ucfirst(str_replace('-', ' ', strtolower($this->getRecordName())));
			}
			else
			{
				return $this->_title;
			}
		}

		public function getZoneId()
		{
			return $this->_zoneId;
		}

		public function getDatePublished()
		{
			return $this->_datePublished;
		}

		public function getContent()
		{
			return $this->_content;
		}

		public function getIsBlog()
		{
			return $this->_isBlog;
		}
		/* 
		--------------------------------------------
		* DB orientated methods
		--------------------------------------------
		*/

		public function loadById($id)
		{
			// Gets database connection.
			$connection = DBHelper::GetConnection();
			
			// Gets single result from database using newly created connection object to 
			// escape and execute the query.
			$recordArray = DBHelper::GetSingleResult(
				'SELECT * FROM Content WHERE id = ' . DBHelper::EscapeString($id, $connection),
				$connection
			);

			// Close the connection to free up resources.
			DBHelper::CloseConnection($connection);
			
			if(count($recordArray) > 0)
			{
				$this->_loadFromArray($recordArray);
			}

		}

		public function loadByRecordName($recordName)
		{
			// Gets database connection.
			$connection = DBHelper::GetConnection();
			
			// Gets single result from database using newly created connection object to 
			// escape and execute the query.
			$recordArray = DBHelper::GetSingleResult(
				'SELECT * FROM Content WHERE record_name = ' . DBHelper::QuoteEscapeString($recordName, $connection),
				$connection
			);

			// Close the connection to free up resources.
			DBHelper::CloseConnection($connection);
			
			if(count($recordArray) > 0)
			{
				$this->_loadFromArray($recordArray);
			}

		}

		private function _loadFromArray($recordArray)
		{
			
			$this->setId($recordArray['id']);
			
			$this->setRecordName($recordArray['record_name']);
			$this->setTitle($recordArray['title']);
			$this->setZoneId($recordArray['zone_id']);
			$this->setDatePublished($recordArray['date_published']);
			$this->setContent($recordArray['content']);
			$this->setIsBlog($recordArray['is_blog'] == '0');

		}

		public function save()
		{
			// Grabs database connection
			$connection = DBHelper::GetConnection();

			// Creating an array of all the fields to be used when inserting/updating the db
			$fields = array(
				'record_name = '.DBHelper::QuoteEscapeString($this->getRecordName(), $connection),
				'title = '.DBHelper::QuoteEscapeString($this->getTitle(), $connection),
				'zone_id = '.DBHelper::EscapeString($this->getZoneId(), $connection),
				'date_published = '.DBHelper::QuoteEscapeString($this->getDatePublished(), $connection),
				'content = '.DBHelper::QuoteEscapeString($this->getContent(), $connection),
				'is_blog = '.DBHelper::EscapeString($this->getIsBlog() ? 1 : 0, $connection)
			);

			if($this->getId() == '')
			{
				// Creating sql insert statement from generated assoc array $fields
				$sql = 'INSERT INTO Content SET '.implode(', ', $fields);

				// Exec sql insert statement
				if(!DBHelper::ExecuteQuery($sql, $connection))
				{
					// Log this issue for later and tell the user something went wrong...
					LogHelper::AddLog('Content insert query execution failed with sql:"'.$sql.'"');
					die('There was an error handling this action and it has been logged; please try again later.');
				}

				// Update id attr in model to last inserted id generated by mysql
				$this->setId($connection->insert_id);
			}
			else
			{
				// Creating sql update statement from generated assoc array $fields
				$sql = 'UPDATE Content 
							SET '.implode(', ', $fields).'
							WHERE id = '.DBHelper::EscapeString($this->getId(), $connection);

				// Exec sql update statement
				if(!DBHelper::ExecuteQuery($sql, $connection))
				{
					// Log this issue for later and tell the user something went wrong...
					LogHelper::AddLog('Content update query execution failed with sql:"'.$sql.'"');
					die('There was an error handling this action and it has been logged; please try again later.');
				}

			}

			// Close connection to db
			DBHelper::CloseConnection($connection);
		
		}

	}

?>