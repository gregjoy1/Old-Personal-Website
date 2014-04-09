<?php

	class ViewHelper
	{

		public static function DrawHead($title, $uri, $echo = false, $description = false)
		{
			global $SITE_CONFIG;

			$url_prefix = $SITE_CONFIG['url_prefix'];

			$navigationMarkUp = self::DrawNavigation($uri);

			$description = ($description ? $description : $SITE_CONFIG['default_description']);

			$title = $title . ' - gregjoy.co.uk';

			$markUp = <<<HTML

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
	<head>

		<!-- Basic Page Needs
	  ================================================== -->
		<meta charset="utf-8">
		<title>$title</title>
		<meta name="description" content="$description">
		<meta name="author" content="Greg Joy">

		<!-- Mobile Specific Metas
	  ================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- CSS
	  ================================================== -->

		<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800" rel="stylesheet" type="text/css">

		<link rel="stylesheet" href="/public/styles/normalize.css">
		<link rel="stylesheet" href="/public/styles/layout.css">

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>
	
	<body>

		<div id="main-container">

			<div id="header-container">

				<div id="header-text-container">

					<span>
						Greg Joy
					</span>
				
				</div>

				<div id="menu-icon-container">
					<img src="/public/images/menu-icon.png">
				</div>

				<div id="header-nav-container">
					$navigationMarkUp
				</div>

			</div>

			<div class="page-rule">
				&nbsp;
			</div>

			<div id="content-container">
												
HTML;

			if($echo)
			{
				echo $markUp;
			}

			return $markUp;

		}

		public static function DrawNavigation($uri, $echo = false)
		{

			$menuItems = array(
				'Contact' => 'contact',
				'Blog' => 'blog',
				'Projects' => 'projects',
				'About' => 'about'
			);
	
			$markUp = '<ul id="header-nav-list">';

			foreach ($menuItems as $title => $url)
			{

				$isSelected = (strtolower($url) == strtolower($uri[0]) ? ' pre-load-selected' : '');

				$markUp .= '<li class="header-nav-item'.$isSelected.'">';
					$markUp .= '<a href="/'.$url.'">';
						$markUp .= $title;
					$markUp .= '</a>';
				$markUp .= '</li>';
			}

			if($echo)
			{
				echo $markUp;
			}

			return $markUp;

		}

		public static function DrawFoot($echo = false)
		{

			ob_start();

			$markUp = <<<HTML


			</div>

			<div class="page-rule">
				&nbsp;
			</div>
			
			<div id="footer-container">

				<div id="footer-text-container">
				
					<span class="footer-text float-right">
						Built with <img src="/public/images/heart.png" alt="love" class="footer-heart"> by Greg Joy
					</span>
				
				</div>
			
			</div>

		</div>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/public/scripts/styles.js"></script>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-49516868-1']);
	  _gaq.push(['_setDomainName', 'gregjoy.co.uk']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

	</body>

</html>

HTML;

			if($echo)
			{
				echo $markUp;
			}

			return $markUp;

		}

		public static function Draw404PageNotFound($uri)
		{

				header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

				ViewHelper::DrawHead('404 Not Found', $uri, true);

					echo '<h1>';
						echo '404 Page Not Found.';
					echo '</h1>';

					echo '<p>';
						echo 'The page that you have requested could not be found.';
					echo '</p>';

				ViewHelper::DrawFoot(true);
	
				exit;
		}

		public static function DrawContentHeaderAndDate($content, $link = false)
		{

			echo ($link ? '<a href="/blog/'.$content->getRecordName().'" class="hidden">' : '');

				echo '<h2>';
					echo $content->getTitle();
				echo '</h2>';

			echo ($link ? '</a>' : '');

			echo '<span class="small">';
				echo date('jS F Y', strtotime($content->getDatePublished()));
			echo '</span>';
		}

	}

?>