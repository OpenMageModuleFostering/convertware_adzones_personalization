<?php

class Convertware_Adzones_Model_Mysql4_AdzonesContent extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the adzones_id refers to the key field in your database table.
        $this->_init('adzones/adzonesContent', 'adzones_content_id');
    }
}
