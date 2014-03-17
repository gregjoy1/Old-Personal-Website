<?php

	require_once dirname(dirname(__FILE__)).'/config/load_all.php';

	class cPage
	{

		private $_uri;
		private $_content;

		public function __construct($uri)
		{
			$this->setURI($uri);

			$recordName = $uri[(count($uri) - 1)];
			$recordName = ($recordName == '' ? 'home' : $recordName);

			$this->setContent(new Content($recordName, true));
		}
		
		public function execute()
		{
			if($this->getContent()->getId() == '')
			{
				header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

				ViewHelper::DrawHead('Page', $this->getURI(), true);

					echo '<h2>';
						echo 'The page that you have requested could not be found.';
					echo '</h2>';

				ViewHelper::DrawFoot(true);
	
				exit;
			}

			ViewHelper::DrawHead('Page', $this->getURI(), true);

			echo $this->getContent()->getContent();

			ViewHelper::DrawFoot(true);
		}

		public function setURI($uri)
		{
			$this->_uri = $uri;
		}

		public function getURI()
		{
			return $this->_uri;
		}

		public function setContent($content)
		{
			$this->_content = $content;
		}

		public function getContent()
		{
			return $this->_content;
		}

	}

?>