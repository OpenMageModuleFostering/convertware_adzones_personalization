<?php

class Convertware_Adzones_Block_Adminhtml_Content_Edit_Tab_Form  extends Mage_Adminhtml_Block_Widget_Form
{
 	protected function _prepareForm()
  	{
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('page_');
		$this->setForm($form);
        $fieldset = $form->addFieldset('content_fieldset', array('legend'=>Mage::helper('cms')->__('Content'),'class'=>'fieldset-wide'));
     
	$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('add_variables' => false, 'add_widgets' => false,'files_browser_window_url'=>$this->getBaseUrl().'admin/cms_wysiwyg_images/index/'));
		
      $fieldset->addField('content_title', 'text', array(
          'label'     => Mage::helper('adzones')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'content_title',
      ));
		 $contentField = $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'style'     => 'height:36em;',
            'required'  => true,
            'disabled'  => $isElementDisabled,
            'config'    => $wysiwygConfig
        ));

        // Setting custom renderer for content field to remove label column
       $renderer = $this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset_element')
                    ->setTemplate('adzones/page/edit/form/renderer/content.phtml');
       $contentField->setRenderer($renderer);

     	$fieldset->addField('content_sort_order', 'text', array(
          'label'     => Mage::helper('adzones')->__('Sort Order'),
         // 'class'     => 'required-entry',
         // 'required'  => true,
          'name'      => 'content_sort_order',
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
