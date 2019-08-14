<?php

class Convertware_Adzones_Model_AdzonesContent extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('adzones/adzonesContent');
    }
}
