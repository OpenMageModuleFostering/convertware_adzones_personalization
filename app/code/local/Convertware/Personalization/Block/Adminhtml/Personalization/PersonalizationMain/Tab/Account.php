<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_Account extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('account_form', array('legend'=>Mage::helper('personalization')->__('Account information')));

      $fieldset->addField('company_name', 'label', array(
          'label'     => Mage::helper('personalization')->__('Company Name'),
          'name'      => 'company_name',
      ));
	  $fieldset->addField('domain_url', 'label', array(
          'label'     => Mage::helper('personalization')->__('Licensed Domain'),
          'name'      => 'domain_url',
      ));
	  $fieldset->addField('license_plan', 'label', array(
          'label'     => Mage::helper('personalization')->__('Current Plan'),
          'name'      => 'license_plan',
      ));
      $fieldset->addField('personalization_used', 'label', array(
          'label'     => Mage::helper('personalization')->__('Personalizations Used'),
          'name'      => 'personalization_used',
      ));
		$fieldset->addField('upgrade', 'note', array(
		  'text'      => $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
		                  'label'     => Mage::helper('personalization')->__('UPGRADE PLAN'),
			 	 'onclick'   => "window.location='http://www.convertware.com/index.php/pricing/license/details/'",
				  'class' 	  => '',
					))    ->toHtml(),
		));	
     
	 $details = Mage::helper('personalization/system')->getLicenseDetails();
		$personalizationModel = Mage::getModel('personalization/personalization')->getCollection();
	 $details['personalization_used'] = count($personalizationModel);
	 $form->setValues($details);
		
      return parent::_prepareForm();
  }
}
