ALTER TABLE  `jos_ntrip_promotions` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_discovers` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_albums` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_hotels` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_images` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `images`;
-- ALTER TABLE  `jos_ntrip_promotions` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_questions` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_relaxes` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_restaurants` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_services` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_shoppings` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_tours` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;
ALTER TABLE  `jos_ntrip_comments` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `rating`;
ALTER TABLE  `jos_ntrip_warnings` ADD  `user_like` FLOAT( 11, 2 ) NOT NULL AFTER  `alias`;

-- 01/04/2012 - add table user like
CREATE TABLE `jos_ntrip_user_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `like` float(11,2) DEFAULT NULL COMMENT '1',
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE  `jos_ntrip_albums` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_discovers` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_hotels` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_promotions` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_questions` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_relaxes` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_restaurants` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_services` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_shoppings` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_tours` ADD  `hits` INT NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_warnings` ADD  `hits` INT NOT NULL AFTER  `user_like`;


-- 8.4.2013 - muinx - add user_rank to question table
ALTER TABLE  `jos_ntrip_questions` ADD  `user_rank` FLOAT( 11, 2 ) NOT NULL AFTER  `state`;

CREATE TABLE `jos_ntrip_gmap_info` (
  `item_id` int(11) NOT NULL DEFAULT '0',
  `item_type` varchar(255) NOT NULL DEFAULT '',
  `gmap_lat` varchar(255) DEFAULT NULL,
  `gmap_long` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`item_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 10.04.2013 - Mui NX - add tags field
ALTER TABLE  `jos_ntrip_albums` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_discovers` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_hotels` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_promotions` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_questions` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_relaxes` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_restaurants` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_services` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_shoppings` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_tours` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;
ALTER TABLE  `jos_ntrip_warnings` ADD  `tags` VARCHAR( 255 ) NOT NULL AFTER  `user_like`;