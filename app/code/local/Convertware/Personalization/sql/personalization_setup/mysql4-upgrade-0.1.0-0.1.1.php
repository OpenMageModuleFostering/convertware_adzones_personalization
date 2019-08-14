<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('sales/order'), 'personalization_ids', array(
        'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'Personalization Ids',
	     'nullable'  => true,
        'length'  => '20000'
    ));
$installer->endSetup();
