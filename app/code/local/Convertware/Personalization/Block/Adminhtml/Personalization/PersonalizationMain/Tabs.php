<?php
class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
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
	 
      $this->addTab('dashboard_section', array(
          'label'     => Mage::helper('personalization')->__('Dashboard'),
          'title'     => Mage::helper('personalization')->__('Dashboard'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_personalizationMain_tab_dashboard')->toHtml(),
      ));
	  $this->addTab('overview_section', array(
          'label'     => Mage::helper('personalization')->__('Overview'),
          'title'     => Mage::helper('personalization')->__('Overview'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_personalizationMain_tab_overview')->toHtml(),
      ));
		 $this->addTab('personalization_section', array(
          'label'     => Mage::helper('personalization')->__('Personalizations'),
          'title'     => Mage::helper('personalization')->__('Personalizations'),
          'url'       => $this->getUrl('*/*/index', array('_current' => true)),
          'class'     => 'ajax',
      ));
	 $this->addTab('account_section', array(
          'label'     => Mage::helper('personalization')->__('Account Information'),
          'title'     => Mage::helper('personalization')->__('Account Information'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_personalizationMain_tab_account')->toHtml(),
      ));
		 $this->addTab('domain_section', array(
          'label'     => Mage::helper('personalization')->__('Change Domain'),
          'title'     => Mage::helper('personalization')->__('Change Domain'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_personalizationMain_tab_domain')->toHtml(),
      ));

		$this->addTab('create_section', array(
          'label'     => Mage::helper('personalization')->__('Create Personalization'),
          'title'     => Mage::helper('personalization')->__('Create Personalization'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_edit_tab_form')->toHtml(),
      ));
		$this->addTab('compare_section', array(
          'label'     => Mage::helper('personalization')->__('Data Comparison'),
          'title'     => Mage::helper('personalization')->__('Data Comparison'),
          'content'   => $this->getLayout()->createBlock('personalization/adminhtml_personalization_personalizationMain_tab_compare')->toHtml(),

      ));
     
      return parent::_beforeToHtml();
  }
}
