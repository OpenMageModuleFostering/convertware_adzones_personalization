<?php
class Convertware_Adzones_Block_Adminhtml_Content_Renderer_Content extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
	 	$Content = $row->getContent();
		
		//return Mage::helper('core/string')->truncate($Content,160);
		return $Content;
	}
}
?>
