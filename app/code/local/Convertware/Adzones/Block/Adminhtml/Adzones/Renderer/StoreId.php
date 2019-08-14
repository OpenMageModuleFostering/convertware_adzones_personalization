<?php
class Convertware_Adzones_Block_Adminhtml_Adzones_Renderer_StoreId extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getId();
		$Collection = Mage::getModel('adzones/adzones')->load($Id);
		$Collection->getStoreId();
		$storeId = explode(',',$storeId);
		return $storeId;
	}
}
?>
