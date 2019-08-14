<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
		
      parent::__construct();
      $this->setId('adzonesGrid');
      $this->setDefaultSort('adzones_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
		
      $collection = Mage::getModel('adzones/adzones')->getCollection();
      $collection->setFirstStoreFlag(true);
      $this->setCollection($collection);

      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('adzones_id', array(
          'header'    => Mage::helper('adzones')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'adzones_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('adzones')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  $this->addColumn('block_position', array(
          'header'    => Mage::helper('adzones')->__('Position'),
          'align'     =>'left',
          'index'     => 'block_position',
          'type'      => 'options',
          'options' => Mage::getModel('adzones/blockPosition')->getOptionArray()
      ));
	  $this->addColumn('blocks', array(
          'header'    => Mage::helper('adzones')->__('Blocks'),
          'align'     => 'left',
          'index'     => 'blocks',
		  'type'       => 'text',
		  'renderer'  => 'Convertware_Adzones_Block_Adminhtml_Adzones_Renderer_TotalContent',
      ));
	  $this->addColumn('mode', array(
          'header'    => Mage::helper('adzones')->__('Mode'),
          'align'     =>'left',
          'index'     => 'mode',
          'type'      => 'options',
          'options' => Mage::getModel('adzones/mode')->getOptionArray(),
      ));
	  $this->addColumn('display_from', array(
          'header'    => Mage::helper('adzones')->__('Display From'),
          'align'     =>'left',
          'index'     => 'display_from',
          'type'      => 'date',
      ));
	  $this->addColumn('display_to', array(
          'header'    => Mage::helper('adzones')->__('Display to'),
          'align'     =>'left',
          'index'     => 'display_to',
          'type'      => 'date',
      ));
	  $this->addColumn('show_pattern', array(
          'header'    => Mage::helper('adzones')->__('Schedule Pattern'),
          'align'     =>'left',
          'index'     => 'show_pattern',
          'type'      => 'options',
          'options' => Mage::getModel('adzones/showPattern')->getOptionArray()
      ));
	/* if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('adzones')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }*/
      $this->addColumn('status', array(
          'header'    => Mage::helper('adzones')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('adzones')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('adzones')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('adzones')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('adzones')->__('XML'));
	  
      return parent::_prepareColumns();
  }
 	protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('adzones_id');
        $this->getMassactionBlock()->setFormFieldName('adzones');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('adzones')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('adzones')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('adzones/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('adzones')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('adzones')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}
