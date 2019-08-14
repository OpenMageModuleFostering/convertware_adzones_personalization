<?php
class Convertware_Adzones_Block_Adminhtml_Content extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_content';
    $this->_blockGroup = 'adzones';
    $this->_headerText = Mage::helper('adzones')->__('Content Manager');
    $this->_addButtonLabel = Mage::helper('adzones')->__('Add Content');
	$url = $this->getUrl('adzones/adminhtml_content/new');
	$this->_addButton('addItem', array(
            'label'     => Mage::helper('adminhtml')->__('Add Item'),
			'onclick'   => "popWin('$url', '','top:100,left:200,width=960,height=600,resizable=yes,scrollbars=yes')",
            'class'     => 'add',
        ), -100);
    parent::__construct();
	$this->_removeButton('add');
  }
}
