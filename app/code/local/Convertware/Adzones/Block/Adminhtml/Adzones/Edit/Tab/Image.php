<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Edit_Tab_Image extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('adzones_genral', array('legend'=>Mage::helper('adzones')->__('Image information')));
     
	$fieldset->addField('adzone_image', 'image', array(
		  'label'     => Mage::helper('adzones')->__('Ad-zone Image'),
          'required'  => false,
          'name'      => 'adzone_image',
        ));
      $fieldset->addField('adzone_url', 'text', array(
          'label'     => Mage::helper('adzones')->__('Ad-zone Url'),
          'name'      => 'adzone_url',
      ));

      

      if ( Mage::getSingleton('adminhtml/session')->getAdzonesData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getAdzonesData());
          Mage::getSingleton('adminhtml/session')->setAdzonesData(null);
      } elseif ( Mage::registry('adzones_data') ) {
          $form->setValues(Mage::registry('adzones_data')->getData());
      }
      return parent::_prepareForm();
  }
}
