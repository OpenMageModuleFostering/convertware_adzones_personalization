<?php

class Convertware_Personalization_Model_Abtest extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/abtest');
    }

/*finding the best Personalization after testing finished*/
	public function getBestPerformer()
	{
		$collection = Mage::getModel('personalization/abtest')->getCollection();
		$collection->getSelect()->order('main_table.personalization_ab_testing_id DESC')->limit(5);
		$performer = array();
		foreach($collection as $value)
		{
			$per1 = $value->getPersonalizationFirst();
			$per2 = $value->getPersonalizationSecond();
			$key  = "$per1 / $per2";
			$val1 = $value->getPersonalizationFirstResult();
			$val2 = $value->getPersonalizationSecondResult();
			if($val1!=null && $val2!=null)
			{
				$performer[$key] = array($val1,$val2);
			}
		}
		return $performer;
	}
/*end finding the best Personalization after testing finished*/

/*Find the all winner personalization list from ab test*/
	public function gettestWinner()
	{
		$collection = Mage::getModel('personalization/abtest')->getCollection();
		$collection->getSelect()->order('main_table.personalization_ab_testing_id DESC')->limit(5);
		$winner = array();
		foreach($collection as $value)
		{
			$per1 = $value->getPersonalizationFirst();
			$per2 = $value->getPersonalizationSecond();
			$val1 = $value->getPersonalizationFirstResult();
			$val2 = $value->getPersonalizationSecondResult();
			if($val1!=null && $val2!=null)
			{
				if($val1 >= $val2)
				{
					$winner[] = Mage::getModel('personalization/personalization')->load($per1)->getName();
				}
				else{
					$winner[] = Mage::getModel('personalization/personalization')->load($per2)->getName();
				}
			}
			
		} 
		return $winner;
	}

/*Find the all winner personalization list from ab test*/



/*Find the all personalization list whose not assign with other personalization*/
	public function getPersonalizationtesting($id)
	{
		$collection = Mage::getModel('personalization/abtest')->getCollection()->addFieldToFilter('ab_test_status','1');
		$collection->getSelect()->where('personalization_first = '.$id.' or personalization_second = '.$id.'');
		$testing = array();
		foreach($collection as $value)
		{
			$per1 = $value->getPersonalizationFirst();
			$per2 = $value->getPersonalizationSecond();
			
			if($per1 != $id )
			{
				$compId = $per1;
				
			}
			else{
				$compId = $per2;
			}
			$perName = Mage::getModel('personalization/personalization')->load($compId)->getName();
			$testing[$value->getId()] =  $perName;
		}
		return $testing;
	}


/*End Find the all personalization list whose not assign with other personalization*/


/*Set Peronalization result by cron*/
	public function setTestResult()
	{

		
		$collection = Mage::getModel('personalization/abtest')->getCollection()->addFieldToFilter('ab_test_status','1');
		foreach($collection as $value)
		{
			if($value['end_time'] < now())
			{
				$value->setAbTestStatus(3);
				$value->save();
			}
			else if($value['start_time']<= now() && $value['end_time']>= now())
			{
				$per1 = $value->getPersonalizationFirst();
				$per2 = $value->getPersonalizationSecond();
				$criteria = $value->getCriteria();
				$result1 = 0;$result2 = 0;
			
				if($criteria == 'Time')
				{
					$visitCollection = Mage::getModel('personalization/personalizationVisit')->getCollection()->addFieldToFilter('personalization_id',array('in',array($per1,$per2)));
					foreach($visitCollection as $visit)
					{
						if($visit['personalization_id'] == $per1)
						{
							$result1 = $visit['visit_count'];
						}
						elseif($visit['personalization_id'] == $per2)
						{
							$result2 = $visit['visit_count'];
						}
					}
				}
				if($criteria == 'Bounce Rate' || $criteria == 'Conversion' || $criteria == 'Overall')
				{
					$overviewCollection = Mage::getModel('personalization/overview')->getCollection()->addFieldToFilter('personalization_id',array('in',array($per1,$per2)));
					foreach($overviewCollection as $overview)
					{
						if($overview['personalization_id'] == $per1)
						{
							if($criteria == 'Conversion')
							{
								$result1 = $overview['conversion_rate'];
							}
							if($criteria == 'Bounce Rate')
							{
								$result1 = $overview['bounce_rate'];
							}
							if($criteria == 'Overall')
							{
								$result1 = $overview['revenues'];
							}
						}
						elseif($overview['personalization_id'] == $per2)
						{
							if($criteria == 'Conversion')
							{
								$result2 = $overview['conversion_rate'];
							}
							if($criteria == 'Bounce Rate')
							{
								$result2 = $overview['bounce_rate'];
							}
							if($criteria == 'Overall')
							{
								$result2 = $overview['revenues'];
							}
						}
					}
					$result1 = str_replace('%','',$result1);
					$result2 = str_replace('%','',$result2);
				}
				$value->setPersonalizationFirstResult($result1);
				$value->setPersonalizationSecondResult($result2);
				$value->save(); 
			}
			
		}
	}
/*End Set Peronalization result by cron*/
}
