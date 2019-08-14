<?php

class Convertware_Personalization_Model_Mysql4_PersonalizationUrl extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the personalization_id refers to the key field in your database table.
        $this->_init('personalization/personalizationUrl', 'personalization_url_info_id');
    }
}
