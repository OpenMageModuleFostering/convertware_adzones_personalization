<?php

class Convertware_Personalization_Model_Mysql4_PersonalizationUrl_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/personalizationUrl');
    }
}