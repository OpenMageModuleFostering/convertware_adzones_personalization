<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Edit_Tab_Schedule extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('adzones_display', array('legend'=>Mage::helper('adzones')->__('Block Display')));
     
     $fieldset->addField('display_from', 'date', array(
          'label'     => Mage::helper('adzones')->__('From Date'),
          'tabindex' => 1,
			'name'	 => 'display_from',
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) 
        ));

      
     $fieldset->addField('display_to', 'date', array(
          'label'     => Mage::helper('adzones')->__('From Date'),
          'tabindex' => 1,
			'name'	 => 'display_to',
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) 
        ));
     
	$fieldsetSchedule = $form->addFieldset('adzones_schedule', array('legend'=>Mage::helper('adzones')->__('Schedule Pattern')));
     
    $fieldsetSchedule->addField('show_pattern', 'select', array(
          'label'     => Mage::helper('adzones')->__('Show'),
          //'class'     => 'required-entry',
          //'required'  => true,
          'name'      => 'show_pattern',
          'values' => Mage::getModel('adzones/showPattern')->getOptionArray()
      ));

      
     $fieldsetSchedule->addField('show_pattern_from', 'text', array(
          'label'     => Mage::helper('adzones')->__('From Time'),
          //'class'     => 'required-entry',
          //'required'  => true,
          'name'      => 'show_pattern_from',
		'note' =>'As Hours:Minutes:Seconds',
      ));
		
		 $fieldsetSchedule->addField('show_pattern_to', 'text', array(
          'label'     => Mage::helper('adzones')->__('To Time'),
          //'class'     => 'required-entry',
          //'required'  => true,
          'name'      => 'show_pattern_to',
		'note' =>'As Hours:Minutes:Seconds',
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
