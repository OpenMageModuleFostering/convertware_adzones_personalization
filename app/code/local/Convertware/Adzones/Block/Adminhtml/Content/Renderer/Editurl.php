<?php
class Convertware_Adzones_Block_Adminhtml_Content_Renderer_Editurl extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getId();
		$url = $this->getUrl('adzones/adminhtml_content/edit');
		$url .= "id/$Id";
		$onclick= "popWin('$url', '','top:100,left:200,width=960,height=600,resizable=yes,scrollbars=yes')";
		return '<a href="javascript:void(0)" onclick ="'.$onclick.'">Edit</a>';
	}
}
?>
