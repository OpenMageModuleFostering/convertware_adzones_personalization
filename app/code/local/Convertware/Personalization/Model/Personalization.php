<?php

class Convertware_Personalization_Model_Personalization extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/personalization');
    }

/* function for finding latest 5 personalizations */
	public function getNewAddition()
	{
		$collection = Mage::getModel('personalization/personalization')->getCollection();
		$collection->getSelect()->order('main_table.personalization_id DESC')->limit( 5 );
		$perName = array();
		foreach($collection as $values)
		{
			$perName[] = $values['name'];
		}
		return $perName;
	}
/* End function for finding latest 5 personalizations */

/* function for finding all personalizations having a/b test*/
	public function getAllAddition()
	{
		$collection = Mage::getModel('personalization/personalization')->getCollection()->addFieldToFilter('ab_test','1');
		$perName = array();
		$perName[] = "";
		foreach($collection as $values)
		{
			$id = $values['personalization_id'];
			$collection = Mage::getModel('personalization/abtest')->getCollection()->addFieldToFilter('ab_test_status','1');
			$collection->getSelect()->where('personalization_first = '.$id.' or personalization_second = '.$id.'');
			if(count($collection) == 0){
				$perName[$values['personalization_id']] = $values['name'];
			}
		}
		return $perName;
	}
/* End function for finding all personalizations having a/b test*/
/* End function for finding all personalizations */
	public function getAllPersonalization()
	{
		$collection = Mage::getModel('personalization/personalization')->getCollection();
		$allPer = $collection->load();
		$personalization = array();
		$personalization[] = "";
		foreach($allPer as $values)
		{
			$personalization[$values->getId()] = $values->getName();
		}
		return $personalization;
	}
/* End function for finding all personalizations having */
}
