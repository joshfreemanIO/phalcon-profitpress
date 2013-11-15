SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `profitpress_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `profitpress_offer_templates` (
  `offer_template_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offer_template_type` varchar(32) NOT NULL,
  `offer_template_name` varchar(64) NOT NULL,
  `fields` text NOT NULL COMMENT 'Serialized Fields for Input',
  PRIMARY KEY (`offer_template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `profitpress_options` (
  `option_name` varchar(64) NOT NULL COMMENT 'Option Key',
  `option_value` text COMMENT 'Option Value',
  PRIMARY KEY (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Site Options';

CREATE TABLE IF NOT EXISTS `profitpress_permalinks` (
  `permalink` varchar(255) NOT NULL,
  `module_name` text NOT NULL,
  `controller_name` text NOT NULL,
  `action_name` text NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permalink`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profitpress_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `categories_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users` (`users_id`),
  KEY `fk_posts_categories` (`categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `profitpress_security_tokens` (
  `token_id` int(10) unsigned NOT NULL,
  `token_owner_id` int(10) unsigned DEFAULT NULL COMMENT 'Token Owner',
  `token_type` varchar(64) NOT NULL COMMENT 'Type of Token',
  `token_value` text NOT NULL COMMENT 'Value',
  `expires` datetime DEFAULT NULL COMMENT 'When Token Expires',
  PRIMARY KEY (`token_id`),
  KEY `token_owner_id_2` (`token_owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profitpress_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `password` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


ALTER TABLE `profitpress_posts`
  ADD CONSTRAINT `fk_posts_categories` FOREIGN KEY (`categories_id`) REFERENCES `profitpress_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`users_id`) REFERENCES `profitpress_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
