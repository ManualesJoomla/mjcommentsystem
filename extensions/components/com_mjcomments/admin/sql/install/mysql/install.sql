CREATE TABLE IF NOT EXISTS `#__mjcomments` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`content_id` int(11) UNSIGNED NOT NULL,
	`visitor_name` varchar(255) NOT NULL,
	`visitor_email` varchar(100) NOT NULL,
	`visitor_comments` text NOT NULL,
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`state` tinyint(2) NOT NULL DEFAULT 0,
	`checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`id`),
  KEY `idx_state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
