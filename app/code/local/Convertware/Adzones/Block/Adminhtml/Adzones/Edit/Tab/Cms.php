<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Edit_Tab_Cms extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('adzones_cms', array('legend'=>Mage::helper('adzones')->__('CMS Pages')));

      $fieldset->addField('cms_page', 'select', array(
          'label'     => Mage::helper('adzones')->__('Show in CMS Pages'),
          'name'      => 'cms_page',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('adzones')->__('Yes'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('adzones')->__('No'),
              ),
          ),
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
