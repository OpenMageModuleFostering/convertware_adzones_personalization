<?php

class Convertware_Adzones_Model_Adzones extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('adzones/adzones');
    }
}
