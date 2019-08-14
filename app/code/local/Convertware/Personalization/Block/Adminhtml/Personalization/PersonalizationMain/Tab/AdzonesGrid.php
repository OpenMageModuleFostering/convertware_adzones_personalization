<?php

class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Tab_AdzonesGrid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('adzonesGrid');
      $this->setDefaultSort('adzones_id');
      $this->setDefaultDir('ASC');
      $this->setUseAjax(true);
	  if(count($this->getSelectedAdzoness())>1)
	  {
	  	$this->setDefaultFilter(array('in_adzones'=>1));
	  }
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('adzones/adzones')->getCollection();
      $collection->setFirstStoreFlag(true);
      $this->setCollection($collection);

      return parent::_prepareCollection();
  }
	protected function _addColumnFilterToCollection($column)
	{
		// Set custom filter for in product flag
		if ($column->getId() == 'in_adzones') {
			$ids = $this->_getSelectedAdzoness();
			if (empty($ids)) {
				$ids = 0;
			}
			if ($column->getFilter()->getValue()) {
				$this->getCollection()->addFieldToFilter('adzones_id', array('in'=>$ids));
			} else {
				if($adzonesIds) {
					$this->getCollection()->addFieldToFilter('adzones_id', array('nin'=>$ids));
				}
			}
		} else {
			parent::_addColumnFilterToCollection($column);
		}
		return $this;
	}
  protected function _prepareColumns()
  {
		$this->addColumn('in_adzones', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'values' => $this->_getSelectedAdzoness(),
            'align' => 'center',
            'index' => 'adzones_id'
        ));

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
	  $this->addColumn('position', array(
            'header'            => Mage::helper('adzones')->__('Position'),
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
		return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/getAdzonesGrid', array('_current'=>true));
    }
  protected function _getSelectedAdzoness()
    {
        $adzoness = $this->getAdzoness();
        if (!is_array($adzoness)) {
            $adzoness = array_keys($this->getSelectedAdzoness());
        }
        return $adzoness;
    }
	public function getSelectedAdzoness()
	{
		$adzoness = array();
		if(Mage::registry('personalization_data'))
		{
			$adzones = Mage::registry('personalization_data');
			$adzonesProduct = $adzones->getAdzonesIds(); 
			$adzonesProduct = explode(',',$adzonesProduct);
			foreach($adzonesProduct as $products)
			{
				$adzoness[$products] = array('position' => $products);
			}
		}
        return $adzoness;
	}

}
