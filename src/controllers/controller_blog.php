<?php

	class cBlog
	{

		private $_uri;
		private $_content;

		public function __construct($uri)
		{
			$this->setURI($uri);

			$recordName = $uri[(count($uri) - 1)];
			$recordName = ($recordName == '' ? 'home' : $recordName);

			if(count($this->getURI()) > 1)
			{
				$this->setContent(new Content($recordName, true));
			}
		}

		public function execute()
		{
			if(count($this->getURI()) == 1)
			{
				$this->executeBlogListing();
			}
			else
			{
				if($this->getContent()->getId() == '')
				{
					ViewHelper::Draw404PageNotFound($this->getURI());
				}
				$this->executeBlogDetail($this->getContent());
			}

		}

		public function executeBlogListing()
		{
			ViewHelper::DrawHead('Blog', $this->getURI(), true);

			echo '<h1 class="page-header">';
				echo 'Blog';
			echo '</h1>';

			foreach (ContentHelper::GetAllBlogPosts() as $blogPost)
			{

				echo '<div class="blog-entry-container">';

					ViewHelper::DrawContentHeaderAndDate($blogPost, true);
					
					echo $blogPost->getContent();

				echo '</div>';

			}

			ViewHelper::DrawFoot(true);
		}

		public function executeBlogDetail($content)
		{
			ViewHelper::DrawHead($this->getContent()->getTitle(true), $this->getURI(), true);

			ViewHelper::DrawContentHeaderAndDate($this->getContent());

			echo $this->getContent()->getContent();

			echo '<p class="small">';
				echo '<a href="/blog" class="hidden">';
					echo '&larr; Back to blog.';
				echo '</a>';
			echo '</p>';

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