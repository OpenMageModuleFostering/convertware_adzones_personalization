<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('personalization_url_info')};
CREATE TABLE {$this->getTable('personalization_url_info')} (
  `personalization_url_info_id` int(11) unsigned NOT NULL auto_increment,
  `session_id` varchar(255),
  `url` text,
  PRIMARY KEY (`personalization_url_info_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 
