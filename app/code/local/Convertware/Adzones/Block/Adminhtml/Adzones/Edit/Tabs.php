<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
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
      $this->addTab('genral_section', array(
          'label'     => Mage::helper('adzones')->__('Genral Information'),
          'title'     => Mage::helper('adzones')->__('Genral Information'),
          'content'   => $this->getLayout()->createBlock('adzones/adminhtml_adzones_edit_tab_genral')->toHtml(),
      ));
		$this->addTab('content_section', array(
		  'label'     => Mage::helper('adzones')->__('Content'),
		  'title'     => Mage::helper('adzones')->__('Content'),
		  'content'   => $this->getLayout()->createBlock('adzones/adminhtml_content')->toHtml(),
		));
		$this->addTab('image_section', array(
		  'label'     => Mage::helper('adzones')->__('Ad-zone Image'),
		  'title'     => Mage::helper('adzones')->__('Ad-zone Image'),
		  'content'   => $this->getLayout()->createBlock('adzones/adminhtml_adzones_edit_tab_image')->toHtml(),
		));
		$this->addTab('schedule_section', array(
		  'label'     => Mage::helper('adzones')->__('Schedule'),
		  'title'     => Mage::helper('adzones')->__('Schedule'),
		  'content'   => $this->getLayout()->createBlock('adzones/adminhtml_adzones_edit_tab_schedule')->toHtml(),
		));
		$this->addTab('category_section', array(
		  'label'     => Mage::helper('adzones')->__('Categories'),
		  'title'     => Mage::helper('adzones')->__('Categories'),
		  'content'   => $this->getLayout()->createBlock('adzones/adminhtml_adzones_edit_tab_categories')->toHtml(),
		));
		 
		$this->addTab('product_section', array(
         'label'     => Mage::helper('adzones')->__('Filter Product'),
         'title'     => Mage::helper('adzones')->__('Filter Produc'),
         'url'       => $this->getUrl('*/*/productgrid', array('_current' => true)),
         'class'     => 'ajax',
     	 	));
		$this->addTab('cms_section', array(
		  'label'     => Mage::helper('adzones')->__('CMS Pages'),
		  'title'     => Mage::helper('adzones')->__('CMS Pages'),
		  'content'   => $this->getLayout()->createBlock('adzones/adminhtml_adzones_edit_tab_cms')->toHtml(),
		));
	
      return parent::_beforeToHtml();
  }
}
