<?php
class Convertware_Adzones_Block_Adminhtml_Content_Renderer_Deleteurl extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getId();
		$url = $this->getUrl('adzones/adminhtml_content/delete');
		$url .= "id/$Id";
		return '<a href="javascript:void(0)" onclick ="deleteContent(\''.$url.'\')">Delete</a>' ;

	 
	}
}
?>
