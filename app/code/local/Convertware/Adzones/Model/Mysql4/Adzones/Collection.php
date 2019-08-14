<?php

class Convertware_Adzones_Model_Mysql4_Adzones_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected $_previewFlag;
    public function _construct()
    {
        parent::_construct();
        $this->_init('adzones/adzones');
    }
	/* find the all store for grid search filter */
	public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            if ($store instanceof Mage_Core_Model_Store) {
                $store = array($store->getId());
            }

            if (!is_array($store)) {
                $store = array($store);
            }

            if ($withAdmin) {
                $store[] = Mage_Core_Model_App::ADMIN_STORE_ID;
            }

            $this->addFilter('store_id', array('in' => $store), 'public');
        }
        return $this;
    }
	public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }
}
