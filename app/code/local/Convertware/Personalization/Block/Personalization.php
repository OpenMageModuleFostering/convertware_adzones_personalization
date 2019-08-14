<?php
class Convertware_Personalization_Block_Personalization extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getPersonalization()     
     { 
        if (!$this->hasData('personalization')) {
            $this->setData('personalization', Mage::registry('personalization'));
        }
        return $this->getData('personalization');
        
    }
}