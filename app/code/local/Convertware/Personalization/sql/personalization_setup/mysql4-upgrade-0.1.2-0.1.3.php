<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('personalization')} ADD COLUMN `default` int(6);

    ");

$installer->endSetup(); 
