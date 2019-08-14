<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('personalizationGrid');
      $this->setDefaultSort('personalization_id');
      $this->setDefaultDir('ASC');
      $this->setUseAjax(true);
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('personalization/personalization')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('personalization_id', array(
          'header'    => Mage::helper('personalization')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'personalization_id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('personalization')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
      ));
	
	 $this->addColumn('segmentation_type', array(
          'header'    => Mage::helper('personalization')->__('Segmentation Type'),
          'align'     =>'left',
          'index'     => 'segmentation_type',
          'type'      => 'options',
          'options' => Mage::getModel('personalization/segmentation')->getOptionArray()
      ));
		$this->addColumn('status', array(
          'header'    => Mage::helper('personalization')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Active',
              2 => 'Inactive',
          ),
      ));
		$this->addColumn('ab_test', array(
          'header'    => Mage::helper('personalization')->__('A/B'),
          'align'     =>'left',
          'index'     => 'ab_test',
		  'type'      => 'options',
          'options'   => array(
              1 => 'Active',
              2 => 'Inactive',
          ),
      ));

	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('personalization')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('personalization')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		$this->addColumn('removal',
            array(
                'header'    =>  Mage::helper('personalization')->__('Removal'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
				'class'     => 'ajax',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('personalization')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
      return parent::_prepareColumns();
  }

    

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}
