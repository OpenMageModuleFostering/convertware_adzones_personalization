<?php

class Convertware_Adzones_Block_Adminhtml_Content_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('adzones_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('adzones')->__(' '));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('adzones')->__('Item Information'),
          'title'     => Mage::helper('adzones')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('adzones/adminhtml_content_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}
