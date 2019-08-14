<?php

class Convertware_Personalization_Model_PersonalizationVisit extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/personalizationVisit');
    }
	
}
