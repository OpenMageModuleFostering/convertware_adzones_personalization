<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('personalization')};
CREATE TABLE {$this->getTable('personalization')} (
  `personalization_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `segmentation_type` varchar(255) NOT NULL default '',
  `segmentation_values` text,
  `adzones_ids` varchar(255) NOT NULL default '',
  `ab_test` smallint(6) NOT NULL default '0',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`personalization_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

    ");

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('personalization_abtesting')};
CREATE TABLE {$this->getTable('personalization_abtesting')} (
  `personalization_ab_testing_id` int(11) unsigned NOT NULL auto_increment,
  `personalization_first` int(11) unsigned,
  `personalization_second` int(11) unsigned,
  `start_time` datetime NULL,
  `end_time` datetime NULL,
  `criteria` varchar(255),
  `ab_test_status` smallint(6) NOT NULL default '0',
  `personalization_first_result` varchar(255),
  `personalization_second_result` varchar(255),
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`personalization_ab_testing_id`),
  FOREIGN KEY (`personalization_first`) REFERENCES {$this->getTable('personalization')} (`personalization_id`)
  ON DELETE CASCADE,
  FOREIGN KEY (`personalization_second`) REFERENCES {$this->getTable('personalization')} (`personalization_id`)
  ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

    ");

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('personalization_overview')};
CREATE TABLE {$this->getTable('personalization_overview')} (
  `personalization_overview_id` int(11) unsigned NOT NULL auto_increment,
  `personalization_id` int(11) unsigned,
  `segmentation_type` varchar(255) NOT NULL default '',
  `visitors` int(11),
   `bounce_rate` varchar(255),
   `conversions` varchar(255),
   `conversion_rate` varchar(255),
   `revenues` varchar(255),
   `revenue_per_visit` varchar(255),
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`personalization_overview_id`),
  FOREIGN KEY (`personalization_id`) REFERENCES {$this->getTable('personalization')} (`personalization_id`)
  ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

    ");
$installer->endSetup(); 
