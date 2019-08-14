<?php

class Convertware_Personalization_Model_Criteria extends Varien_Object
{
    const Criteria_Time			= 'Time';
    const Criteria_Bounce		= 'Bounce Rate';
    const Criteria_Action		= 'Action';
    const Criteria_Conversion	= 'Conversion';
    const Criteria_Overall		= 'Overall';
    static public function getOptionArray()
    {
        return array(
            self::Criteria_Time	    	=> Mage::helper('personalization')->__('Time on page'),
            self::Criteria_Bounce	    => Mage::helper('personalization')->__('Bounce rate'),
            self::Criteria_Action	    => Mage::helper('personalization')->__('Action (click)'),
            self::Criteria_Conversion	=> Mage::helper('personalization')->__('Conversion rate'),
            self::Criteria_Overall	    => Mage::helper('personalization')->__('Overall sales generated')
        );
    }
}
