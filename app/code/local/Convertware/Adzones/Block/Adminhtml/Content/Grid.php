<?php

class Convertware_Adzones_Block_Adminhtml_Content_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('contentGrid');
      $this->setDefaultSort('content_sort_order');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
      $this->setUseAjax(true);
      $this->setVarNameFilter('content_filter');
  }

  protected function _prepareCollection()
  {
		$adzonesId = Mage::getSingleton('adminhtml/session')->getAdzonesId();
		if($adzonesId)
      	{
			$collection = Mage::getModel('adzones/adzonesContent')->getCollection();

			$collection->getselect()->where('adzones_id is null or adzones_id='.$adzonesId);
			//$collection->printlogquery(true);
	  	}
		else{
			$collection = Mage::getModel('adzones/adzonesContent')->getCollection()->addFieldToFilter('adzones_id', array('null' => true));
		}
	  	$contentIds = $collection->load();
		$contentId = array();
		foreach($contentIds as $values)
		{
			$contentId[] = $values->getId(); 
		}
	  Mage::getSingleton('adminhtml/session')->setContentId($contentId);
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
	

    
      $this->addColumn('content_title', array(
          'header'    => Mage::helper('adzones')->__('Title'),
          'align'     =>'left',
          'index'     => 'content_title',
      ));
     /* $this->addColumn('', array(
			'header'    => Mage::helper('adzones')->__('Content'),
			'width'     => '150px',
			'index'     => '',
		   'renderer'  => 'Convertware_Adzones_Block_Adminhtml_Content_Renderer_Content',
      ));*/
	  
		$this->addColumn('content_sort_order', array(
          'header'    => Mage::helper('adzones')->__('Sort Order'),
          'align'     =>'left',
          'index'     => 'content_sort_order',
      ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('adzones')->__('Delete'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
				 'renderer'  => 'Convertware_Adzones_Block_Adminhtml_Content_Renderer_Deleteurl',
        ));
		$this->addColumn('edit',
            array(
                'header'    =>  Mage::helper('adzones')->__('Edit'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
				 'renderer'  => 'Convertware_Adzones_Block_Adminhtml_Content_Renderer_Editurl',
        ));
      return parent::_prepareColumns();
  }
  public function getRowUrl($row)
  {
     //return $this->getUrl('*/*/edit', array('id' => $row->getId()));

  }
	public function getGridUrl()
    {
    	return $this->getUrl('adzones/adminhtml_content/grid', array('_current'=>true));
    }
}
