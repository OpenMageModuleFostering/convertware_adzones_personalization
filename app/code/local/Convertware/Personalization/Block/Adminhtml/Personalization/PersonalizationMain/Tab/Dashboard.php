<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_Dashboard extends Mage_Adminhtml_Block_Widget_Form
{
  	public function __construct()
    {
        parent::__construct();
        $this->setTemplate('personalization/personalization/dashboard.phtml');
    }
}
