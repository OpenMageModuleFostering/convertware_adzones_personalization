<?php
class Convertware_Adzones_Model_ShowPattern extends Varien_Object
{
   	const PATTERN_EVERY		= 0;
    const PATTERN_MONDAY	= 1;
    const PATTERN_TUESDAY	= 2;
    const PATTERN_WEDNESDAY	= 3;
    const PATTERN_THURSDAY	= 4;
    const PATTERN_FRIDAY	= 5;
    const PATTERN_SATURDAY	= 6;
    const PATTERN_SUNDAY	= 7;
	static public function getOptionArray()
    {
        return array(
		  self::PATTERN_EVERY		=> Mage::helper('adzones')->__('Every Day'),
		  self::PATTERN_SUNDAY	=> Mage::helper('adzones')->__('Sunday'),
		  self::PATTERN_MONDAY		=> Mage::helper('adzones')->__('Monday'),
		  self::PATTERN_TUESDAY	=> Mage::helper('adzones')->__('Tuesday'),
		  self::PATTERN_WEDNESDAY		=> Mage::helper('adzones')->__('Wednesday'),
		  self::PATTERN_THURSDAY	=> Mage::helper('adzones')->__('Thursday'),
		  self::PATTERN_FRIDAY	=> Mage::helper('adzones')->__('Friday'),
		  self::PATTERN_SATURDAY	=> Mage::helper('adzones')->__('Saturday')
        );
    }
}
