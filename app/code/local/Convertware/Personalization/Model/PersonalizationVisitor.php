<?php

class Convertware_Personalization_Model_PersonalizationVisitor extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/personalizationVisitor');
    }
	
}
