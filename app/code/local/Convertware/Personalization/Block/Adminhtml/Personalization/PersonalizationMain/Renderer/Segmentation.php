<?php
class Convertware_Personalization_Block_Adminhtml_Personalization_PersonalizationMain_Renderer_Segmentation extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getPersonalizationId();
		$Collection = Mage::getModel('personalization/personalization')->load($Id);
		$options = Mage::getModel('personalization/segmentation')->getOptionArray();
		return $options[$Collection->getSegmentationType()]; 
	}
}
?>
