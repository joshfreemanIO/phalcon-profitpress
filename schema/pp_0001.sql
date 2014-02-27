-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2014 at 05:29 PM
-- Server version: 5.5.35-0ubuntu0.13.10.1-log
-- PHP Version: 5.5.7-1+sury.org~saucy+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pp_0001`
--

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_categories`
--

CREATE TABLE IF NOT EXISTS `profitpress_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Category ID (Primary Key)',
  `name` text NOT NULL COMMENT 'Category Name',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `profitpress_categories`
--

INSERT INTO `profitpress_categories` (`category_id`, `name`) VALUES
(6, 'test!'),
(9, 'Woo!');

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_comments`
--

CREATE TABLE IF NOT EXISTS `profitpress_comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Comment ID (Primary Key)',
  `post_id` int(10) unsigned DEFAULT NULL COMMENT 'Post ID (Foreign Key)',
  `content` text NOT NULL COMMENT 'Comment Content',
  `date_created` datetime DEFAULT NULL COMMENT 'Date Created',
  PRIMARY KEY (`comment_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Comments Table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_comments_hierarchy`
--

CREATE TABLE IF NOT EXISTS `profitpress_comments_hierarchy` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Comment ID (Primary Key)',
  `post_id` int(11) DEFAULT NULL COMMENT 'Post ID (Foreign Key)',
  `content` text NOT NULL COMMENT 'Comment Content',
  `ni_a` bigint(20) unsigned DEFAULT NULL COMMENT 'Nested Interval Matrix (A,c;b,d)',
  `ni_c` bigint(20) unsigned DEFAULT NULL COMMENT 'Nested Interval Matrix (a,C;b,d)',
  `ni_b` bigint(20) unsigned DEFAULT NULL COMMENT 'Nested Interval Matrix (a,c;B,d)',
  `ni_d` bigint(20) unsigned DEFAULT NULL COMMENT 'Nested Interval Matrix (a,c;b,D)',
  `ni_left_bound` double unsigned DEFAULT NULL COMMENT 'Calculated Nested Interval Left Bound',
  `ni_right_bound` double unsigned DEFAULT NULL COMMENT 'Calculated Nested Interval Right Bound',
  PRIMARY KEY (`comment_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Comments Table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_offers`
--

CREATE TABLE IF NOT EXISTS `profitpress_offers` (
  `offer_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Offer ID (Primary Key)',
  `offer_template_id` int(10) unsigned DEFAULT NULL COMMENT 'Offer Template ID (Foreign Key)',
  `offer_title` text COMMENT 'Offer Title',
  `offer_data` text COMMENT 'Serialized Data Fields',
  `offer_theme` text COMMENT 'Theme File',
  `date_created` datetime DEFAULT NULL COMMENT 'Date Offer was Creted',
  `date_modified` datetime DEFAULT NULL COMMENT 'Date Modified',
  `date_expires` datetime DEFAULT NULL COMMENT 'Date Offer Expires',
  PRIMARY KEY (`offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contains all Offers Available' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profitpress_offers`
--

INSERT INTO `profitpress_offers` (`offer_id`, `offer_template_id`, `offer_title`, `offer_data`, `offer_theme`, `date_created`, `date_modified`, `date_expires`) VALUES
(1, 6, NULL, 'a:4:{s:12:"warning_text";s:37:"This video might be gone in 30 years!";s:6:"header";s:69:"Learn how smart minds and statistical analysis aids data compression!";s:9:"main_text";s:139:"Text compression methods such as LZ can reduce file sizes by up to 80%. Professor Brailsford explains the nuts and bolts of how it is done.";s:9:"video_box";s:116:"<iframe width="640" height="480" src="//www.youtube.com/embed/goOa3DGezUA" frameborder="0" allowfullscreen></iframe>";}', 'bootstrap.min.css', '2013-11-08 17:40:52', '2013-11-08 17:40:52', '2013-11-20 00:00:00'),
(2, 9, NULL, 'a:5:{s:12:"warning_text";s:40:"This offer will expire soon, so act now!";s:6:"header";s:107:"Twitter IPO is Imminent: learn how to maximize you profits before Twitter''s holdings go the way of the Dodo";s:9:"main_text";s:407:"Vertical dot-com value utilize facilitate repurpose social back-end networking. Incentivize; scale content podcasting redefine infrastructures vertical one-to-one, intuitive generate enable aggregate e-enable interactive sexy. 24/365 models enhance communities rich-clientAPIs systems value open-source engage folksonomies, relationships monetize integrate content out-of-the-box exploit ROI markets models.";s:14:"secondary_text";s:854:"Channels integrateAJAX-enabled; bricks-and-clicks facilitate whiteboard web-readiness reinvent e-enable." Proactive synthesize out-of-the-box, folksonomies transparent harness aggregate envisioneer deliver technologies e-enable rich remix weblogs monetize mashups. Harness vortals impactful reinvent one-to-one, disintermediate dynamic aggregate long-tail monetize generate innovate embedded, best-of-breed orchestrate cross-platform vertical. Experiences unleash cultivate systems, utilize facilitate aggregate widgets iterate seize; design.  Implement extensible solutions syndicate grow grow leading-edge visionary leverage 24/7, web-enabled aggregate next-generation initiatives? Integrate bleeding-edge--ecologies, clicks-and-mortar e-services plug-and-play rich-clientAPIs dynamic robust initiatives implement architectures granular facilitate ROI.";s:5:"image";s:77:"http://www.callisthenes.com/wp-content/uploads/2013/06/DodoLarge-744x1024.jpg";}', 'bootstrap.min.css', '2013-11-08 17:50:43', '2013-11-08 17:50:43', '2013-11-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_offer_templates`
--

CREATE TABLE IF NOT EXISTS `profitpress_offer_templates` (
  `offer_template_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offer_template_type` varchar(32) NOT NULL,
  `offer_template_name` varchar(64) NOT NULL,
  `fields` text NOT NULL COMMENT 'Serialized Fields for Input',
  PRIMARY KEY (`offer_template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `profitpress_offer_templates`
--

INSERT INTO `profitpress_offer_templates` (`offer_template_id`, `offer_template_type`, `offer_template_name`, `fields`) VALUES
(6, 'video', 'Video-1', 'a:4:{i:0;s:12:"warning_text";i:1;s:6:"header";i:2;s:9:"main_text";i:3;s:9:"video_box";}'),
(8, 'picture', 'Image-1', 'a:4:{i:0;s:12:"warning_text";i:1;s:6:"header";i:2;s:9:"main_text";i:3;s:5:"image";}'),
(9, 'video', 'Picture-2', 'a:5:{i:0;s:12:"warning_text";i:1;s:6:"header";i:2;s:9:"main_text";i:3;s:14:"secondary_text";i:4;s:5:"image";}');

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_permalinks`
--

CREATE TABLE IF NOT EXISTS `profitpress_permalinks` (
  `permalink` varchar(255) NOT NULL,
  `module_name` text NOT NULL,
  `controller_name` text NOT NULL,
  `action_name` text NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permalink`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profitpress_permalinks`
--

INSERT INTO `profitpress_permalinks` (`permalink`, `module_name`, `controller_name`, `action_name`, `resource_id`) VALUES
('booyah', 'offers', 'offers', 'view', 36),
('ipsum-2', 'blog', 'posts', 'show', 14),
('lz-compression', 'offers', 'offers', 'view', 1),
('new-blog-post', 'blog', 'posts', 'show', 5),
('permalink-beta', 'offers', 'offers', 'view', 5),
('permalink-test', 'offers', 'offers', 'view', 6),
('text-compression-and-probabilities', 'offers', 'offers', 'view', 37),
('this-will-be-a-totally-rad-blog-post', 'blog', 'posts', 'show', 6),
('this-will-be-a-totally-rad-blog-post-v-2-0', 'blog', 'posts', 'show', 7),
('twitter-ipo-opportunity', 'offers', 'offers', 'view', 2),
('yeah!', 'offers', 'offers', 'view', 35),
('yeah-yeah', 'offers', 'offers', 'view', 34);

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_posts`
--

CREATE TABLE IF NOT EXISTS `profitpress_posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Post ID (Primary Key)',
  `title` text COMMENT 'Post Title',
  `markdown` text COMMENT 'User-generated markdown',
  `content` text COMMENT 'Post Content',
  `excerpt` text COMMENT 'Post Excerpt',
  `permalink` text COMMENT 'Permanent Link',
  `date_created` datetime NOT NULL COMMENT 'Date Created',
  `date_modified` datetime NOT NULL COMMENT 'Date Modified',
  `date_expires` datetime DEFAULT NULL COMMENT 'Date Expires',
  `date_published` datetime DEFAULT NULL COMMENT 'Date Published',
  `post_type` varchar(32) NOT NULL COMMENT 'Post Type',
  `template` text COMMENT 'Template (Corresponds to View)',
  `theme` text COMMENT 'Post Theme',
  `author_user_id` int(10) unsigned DEFAULT NULL COMMENT 'Post Author',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Are comments allowed for this post?',
  `authorize_comments` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Do comments require approval before publishing?',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `profitpress_posts`
--

INSERT INTO `profitpress_posts` (`post_id`, `title`, `markdown`, `content`, `excerpt`, `permalink`, `date_created`, `date_modified`, `date_expires`, `date_published`, `post_type`, `template`, `theme`, `author_user_id`, `allow_comments`, `authorize_comments`) VALUES
(1, 'Welcome to Your Site!', '', '<p>Turn-key share 24/365 out-of-the-box maximize integrated. Communities post, functionalities value sticky solutions experiences innovate infrastructures enhance maximize beta-test sticky functionalities clicks-and-mortar recontextualize; harness solutions citizen-media, streamline technologies. Viral web services deliverables virtual unleash holistic share, portals visionary, revolutionize experiences cross-media reinvent convergence tag web-enabled repurpose folksonomies. Productize whiteboard. Expedite ecologies beta-test web-readiness synergize ecologies virtual, mashups disintermediate beta-test niches paradigms strategic whiteboard. Seize vortals, methodologies architect next-generation redefine scale embrace transparent deploy infomediaries compelling.</p>\r\n<p>Channels reinvent transition web services exploit. Customized, "networks A-list disintermediate user-centred; create architectures authentic visionary compelling, user-centric strategize syndicate enable magnetic wireless; mission-critical," next-generation weblogs. E-services infrastructures; cultivate harness models markets leading-edge synthesize; robust, models, weblogs applications synergies markets impactful cultivate. Web-enabled monetize convergence granular; portals user-centred, user-centred viral ROI niches cutting-edge, transform facilitate, integrate streamline. Synergies impactful, target tag empower semantic synergize B2C efficient social visualize viral rss-capable user-contributed bricks-and-clicks user-centred out-of-the-box proactive. Seamless reinvent matrix front-end; supply-chains embrace envisioneer innovative front-end cross-platform sticky.</p>\r\n<p>Innovate virtual reinvent value-added create aggregate, bandwidth methodologies; synergize Cluetrain tagclouds incentivize grow, viral addelivery aggregate scale standards-compliant. Out-of-the-box, metrics frictionless 24/365 share web services synergies Cluetrain; incentivize granular streamline innovate peer-to-peer e-business mindshare.</p>', '', 'test-title', '2013-12-09 17:15:04', '2013-12-12 08:26:29', NULL, '2013-12-09 17:15:04', 'blog', '', NULL, NULL, 1, 0),
(2, 'What You Need to Know', '', '<p>Channels reinvent transition web services exploit. Customized, "networks A-list disintermediate user-centred; create architectures authentic visionary compelling, user-centric strategize syndicate enable magnetic wireless; mission-critical," next-generation weblogs. E-services infrastructures; cultivate harness models markets leading-edge synthesize; robust, models, weblogs applications synergies markets impactful cultivate. Web-enabled monetize convergence granular; portals user-centred, user-centred viral ROI niches cutting-edge, transform facilitate, integrate streamline. Synergies impactful, target tag empower semantic synergize B2C efficient social visualize viral rss-capable user-contributed bricks-and-clicks user-centred out-of-the-box proactive. Seamless reinvent matrix front-end; supply-chains embrace envisioneer innovative front-end cross-platform sticky.</p>\r\n<p>Innovate virtual reinvent value-added create aggregate, bandwidth methodologies; synergize Cluetrain tagclouds incentivize grow, viral addelivery aggregate scale standards-compliant. Out-of-the-box, metrics frictionless 24/365 share web services synergies Cluetrain; incentivize granular streamline innovate peer-to-peer e-business mindshare.</p>\r\n<p>Engage embedded magnetic; engage next-generation enhance best-of-breed, B2B enhance intuitive global. Weblogs interactive granular redefine bleeding-edge, harness authentic models facilitate initiatives interactive expedite sexy streamline revolutionary, synergies e-business distributed. Embrace aggregate; impactful blogging mission-critical proactive dot-com synergistic web services e-tailers architectures; maximize synergies web-enabled. World-class, front-end systems authentic, "repurpose architectures transparent bleeding-edge repurpose viral front-end partnerships incubate."</p>', '', 'what-you-need-to-know', '2013-12-09 17:21:30', '2013-12-12 08:27:23', NULL, '2013-12-09 17:15:04', 'blog', '', NULL, NULL, 1, 0),
(3, 'Example Post', '', '<p>Innovate virtual reinvent value-added create aggregate, bandwidth methodologies; synergize Cluetrain tagclouds incentivize grow, viral addelivery aggregate scale standards-compliant. Out-of-the-box, metrics frictionless 24/365 share web services synergies Cluetrain; incentivize granular streamline innovate peer-to-peer e-business mindshare.</p>\r\n<p>Engage embedded magnetic; engage next-generation enhance best-of-breed, B2B enhance intuitive global. Weblogs interactive granular redefine bleeding-edge, harness authentic models facilitate initiatives interactive expedite sexy streamline revolutionary, synergies e-business distributed. Embrace aggregate; impactful blogging mission-critical proactive dot-com synergistic web services e-tailers architectures; maximize synergies web-enabled. World-class, front-end systems authentic, "repurpose architectures transparent bleeding-edge repurpose viral front-end partnerships incubate." A-list granular rich optimize next-generation rich applications dot-com, social, benchmark paradigms granular beta-test. Best-of-breed, mashups, user-contributed B2B; sticky plug-and-play methodologies seize best-of-breed Cluetrain design remix leverage value ROI ubiquitous methodologies engage e-business deploy back-end, ubiquitous revolutionary." Beta-test enhance share interfaces evolve scalable cultivate harness, capture.</p>\r\n<p>Value systems drive real-time productize portals networks rich visionary open-source utilize niches interactive networkeffects redefine, "empower design viral?" Expedite empower drive, web-enabled share grow dot-com open-source redefine incentivize revolutionary architect communities next-generation. Users, e-tailers social blogging bricks-and-clicks action-items front-end A-list synergies, functionalities; turn-key innovative communities. Portals plug-and-play, "e-business streamline viral innovative utilize enhance." Repurpose enterprise intuitive, initiatives web-enabled: streamline generate world-class remix virtual back-end interactive.&nbsp;</p>', '', 'example-post', '2013-12-09 17:21:30', '2013-12-12 08:28:04', NULL, '2013-12-09 17:15:04', 'blog', '', NULL, NULL, 1, 0),
(4, 'Help Yourself Today', '', '<p>A-list granular rich optimize next-generation rich applications dot-com, social, benchmark paradigms granular beta-test. Best-of-breed, mashups, user-contributed B2B; sticky plug-and-play methodologies seize best-of-breed Cluetrain design remix leverage value ROI ubiquitous methodologies engage e-business deploy back-end, ubiquitous revolutionary." Beta-test enhance share interfaces evolve scalable cultivate harness, capture.</p>\r\n<p>Value systems drive real-time productize portals networks rich visionary open-source utilize niches interactive networkeffects redefine, "empower design viral?" Expedite empower drive, web-enabled share grow dot-com open-source redefine incentivize revolutionary architect communities next-generation. Users, e-tailers social blogging bricks-and-clicks action-items front-end A-list synergies, functionalities; turn-key innovative communities. Portals plug-and-play, "e-business streamline viral innovative utilize enhance." Repurpose enterprise intuitive, initiatives web-enabled: streamline generate world-class remix virtual back-end interactive. Leading-edge reinvent synergies, webservices, architectures visionary platforms reintermediate e-enable, "end-to-end create technologies; share harness, mashups."</p>', '', 'help-yourself-today', '2013-12-09 17:21:30', '2013-12-12 08:28:44', NULL, '2013-12-11 00:00:00', 'blog', '', NULL, NULL, 1, 0),
(5, 'Wild Fox', '', '<p>Still not sure what he should be saying right now...</p>\r\n<p><img src="../../files/9fOG9nl.jpg" alt="" width="300" height="188" /></p>', '', 'wild-fox', '2013-12-12 15:33:19', '2013-12-12 15:33:19', NULL, '2013-12-11 00:00:00', 'blog', '', NULL, NULL, 1, 0),
(6, 'Markdown Example', '', '## This is an h2 tag\r\nExcepteur sint occaecat cupidatat non proident [proident](http://alpha.com)\r\n\r\n```\r\nfunction add() {\r\n    var a = 4;\r\n    var b = 5;\r\n\r\n    return a + b;\r\n}\r\n```\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab\r\n\r\nore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n![image](http://a57.foxnews.com/www.foxnews.com/ucat/images/root/212/96/johnknock661_20131213_145750.jpg "Creepy people") \r\nWhy oh why', '', 'markdown-example', '2013-12-13 17:10:00', '2013-12-13 17:20:51', NULL, NULL, 'blog', '', NULL, NULL, 1, 0),
(7, 'Great New Blog Post', '', NULL, '', 'great-new-blog-post', '2014-01-15 12:44:07', '2014-01-15 12:44:07', NULL, NULL, 'blog', NULL, NULL, NULL, 1, 0),
(8, 'Blerg', '', NULL, '', 'blerg', '2014-01-15 12:48:49', '2014-01-15 12:48:49', NULL, NULL, 'blog', NULL, NULL, NULL, 1, 0),
(9, 'Woo Woo!', '## Heading 2 Woo!\r\n\r\n!["Dog Behind Car"](http://l3.yimg.com/nn/fp/rsz/011414/images/smush/pup_635x250_1389719729.jpg "Woof" )\r\n- Item 1\r\n- item 2\r\n- Item 3\r\n\r\n1. first\r\n2. second\r\n\r\n![Describe Your Image](/files/test/Screenshot_-_01142014_-_10:06:15_AM.png "Title Your Image")', '<h2 id="heading2woo">Heading 2 Woo!</h2>\r\n\r\n<p><img src="http://l3.yimg.com/nn/fp/rsz/011414/images/smush/pup_635x250_1389719729.jpg" alt="&quot;Dog Behind Car&quot;" title="Woof">\r\n- Item 1\r\n- item 2\r\n- Item 3</p>\r\n\r\n<ol>\r\n<li>first</li>\r\n<li>second</li>\r\n</ol>\r\n\r\n<p><img src="/files/test/Screenshot_-_01142014_-_10:06:15_AM.png" alt="Describe Your Image" title="Title Your Image"></p>', '', 'woo-woo', '2014-01-15 13:47:14', '2014-01-15 14:22:20', NULL, '2013-12-09 17:15:04', 'blog', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_posts_categories`
--

CREATE TABLE IF NOT EXISTS `profitpress_posts_categories` (
  `post_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Post Category Assignment Table';

--
-- Dumping data for table `profitpress_posts_categories`
--

INSERT INTO `profitpress_posts_categories` (`post_id`, `category_id`) VALUES
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_security_tokens`
--

CREATE TABLE IF NOT EXISTS `profitpress_security_tokens` (
  `token_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token_owner_id` int(10) unsigned DEFAULT NULL COMMENT 'Token Owner',
  `token_type` varchar(64) NOT NULL COMMENT 'Type of Token',
  `token_value` text NOT NULL COMMENT 'Value',
  `expires` datetime DEFAULT NULL COMMENT 'When Token Expires',
  PRIMARY KEY (`token_id`),
  KEY `token_owner_id_2` (`token_owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `profitpress_security_tokens`
--

INSERT INTO `profitpress_security_tokens` (`token_id`, `token_owner_id`, `token_type`, `token_value`, `expires`) VALUES
(51, 1, 'password', '$2a$12$UiUJ7N0k5pGK842xQgICLePZYR81NuA3BmMRdb2E3VPDhC0AeQSAK', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_settings`
--

CREATE TABLE IF NOT EXISTS `profitpress_settings` (
  `setting_name` varchar(64) NOT NULL COMMENT 'Setting Key',
  `setting_value` text COMMENT 'Setting Value',
  PRIMARY KEY (`setting_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Site Options';

--
-- Dumping data for table `profitpress_settings`
--

INSERT INTO `profitpress_settings` (`setting_name`, `setting_value`) VALUES
('global_css', 'cosmo.bootstrap.min.css'),
('settings_version', 'cd6248a9bd0349f45dc0d08953a304d0b24f1185');

-- --------------------------------------------------------

--
-- Table structure for table `profitpress_users`
--

CREATE TABLE IF NOT EXISTS `profitpress_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID (Primary Key)',
  `email_address` varchar(253) NOT NULL COMMENT 'Email Address',
  `first_name` blob COMMENT 'First Name (encrypted)',
  `last_name` blob COMMENT 'Last Name (encrypted)',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profitpress_users`
--

INSERT INTO `profitpress_users` (`user_id`, `email_address`, `first_name`, `last_name`) VALUES
(1, '', NULL, NULL),
(2, 'admin@admin.com', 0x71714432796641794d5441563537687a374b2b31757848554b41735172593635784a4d6b69337753644e387a6752764f5052496c71483864426a4c556a6243422f6c464572684271373872624169324e4a416d7848673d3d, 0x5473795734534c30366c6745747962536f6a305a4c6c4270654a4e586f32744c6b727937312f596f7332743142517759575861756e623769335759736873725546433150564c6341697972654d2f716e644c573361773d3d);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profitpress_posts_categories`
--
ALTER TABLE `profitpress_posts_categories`
  ADD CONSTRAINT `profitpress_posts_categories_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `profitpress_posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profitpress_posts_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `profitpress_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
