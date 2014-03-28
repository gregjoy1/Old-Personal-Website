<?php

	require_once dirname(dirname(__FILE__)).'/config/load_all.php';

	class Comment
	{

		// Attributes
		private $_id;
		private $_contentId;
		private $_datePublished;
		private $_name;
		private $_EmailAddress;
		private $_content;
		private $_ipAddress;
		private $_showEmail;
		private $_zoneId;
		private $_isMessage;

		// Constructor
		public function __construct($id = null)
		{
			if(!is_null($id))
			{
				$this->loadById($id);
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

		public function setContentId($contentId)
		{
			$this->_contentId = $id;
		}

		public function setDatePublished($datePublished)
		{
			$this->_datePublished = $datePublished;
		}

		public function setName($name)
		{
			$this->_name = $name;
		}

		public function setEmailAddress($emailAddress)
		{
			$this->_emailAddress = $emailAddress;
		}

		public function setContent($content)
		{
			$this->_content = $content;
		}

		public function setIpAddress($ipAddress)
		{
			$this->_ipAddress = $ipAddress;
		}

		public function setShowEmail($showEmail)
		{
			$this->_showEmail = $showEmail;
		}

		public function setZoneId($zoneId)
		{
			$this->_zoneId = $zoneId;
		}

		public function setIsMessage($isMessage)
		{
			$this->_isMessage = $isMessage;
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

		public function getContentId()
		{
			return $this->_contentId;
		}

		public function getDatePublished()
		{
			return $this->_datePublished;
		}

		public function getName()
		{
			return $this->_name;
		}

		public function getEmailAddress()
		{
			return $this->_emailAddress;
		}

		public function getContent()
		{
			return $this->_content;
		}

		public function getIpAddress()
		{
			return $this->_ipAddress;
		}

		public function getShowEmail()
		{
			return $this->_showEmail;
		}

		public function getZoneId()
		{
			return $this->_zoneId;
		}

		public function getIsMessage()
		{
			return $this->_isMessage;
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
				'SELECT * FROM Comment WHERE id = ' . DBHelper::EscapeString($id, $connection),
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

			$this->setContentId($recordArray['content_id']);
			$this->setDatePublished($recordArray['date_published']);
			$this->setName($recordArray['name']);
			$this->setEmailAddress($recordArray['email_address']);
			$this->setContent($recordArray['content']);
			$this->setIpAddress($recordArray['ip_address']);
			$this->setShowEmail($recordArray['show_email']);
			$this->setZoneid($recordArray['zone_id']);
			$this->setIsMessage($recordArray['is_message']);

		}

		public function save()
		{
			// Grabs database connection
			$connection = DBHelper::GetConnection();

			// Creating an array of all the fields to be used when inserting/updating the db
			$fields = array(
				'date_published = '.DBHelper::QuoteEscapeString($this->getDatePublished(), $connection),
				'name = '.DBHelper::QuoteEscapeString($this->getName(), $connection),
				'email_address = '.DBHelper::QuoteEscapeString($this->getEmailAddress(), $connection),
				'content = '.DBHelper::QuoteEscapeString($this->getContent(), $connection),
				'ip_address = '.DBHelper::QuoteEscapeString($this->getIpAddress(), $connection),
				'show_email = '.DBHelper::EscapeString($this->getShowEmail() ? 1 : 0, $connection),
				'is_message = '.DBHelper::EscapeString($this->getIsMessage() ? 1 : 0, $connection)
			);

			if($this->getContentId() != '')
			{
				$fields[] = 'content_id = '.DBHelper::EscapeString($this->getContentId(), $connection);
			}

			if($this->getZoneId() != '')
			{
				$fields[] = 'zone_id = '.DBHelper::EscapeString($this->getZoneid(), $connection);
			}

			if($this->getId() == '')
			{
				// Creating sql insert statement from generated assoc array $fields
				$sql = 'INSERT INTO Comment SET '.implode(', ', $fields);

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
				$sql = 'UPDATE Comment 
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