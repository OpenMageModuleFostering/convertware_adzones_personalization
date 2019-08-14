<?php

class Convertware_Personalization_Model_Mysql4_Personalization_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/personalization');
    }
/*function for finding current default personalization id*/
	public function getDefaultPersonalization()
	{
		$model = Mage::getModel('personalization/personalization')->getCollection()->addFieldToFilter("`default`",array('eq'=>'1'))->getData();
		if(count($model)>0)
		{
			return $model[0]['personalization_id'];
		}
		else{
			return ;
		}
	}
}
