<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_Overview extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('overviewGrid');
      $this->setDefaultSort('personalization_id');
      $this->setDefaultDir('ASC');
      $this->setUseAjax(true);
      $this->setSaveParametersInSession(true);
  }
	protected function _getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }
  protected function _prepareCollection()
  {
      $collection = Mage::getModel('personalization/overview')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('name', array(
          'header'    => Mage::helper('personalization')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
		  'type'       => 'text',
		  'renderer'  => 'Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Renderer_Name',
      ));
	
	 $this->addColumn('segmentation_type', array(
          'header'    => Mage::helper('personalization')->__('Segmentation Type'),
          'align'     =>'left',
          'index'     => 'segmentation_type',
          'type'      => 'options',
'renderer'  => 'Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Renderer_Segmentation',
          'options' => Mage::getModel('personalization/segmentation')->getOptionArray(),
		  
      ));

		$this->addColumn('visitors', array(
          'header'    => Mage::helper('personalization')->__('Visitors'),
          'align'     =>'left',
          'index'     => 'visitors',
      ));

		$this->addColumn('bounce_rate', array(
          'header'    => Mage::helper('personalization')->__('Bounce Rate'),
          'align'     =>'left',
          'index'     => 'bounce_rate',
      ));

		$this->addColumn('conversions', array(
          'header'    => Mage::helper('personalization')->__('Conversions'),
          'align'     =>'left',
          'index'     => 'conversions',
      ));
		$this->addColumn('conversion_rate', array(
          'header'    => Mage::helper('personalization')->__('Conversion Rate'),
          'align'     =>'left',
          'index'     => 'conversion_rate',
      ));
        $store = $this->_getStore();
		$this->addColumn('revenues', array(
          'header'    => Mage::helper('personalization')->__('Revenues'),
          'align'     =>'left',
          'index'     => 'revenues',
			'type'  => 'price',
           'currency_code' => $store->getBaseCurrency()->getCode(),
      ));
		$this->addColumn('revenue_per_visit', array(
          'header'    => Mage::helper('personalization')->__('Revenue Per Visit'),
          'align'     => 'left',
          'index'     => 'revenue_per_visit',
		  'type'  => 'price',
          'currency_code' => $store->getBaseCurrency()->getCode(),
		
      ));

		
	  
      return parent::_prepareColumns();
  }
  public function getRowUrl($row)
  {
     // return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
	public function getGridUrl()
    {
    	return $this->getUrl('*/*/overviewgrid', array('_current'=>true));
    }

}
