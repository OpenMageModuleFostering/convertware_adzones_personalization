<?php
class Convertware_Adzones_Model_CustomerGroup extends Varien_Object
{
/* function for finding all customer group in option array */
    static public function toOptionArray()
    {
		$customer_group = new Mage_Customer_Model_Group();
		$allGroups  = $customer_group->getCollection()->toOptionHash();
		foreach($allGroups as $key=>$allGroup){
		   $customerGroup[$key]=array('value'=>$key,'label'=>$allGroup);
		}
		return $customerGroup;
	}
}
