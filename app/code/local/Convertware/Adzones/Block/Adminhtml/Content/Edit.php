<?php

class Convertware_Adzones_Block_Adminhtml_Content_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'adzones';
        $this->_controller = 'adminhtml_content';
        
        //$this->_updateButton('save', 'label', Mage::helper('adzones')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('adzones')->__('Delete Item'));
		$this->_removeButton('back');
		$this->_removeButton('save');
		$this->_removeButton('delete');
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save Item'),
            'onclick'   => 'saveAndContinueEdit();',
            'class'     => 'save',
        ), -100);
		$url = $this->getUrl('adzones/adminhtml_content/grid');
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('adzones_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'adzones_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'adzones_content');
                }
            }

            function saveAndContinueEdit(){
				$('togglepage_content').click();
               //editForm.submit($('edit_form').action+'back/edit/');
				new Ajax.Request($('edit_form').action,
	  			{
          			method : 'post',
					parameters: Form.serialize('edit_form'),
		  			onSuccess: function(transport){
						if(transport.responseText)
						{
							var ele = opener.document.getElementById('adzones_tabs_content_section_content');
					 		$(ele).update(transport.responseText);
							window.close();
						}
					},
					onFailure: function(error_msg){ alert(error_msg);}
	 			 });
            }
        ";
    }
	protected function _prepareLayout() {
		parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
		    $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
	}
    public function getHeaderText()
    {
        if( Mage::registry('adzones_data') && Mage::registry('adzones_data')->getId() ) {
            return Mage::helper('adzones')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('adzones_data')->getTitle()));
        } else {
            return Mage::helper('adzones')->__('Add Item');
        }
    }
}
