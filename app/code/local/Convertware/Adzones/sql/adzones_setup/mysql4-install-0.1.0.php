<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('adzones_genral')};
CREATE TABLE {$this->getTable('adzones_genral')} (
  `adzones_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `store_id` varchar(255) NULL,
  `status` smallint(6) NOT NULL default '0',
  `customer_group` varchar(255) NULL,
  `block_position` smallint(6) NOT NULL default '0',
  `mode` smallint(6) NOT NULL default '0',
  `cms_page` smallint(6) NOT NULL default '0',
  `display_from` datetime NULL,
  `display_to` datetime NULL,
  `show_pattern` smallint(6) NOT NULL default '0',
  `show_pattern_from` varchar(255) NULL,
  `show_pattern_to` varchar(255) NULL,
  `category_id` varchar(255) NULL,
  `show_in_subcategory` smallint(6) NOT NULL default '0',
  `product_id` varchar(255) NOT NULL default '',
  `adzone_image` varchar(255) NULL,
  `adzone_url` varchar(255) NULL,
  `sort_order` smallint(6) NOT NULL default '0',	
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`adzones_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('adzones_content')};
CREATE TABLE {$this->getTable('adzones_content')} (
  `adzones_content_id` int(11) unsigned NOT NULL auto_increment,
  `adzones_id` int(11) unsigned,
  `content_title` varchar(255) NOT NULL default '',
  `content` text NOT NULL default '',
  `content_sort_order` smallint(6) NOT NULL default '0',
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`adzones_content_id`),
  FOREIGN KEY (`adzones_id`) REFERENCES {$this->getTable('adzones_genral')} (`adzones_id`)
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
$installer->endSetup(); 
