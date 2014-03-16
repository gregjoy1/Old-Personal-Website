<?php

	class cContact
	{

		private $_uri;

		public function __construct($uri)
		{
			$this->setURI($uri);
		}
		
		public function execute()
		{
			ViewHelper::DrawHead('Contact', $this->getURI(), true);

			echo '<h1>';
				echo 'Contact';
			echo '</h1>';

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


	}

?>