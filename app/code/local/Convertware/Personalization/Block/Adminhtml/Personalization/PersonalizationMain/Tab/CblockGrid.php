<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_CblockGrid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('cblockGrid');
      $this->setDefaultSort('cblock_id');
      $this->setDefaultDir('ASC');
      $this->setUseAjax(true);
	  if(count($this->getSelectedCblocks())>1)
	  {
	  	$this->setDefaultFilter(array('in_cblock'=>1));
	  }
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('cblock/cblock')->getCollection();
      $collection->setFirstStoreFlag(true);
      $this->setCollection($collection);

      return parent::_prepareCollection();
  }
	protected function _addColumnFilterToCollection($column)
	{
		// Set custom filter for in product flag
		if ($column->getId() == 'in_cblock') {
			$ids = $this->_getSelectedCblocks();
			if (empty($ids)) {
				$ids = 0;
			}
			if ($column->getFilter()->getValue()) {
				$this->getCollection()->addFieldToFilter('cblock_id', array('in'=>$ids));
			} else {
				if($cblockIds) {
					$this->getCollection()->addFieldToFilter('cblock_id', array('nin'=>$ids));
				}
			}
		} else {
			parent::_addColumnFilterToCollection($column);
		}
		return $this;
	}
  protected function _prepareColumns()
  {
		$this->addColumn('in_cblock', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'values' => $this->_getSelectedCblocks(),
            'align' => 'center',
            'index' => 'cblock_id'
        ));

      $this->addColumn('cblock_id', array(
          'header'    => Mage::helper('cblock')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'cblock_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('cblock')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  $this->addColumn('block_position', array(
          'header'    => Mage::helper('cblock')->__('Position'),
          'align'     =>'left',
          'index'     => 'block_position',
          'type'      => 'options',
          'options' => Mage::getModel('cblock/blockPosition')->getOptionArray()
      ));
      $this->addColumn('status', array(
          'header'    => Mage::helper('cblock')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  $this->addColumn('position', array(
            'header'            => Mage::helper('cblock')->__('Position'),
            'name'              => 'position',
            'width'             => '10px',
            'type'              => 'number',
            'validate_class'    => 'validate-number',
            'index'             => 'position',
            'editable'          => true,
            'edit_only'         => true
        ));
       
      return parent::_prepareColumns();
  }
 	protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }
	public function getGridUrl()
    {
		return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/getCblockGrid', array('_current'=>true));
    }
  protected function _getSelectedCblocks()
    {
        $cblocks = $this->getCblocks();
        if (!is_array($cblocks)) {
            $cblocks = array_keys($this->getSelectedCblocks());
        }
        return $cblocks;
    }
	public function getSelectedCblocks()
	{
		$cblocks = array();
		if(Mage::registry('personalization_data'))
		{
			$cblock = Mage::registry('personalization_data');
			$cblockProduct = $cblock->getCblockIds(); 
			$cblockProduct = explode(',',$cblockProduct);
			foreach($cblockProduct as $products)
			{
				$cblocks[$products] = array('position' => $products);
			}
		}
        return $cblocks;
	}

}
