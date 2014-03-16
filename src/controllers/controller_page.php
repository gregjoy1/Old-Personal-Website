<?php

	class cPage
	{

		private $_uri;

		public function __construct($uri)
		{
			$this->setURI($uri);
		}
		
		public function execute()
		{
			ViewHelper::DrawHead('Page', $this->getURI(), true);

			echo '<h1>';
				echo 'Page';
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