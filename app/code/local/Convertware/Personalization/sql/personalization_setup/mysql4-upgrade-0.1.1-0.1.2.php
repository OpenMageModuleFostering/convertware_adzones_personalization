<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('personalization_visit')};
CREATE TABLE {$this->getTable('personalization_visit')} (
  `personalization_visit_id` int(11) unsigned NOT NULL auto_increment,
  `personalization_id` int(11) unsigned,
  `visit_count` int(11),
  `bounce_count` int(11),
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`personalization_visit_id`),
  FOREIGN KEY (`personalization_id`) REFERENCES {$this->getTable('personalization')} (`personalization_id`)
  ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

    ");
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('personalization_visitors')};
CREATE TABLE {$this->getTable('personalization_visitors')} (
  `personalization_visitor_id` int(11) unsigned NOT NULL auto_increment,
  `visitor_ip` varchar(255),
  `personalization_id` int(11) unsigned,
  PRIMARY KEY (`personalization_visitor_id`),
 FOREIGN KEY (`personalization_id`) REFERENCES {$this->getTable('personalization')} (`personalization_id`)
  ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 
