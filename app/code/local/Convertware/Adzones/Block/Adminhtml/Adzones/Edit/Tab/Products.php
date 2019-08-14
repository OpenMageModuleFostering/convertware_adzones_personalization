<?php

class Convertware_Adzones_Block_Adminhtml_Adzones_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('productGrid');
		$this->setUseAjax(true); // Using ajax grid is important
		$this->setDefaultSort('entity_id');
		$this->setDefaultFilter(array('in_products'=>1)); // By default we have added a filter for the rows, that in_products value to be 1
		$this->setSaveParametersInSession(false);  //Dont save paramters in session or else it creates problems
	}

	protected function _getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
  }
	
	protected function _prepareCollection()
	{
		$store = $this->_getStore();
        $collection = Mage::getModel('catalog/product')->getCollection()
                        ->addAttributeToSelect('sku')
                        ->addAttributeToSelect('name')
                        ->addAttributeToSelect('attribute_set_id')
                        ->addAttributeToSelect('type_id')
                        ->joinField('qty',
                                'cataloginventory/stock_item',
                                'qty',
                                'product_id=entity_id',
                                '{{table}}.stock_id=1',
                                'left');

        if ($store->getId()) {
            //$collection->setStoreId($store->getId());
            $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
            $collection->addStoreFilter($store);
            $collection->joinAttribute('name', 'catalog_product/name', 'entity_id', null, 'inner', $adminStore);
            $collection->joinAttribute('custom_name', 'catalog_product/name', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('price', 'catalog_product/price', 'entity_id', null, 'left', $store->getId());
        } else {
            $collection->addAttributeToSelect('price');
            $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner');
            $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner');
        }

        $this->setCollection($collection);

        parent::_prepareCollection();
        $this->getCollection()->addWebsiteNamesToResult();
        return $this;
	}
	protected function _addColumnFilterToCollection($column)
	{
		// Set custom filter for in product flag
		if ($column->getId() == 'in_products') {
			$ids = $this->_getSelectedProducts();
			if (empty($ids)) {
				$ids = 0;
			}
			if ($column->getFilter()->getValue()) {
				$this->getCollection()->addFieldToFilter('entity_id', array('in'=>$ids));
			} else {
				if($productIds) {
					$this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$ids));
				}
			}
		} else {
			parent::_addColumnFilterToCollection($column);
		}
		return $this;
	}

	protected function _prepareColumns()
	{

		    $this->addColumn('in_products', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'values' => $this->_getSelectedProducts(),
            'align' => 'center',
            'index' => 'entity_id'
        ));

        
        
        $this->addColumn('entity_id',
                array(
                    'header' => Mage::helper('adzones')->__('ID'),
                    'width' => '40px',
                    'type' => 'number',
                    'index' => 'entity_id',
        ));
        $this->addColumn('name',
                array(
                    'header' => Mage::helper('adzones')->__('Name'),
                    'index' => 'name',
        ));

        $store = $this->_getStore();
        if ($store->getId()) {
            $this->addColumn('custom_name',
                    array(
                        'header' => Mage::helper('adzones')->__('Name in %s', $store->getName()),
                        'index' => 'custom_name',
            ));
        }

        $this->addColumn('type',
                array(
                    'header' => Mage::helper('adzones')->__('Type'),
                    'width' => '60px',
                    'index' => 'type_id',
                    'type' => 'options',
                    'options' => Mage::getSingleton('catalog/product_type')->getOptionArray(),
        ));

        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
                        ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
                        ->load()
                        ->toOptionHash();

        $this->addColumn('set_name',
                array(
                    'header' => Mage::helper('adzones')->__('Attrib. Set Name'),
                    'width' => '100px',
                    'index' => 'attribute_set_id',
                    'type' => 'options',
                    'options' => $sets,
        ));

        $this->addColumn('sku',
                array(
                    'header' => Mage::helper('adzones')->__('SKU'),
                    'width' => '80px',
                    'index' => 'sku',
        ));

//        $store = $this->_getStore();
//        $this->addColumn('price',
//            array(
//                'header'=> Mage::helper('catalog')->__('Price'),
//                'type'  => 'price',
//                'currency_code' => $store->getBaseCurrency()->getCode(),
//                'index' => 'price',
//        ));

        $this->addColumn('qty',
                array(
                    'header' => Mage::helper('adzones')->__('Qty'),
                    'width' => '100px',
                    'type' => 'number',
                    'index' => 'qty',
        ));

        $this->addColumn('visibility',
                array(
                    'header' => Mage::helper('adzones')->__('Visibility'),
                    'width' => '70px',
                    'index' => 'visibility',
                    'type' => 'options',
                    'options' => Mage::getModel('catalog/product_visibility')->getOptionArray(),
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
        
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('websites',
                    array(
                        'header' => Mage::helper('adzones')->__('Websites'),
                        'width' => '100px',
                        'sortable' => false,
                        'index' => 'websites',
                        'type' => 'options',
                        'options' => Mage::getModel('core/website')->getCollection()->toOptionHash(),
            ));
        }

       

        return parent::_prepareColumns();
	}


	protected function _getSelectedProducts()
    {
        $products = $this->getProducts();
        if (!is_array($products)) {
            $products = array_keys($this->getSelectedProducts());
        }
        return $products;
    }

	public function getGridUrl()
	{
		return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/productgridajax', array('_current'=>true));
	}
	
	public function getSelectedProducts()
	{
		$id = Mage::getSingleton('adminhtml/session')->getAdzonesId();
		$product = array();
		if($id)
		{
			$adzones = Mage::getModel('adzones/adzones')->load($id);
			$adzonesProduct = $adzones->getProductId(); 
			$adzonesProduct = explode(',',$adzonesProduct);
			foreach($adzonesProduct as $products)
			{
				$product[$products] = array('position' => $products);
			}
		}
        return $product;
	}


}
