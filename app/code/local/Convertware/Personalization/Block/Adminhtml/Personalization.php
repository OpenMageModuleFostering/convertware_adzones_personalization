<?php
class Convertware_Personalization_Block_Adminhtml_Personalization extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_personalization';
    $this->_blockGroup = 'personalization';
    $this->_headerText = Mage::helper('personalization')->__('Personalization');
    $this->_addButtonLabel = Mage::helper('personalization')->__('Create Personalization');
    parent::__construct();
  }
}
