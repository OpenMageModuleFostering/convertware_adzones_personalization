<?php
class Convertware_Adzones_Model_BlockPosition extends Varien_Object
{
   	const POSITION_MENU_TOP		= 1;
    const POSITION_MENU_BOTTOM	= 2;
    const POSITION_LEFT_TOP		= 3;
    const POSITION_LEFT_BOTTOM	= 4;
    const POSITION_RIGHT_TOP	= 5;
    const POSITION_RIGHT_BOTTOM	= 6;
    const POSITION_CONTENT_TOP	= 7;
    const POSITION_PAGE_BOTTOM	= 8;
    const POSITION_CHECKOUT_CONTENT_TOP	= 9;
    const POSITION_CUSTOMER_CONTENT_TOP	= 10;

	
	static public function getOptionArray()
    {
        return array(
		  self::POSITION_MENU_TOP		=> Mage::helper('adzones')->__('Menu top'),
		  self::POSITION_MENU_BOTTOM	=> Mage::helper('adzones')->__('Menu bottom'),
		  self::POSITION_LEFT_TOP		=> Mage::helper('adzones')->__('Sidebar left top'),
		  self::POSITION_LEFT_BOTTOM	=> Mage::helper('adzones')->__('Sidebar left bottom'),
		  self::POSITION_RIGHT_TOP		=> Mage::helper('adzones')->__('Sidebar right top'),
		  self::POSITION_RIGHT_BOTTOM	=> Mage::helper('adzones')->__('Sidebar right bottom'),
		  self::POSITION_CONTENT_TOP	=> Mage::helper('adzones')->__('Content top'),
		  self::POSITION_PAGE_BOTTOM	=> Mage::helper('adzones')->__('Page bottom'),
		  self::POSITION_CHECKOUT_CONTENT_TOP	=> Mage::helper('adzones')->__('Cart content top'),
		  self::POSITION_CUSTOMER_CONTENT_TOP	=> Mage::helper('adzones')->__('Customer content top')

		
        );
    }
}
