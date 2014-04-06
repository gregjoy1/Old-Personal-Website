-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2014 at 12:00 AM
-- Server version: 5.5.35-2
-- PHP Version: 5.5.10-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gregjoy`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `date_published` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(25) NOT NULL,
  `content` text NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `show_email` tinyint(1) NOT NULL DEFAULT '0',
  `zone_id` int(11) NOT NULL DEFAULT '1',
  `is_message` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Content`
--

CREATE TABLE IF NOT EXISTS `Content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `zone_id` int(1) NOT NULL DEFAULT '1',
  `date_published` datetime NOT NULL,
  `content` text NOT NULL,
  `is_blog` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `record_name_UNIQUE` (`record_name`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `Content`
--

INSERT INTO `Content` (`id`, `record_name`, `title`, `zone_id`, `date_published`, `content`, `is_blog`) VALUES
(2, 'home', '', 1, '2014-03-17 23:20:19', '<h1 class="home-page" style="margin-top: 30px;">\n    Greg Joy\n</h1>\n\n<h3 class="home-page" style="margin-top: 10px;">\n    Full Stack Enthusiast\n</h3>\n\n<h3 class="home-page">\n    Oxford Software Developer\n</h3>\n\n<div class="logo-link-container" style="margin-bottom: 50px; margin-top: 20px;">\n    \n    <a href="https://github.com/gregjoy1" target="_blank" class="link">\n        <img src="/public/images/github-logo.png" class="logo" style="margin-right: 10px; position: relative; top: 4px;">\n    </a>\n\n    <a href="https://twitter.com/GregJoy1" target="_blank" class="link">\n        <img src="/public/images/twitter-logo.png" class="logo" style="margin-right: 10px; position: relative; top: 1px;">\n    </a>\n\n    <a href="http://www.linkedin.com/pub/greg-joy/45/937/b57" target="_blank" class="link">\n        <img src="/public/images/linkedin-logo.png" class="logo" style="position: relative; top: 5px;">\n    </a>\n\n</div>', 0),
(15, 'projects', 'Projects', 1, '2014-04-06 22:22:14', '				<div class="page-header">\r\n\r\n					<h1>\r\n						Projects\r\n					</h1>\r\n\r\n					<span class="small">\r\n						Just some projects that I have been working on...\r\n					</span>\r\n\r\n				</div>\r\n\r\n				<div class="blog-entry-container">\r\n\r\n					<h2>\r\n						Pixel Painter\r\n					</h2>\r\n\r\n					<p>\r\n						Pixel Painter is an ongoing open source project that is still in its infancy. I embarked on this project as an excuse to have some fun with Angular and to fuel my pixel art passion. It is currently at pre-alpha stage, as it is nowhere near finished.\r\n					</p>\r\n\r\n					<p>\r\n						 As the project matures, I am intending on implementing a Node back end to provide the user with a facility to save and export the images; as well as additional tools and shape primitives.\r\n					</p>\r\n\r\n					<p>\r\n						 Check out the source code on my <a href="https://github.com/gregjoy1/pixel-painter" target="_BLANK">GitHub page</a> if you want to take a look, help, or criticize :)\r\n					</p>\r\n\r\n					<p>\r\n						 There is a live demo based on the current build is available <a href="/public/static-pages/pixelpainter/index.html" target="_BLANK">here.</a>\r\n					</p>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/pixel-painter-one.png" target="_BLANK">\r\n							<img src="/public/images/pixel-painter-one.png">\r\n						</a>\r\n					</div>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/pixel-painter-two.png" target="_BLANK">\r\n							<img src="/public/images/pixel-painter-two.png">\r\n						</a>\r\n					</div>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/pixel-painter-three.png" target="_BLANK">\r\n							<img src="/public/images/pixel-painter-three.png">\r\n						</a>\r\n					</div>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/pixel-painter-four.png" target="_BLANK">\r\n							<img src="/public/images/pixel-painter-four.png">\r\n						</a>\r\n					</div>\r\n\r\n				</div>\r\n\r\n				<div class="blog-entry-container">\r\n\r\n					<h2>\r\n						Forgetless\r\n					</h2>\r\n\r\n					<p>\r\n						Forgetless is a very basic personal knowledge management system, conceived from my desire to build my own tools and to forget less things. It allows you to create lists of items, which are associated to categories. The intended result is to have a collection of categorized notes for yourself.\r\n					</p>\r\n\r\n					<p>\r\n						It is a fully responsive single page web application built with Node, Express, and Angular with a focus of consistently providing the same quality of experience regardless of device used on. As this is my final year project for University, I am unable to publish the source code and a demo until June (university regulations).\r\n					</p>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/forgetless-one.png" target="_BLANK">\r\n							<img src="/public/images/forgetless-one.png">\r\n						</a>\r\n					</div>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/forgetless-two.png" target="_BLANK">\r\n							<img src="/public/images/forgetless-two.png">\r\n						</a>\r\n					</div>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/forgetless-three.png" target="_BLANK">\r\n							<img src="/public/images/forgetless-three.png">\r\n						</a>\r\n					</div>\r\n\r\n					<div class="image-container small float-left">\r\n						<a href="/public/images/forgetless-four.png" target="_BLANK">\r\n							<img src="/public/images/forgetless-four.png">\r\n						</a>\r\n					</div>\r\n\r\n				</div>', 0),
(16, 'fun-with-mps', 'Fun With MPS', 1, '2014-04-06 22:25:30', '<p>\r\n						<a href="https://github.com/np1/mps" target="_BLANK">MPS</a> is a free music streaming console application written in python which allows you to search for music and stream it entirely from the comfort of your command line. Being a massive fan of <a href="https://github.com/zcoder/mocp" target="_BLANK">MOCP (which is completely awesome, check it out)</a>, I am already likely to be an advocate of this similar feeling application. \r\n					</p>\r\n\r\n					<p>\r\n						Initially, I assumed that the application utilized YouTube to obtain the stream. I was wrong, it seems the author <a href="https://github.com/np1/mps-youtube" target="_BLANK">NP1 has already created a version of MPS that uses YouTube</a>. So where does the music actually come from? Looking at the source code, it appears that it obtains the stream from http://pleer.com/. Admittedly, the web site does little to make it feel legitimate and not at risk of inevitable legal action. The dependency MPS has on the website is draw back as I''m paranoid that it could be taken down at any moment.\r\n					</p>\r\n\r\n					<p>\r\n						Ethics aside, I think it makes a cool application that allows you to easily find and listen to music. I found it inspiring looking at it as a concept and how it works, and at the very least it has provided some stimulating food for though. \r\n					</p>\r\n', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
