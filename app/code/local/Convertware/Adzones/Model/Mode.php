<?php
class Convertware_Adzones_Model_Mode extends Varien_Object
{
   	const MODE_SHOW_ALL		= 1;
    const MODE_SHOW_RANDOM	= 2;
	static public function getOptionArray()
    {
        return array(
		  self::MODE_SHOW_ALL		=> Mage::helper('adzones')->__('Show All'),
		  self::MODE_SHOW_RANDOM	=> Mage::helper('adzones')->__('Show Random')
        );
    }
}
