<?php

class Convertware_Personalization_Model_Mysql4_PersonalizationVisit extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the personalization_id refers to the key field in your database table.
        $this->_init('personalization/personalizationVisit', 'personalization_visit_id');
    }
}
