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
				ViewHelper::Draw404PageNotFound($this->getURI());
			}

			ViewHelper::DrawHead($this->getContent()->getTitle(true), $this->getURI(), true);

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