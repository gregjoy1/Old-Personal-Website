<?php

	class cBlog
	{

		private $_uri;
		private $_content;
		private $_page;

		public function __construct($uri)
		{
			$this->setURI($uri);

			$recordName = $uri[(count($uri) - 1)];
			$recordName = ($recordName == '' ? 'home' : $recordName);
			$this->setPage(0);

			if(count($this->getURI()) > 1)
			{
				if(strtolower($this->getURI()[1]) == 'page')
				{
					if(count($this->getURI()) == 3 && is_numeric($this->getURI()[2]))
					{
						$this->setPage($this->getURI()[2]);
					}
					else
					{
						header('location: /blog');
						exit;
					}
				}
				else
				{
					$this->setContent(new Content($recordName, true));
				}
			}
		}

		public function execute()
		{
			if(is_null($this->getContent()))
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

			foreach (ContentHelper::GetAllBlogPosts($this->getPage()) as $blogPost)
			{

				echo '<div class="blog-entry-container">';

					ViewHelper::DrawContentHeaderAndDate($blogPost, true);
					
					echo $blogPost->getContent();

				echo '</div>';

			}

			$this->_handleBlogListPaging();

			ViewHelper::DrawFoot(true);
		}

		private function _handleBlogListPaging()
		{

			$showNewer = false;
			$showOlder = false;

			$numberOfPosts = ContentHelper::GetNumberOfBlogPosts();

			if($numberOfPosts > 5)
			{
				// checks if there are more pages
				if(($numberOfPosts - ($this->getPage() * 5)) > 5)
				{
					$showOlder = true;
				}

				if($this->getPage() > 0)
				{
					$showNewer = true;
				}

				if($showNewer || $showOlder)
				{
					echo '<p class="small blog-list-paging">';

						if($showNewer)
						{
							$previousPageLocation = (
								($this->getPage() - 1) == 0 ? 
									'/blog' : 
									'/blog/page/'.($this->getPage() - 1)
							);

							echo '<a href="'.$previousPageLocation.'" class="hidden float-left">';
								echo '&larr; View Newer Posts';
							echo '</a>';
						}

						if($showOlder)
						{
							$nextPageLocation = '/blog/page/'.($this->getPage() + 1);

							echo '<a href="'.$nextPageLocation.'" class="hidden float-right">';
								echo 'View Older Posts &rarr;';
							echo '</a>';
						}
					
					echo '</p>'; 
				}

			}
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

		public function setPage($page)
		{
			$this->_page = $page;
		}

		public function getPage()
		{
			return $this->_page;
		}

	}

?>