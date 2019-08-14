<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_Compare extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
		$redirectUrl = $this->getUrl('*/*/getSiteTrafficCompare');
      $fieldset = $form->addFieldset('compare_form', array('legend'=>Mage::helper('personalization')->__('Compare details')));

      $fieldset->addField('personalization_compare_name', 'select', array(
          'label'     => Mage::helper('personalization')->__('Select Personalization'),
          'name'      => 'personalization_compare_name',
          'onchange' => "trafficCompare(this.value,'$redirectUrl');",
          'values' => Mage::getModel('personalization/personalization')->getAllPersonalization(),
      ));
	 return parent::_prepareForm();
  }
}
