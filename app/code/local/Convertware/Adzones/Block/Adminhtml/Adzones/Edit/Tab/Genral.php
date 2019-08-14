<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Edit_Tab_Genral extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('adzones_genral', array('legend'=>Mage::helper('adzones')->__('Genral information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('adzones')->__('Block Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

        $field = $fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'store_id',
                'label'     => Mage::helper('cms')->__('Store View'),
                'title'     => Mage::helper('cms')->__('Store View'),
                'required'  => true,
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
        $field->setRenderer($renderer);


		$fieldset->addField('customer_group', 'multiselect', array(
          'label'     => Mage::helper('adzones')->__('Display ad-zones for certain customer groups'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'customer_group',
          'values' => Mage::getModel('adzones/customerGroup')->toOptionArray()
      ));
		$fieldset->addField('block_position', 'select', array(
          'label'     => Mage::helper('adzones')->__('Block Position'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'block_position',
          'values' => Mage::getModel('adzones/blockPosition')->getOptionArray()
      ));
		$fieldset->addField('mode', 'select', array(
          'label'     => Mage::helper('adzones')->__('Mode'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'mode',
          'values' => Mage::getModel('adzones/mode')->getOptionArray()
      ));
		 $fieldset->addField('sort_order', 'text', array(

          'label'     => Mage::helper('adzones')->__('Sort Order'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'sort_order',
      ));
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('adzones')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('adzones')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('adzones')->__('Disabled'),
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
