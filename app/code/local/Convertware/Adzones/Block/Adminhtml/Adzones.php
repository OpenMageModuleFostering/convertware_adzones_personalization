<?php
class Convertware_Adzones_Block_Adminhtml_Adzones extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_adzones';
    $this->_blockGroup = 'adzones';
    $this->_headerText = Mage::helper('adzones')->__('Ad-Zones Manager');
    $this->_addButtonLabel = Mage::helper('adzones')->__('Add Block');
    parent::__construct();
  }
}
