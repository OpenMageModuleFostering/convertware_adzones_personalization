<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'personalization';
        $this->_controller = 'adminhtml_personalization';
        
        $this->_updateButton('save', 'label', Mage::helper('personalization')->__('Save Personalization'));
        //$this->_updateButton('delete', 'label', Mage::helper('personalization')->__('Delete Personalization'));
		$this->_removeButton('back');
		$this->_removeButton('delete');
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('personalization_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'personalization_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'personalization_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('personalization_data') && Mage::registry('personalization_data')->getId() ) {
            return Mage::helper('personalization')->__("Edit Personalization '%s'", $this->htmlEscape(Mage::registry('personalization_data')->getName()));
        } else {
            return Mage::helper('personalization')->__('Add Personalization');
        }
    }
}
