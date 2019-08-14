<?php

class Convertware_Adzones_Model_Api extends Mage_Core_Model_Abstract
{
	public function _construct()
    {
        parent::_construct();
        $this->_init('adzones/api');
    }
    public function getApi()
	{
		$licenseKey = $this->getLicenseKey();
		$domainName = $this->getDomainName();
		$status = $this->getModuleStatus();
		if($status)
		{
			$content = file_get_contents('http://www.convertware.com/lib/convertware/license/license.php?key='.$licenseKey.'&domain='.$domainName);
			if($content)
			{
				
				$apiModel = Mage::getModel('adzones/api')->getCollection();
				if(count($apiModel->getData()) > 0)
				foreach($apiModel->load() as $api)
				{
					$api->setContent($content);
					$api->save();
				}
				else{
					$model = Mage::getModel('adzones/api');
					$model->setContent($content);
					$model->save();
				}
			}
		}
	}
	public function getLicenseKey()
	{
		$store_id = Mage::helper('core')->getStoreId();
		return Mage::getStoreConfig('convertware_options/license/license_key',$store_id);
	}
	public function getModuleStatus()
	{
		$store_id = Mage::helper('core')->getStoreId();
		return Mage::getStoreConfig('convertware_options/settings/enabled',$store_id);
	}
	public function getDomainName()
	{
		return $_SERVER['SERVER_NAME'];
	}
}
