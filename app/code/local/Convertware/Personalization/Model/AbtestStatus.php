<?php

class Convertware_Personalization_Model_AbtestStatus extends Mage_Core_Model_Abstract
{
    const STATUS_ONRUNNING	    = 1;
    const STATUS_HOLDBYADMIN	= 2;
	const STATUS_COMPLETE		= 3;
    static public function getOptionArray()
    {
        return array(
            self::STATUS_ONRUNNING    => Mage::helper('personalization')->__('On running'),
            self::STATUS_HOLDBYADMIN   => Mage::helper('personalization')->__('Hold by admin '),
			self::STATUS_COMPLETE   => Mage::helper('personalization')->__('Complete')
        );
    }
}
