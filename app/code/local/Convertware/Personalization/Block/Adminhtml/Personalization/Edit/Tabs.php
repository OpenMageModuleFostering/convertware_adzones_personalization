<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('personalization_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('personalization')->__(' '));
  }

  protected function _beforeToHtml()
  {
	
    $this->addTab('form_section', array(
          'label'     => Mage::helper('personalization')->__('Personalization Information'),
          'title'     => Mage::helper('personalization')->__('Personalization Information'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_edit_tab_form')->toHtml(),
      ));
      return parent::_beforeToHtml();
  }
}
