<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

	public function __construct()
    {
        parent::__construct();
        $this->setTemplate('personalization/personalization/create.phtml');
    }
	  protected function _prepareForm()
	  {
		  if ( Mage::getSingleton('adminhtml/session')->getPersonalizationData() )
		  {
		      $form->setValues(Mage::getSingleton('adminhtml/session')->getPersonalizationData());
		      Mage::getSingleton('adminhtml/session')->setPersonalizationData(null);
		  } elseif ( Mage::registry('personalization_data') ) {
		      //$form->setValues(Mage::registry('personalization_data')->getData());
		  }
		  return parent::_prepareForm();
	  }
	public function getAdzones()
	{
		return $this->getLayout()->createBlock('personalization/adminhtml_personalization_personalizationMain_tab_adzonesGrid')->toHtml();
	}
	public function getCountryList()
    {
		$countryList = Mage::getModel('directory/country')->getResourceCollection() ->loadByStore() ->toOptionArray(true);
		return $countryList;
    }
	public function getRegionCollection($countryCode)
	{
		$regionCollection = Mage::getModel('directory/region_api')->items($countryCode);
		return $regionCollection;
	}

}
