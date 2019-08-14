<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('adzones_api')};
CREATE TABLE {$this->getTable('adzones_api')} (
  `adzones_api_content_id` int(11) unsigned NOT NULL auto_increment,
  `content` text NULL default '',
  PRIMARY KEY (`adzones_api_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
");

$installer->endSetup(); 
