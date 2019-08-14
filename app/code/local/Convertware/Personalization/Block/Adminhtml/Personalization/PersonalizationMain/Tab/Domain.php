<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_Domain extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
	  $url = $this->getUrl('*/*/changeDomain');
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('account_form', array('legend'=>Mage::helper('personalization')->__('Account information')));

      $fieldset->addField('license_key', 'text', array(
          'label'     => Mage::helper('personalization')->__('License Key'),
          'name'      => 'license_key',
      ));
	  $fieldset->addField('current_domain', 'text', array(
          'label'     => Mage::helper('personalization')->__('Current Domain Url'),
          'name'      => 'current_domain',
      ));
	  $fieldset->addField('new_domain', 'text', array(
          'label'     => Mage::helper('personalization')->__('New Domain Url'),
          'name'      => 'new_domain',
      ));
      
	  $fieldset->addField('upgrade', 'note', array(
		  'text'      => $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
		                  'label'     => Mage::helper('personalization')->__('Change Domain'),
			 	  'onclick'   => "return changeDomain('$url');",
				  'class' 	  => '',
					))    ->toHtml(),
		));	
     
	
		
      return parent::_prepareForm();
  }
}
