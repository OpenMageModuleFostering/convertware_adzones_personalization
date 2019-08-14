<?php
class Convertware_Adzones_Block_Adminhtml_Adzones_Renderer_TotalContent extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getId();
		$contentCollection = Mage::getModel('adzones/adzonesContent')->getCollection()->addFieldToFilter('adzones_id',$Id);
		return count($contentCollection);
	}
}
?>
