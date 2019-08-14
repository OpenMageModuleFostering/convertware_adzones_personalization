<?php

class Convertware_Personalization_Model_Overview extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('personalization/overview');
    }
/* get Overview value for drwaing graph in backend*/
	public function getOverview()
	{
		$collection = Mage::getModel('personalization/overview')->getCollection();
		$locationRevenues = "";$kewordRevenues = "";$refererRevenues = "";$previsitRevenues = "";$socialRevenues = "";
		$mobileRevenues = "";$emailRevenues = "";
		foreach($collection as $value)
		{
			if($value->getSegmentationType() == '1')
			{
				$locationRevenues = $locationRevenues+$value->getRevenues();
			}
			if($value->getSegmentationType() == '2')
			{
				$kewordRevenues = $kewordRevenues+$value->getRevenues();
			}
			if($value->getSegmentationType() == '3')
			{
				$refererRevenues = $refererRevenues+$value->getRevenues();
			}
			if($value->getSegmentationType() == '4')
			{
				$previsitRevenues = $previsitRevenues+$value->getRevenues();
			}
			if($value->getSegmentationType() == '5')
			{
				$socialRevenues = $socialRevenues+$value->getRevenues();
			}
			if($value->getSegmentationType() == '6')
			{
				$mobileRevenues = $mobileRevenues+$value->getRevenues();
			}
			if($value->getSegmentationType() == '7')
			{
				$emailRevenues = $emailRevenues+$value->getRevenues();
			}
		}
		$overview = array();
		if($locationRevenues)
		{
			$overview['Location'] = $locationRevenues;
		}
		if($kewordRevenues)
		{
			$overview['Keyword(s)'] = $kewordRevenues;
		}
		if($refererRevenues)
		{
			$overview['Referer'] = $refererRevenues;
		}
		if($previsitRevenues)
		{
			$overview['Previous Visit'] = $previsitRevenues;
		}
		if($socialRevenues)
		{
			$overview['Social'] = $socialRevenues;
		}
		if($mobileRevenues)
		{
			$overview['Mobile'] = $mobileRevenues;
		}
		if($emailRevenues)
		{
			$overview['Email'] = $emailRevenues;
		}
		return $overview;
	}
/*End get Overview value for drwaing graph in backend*/

/*set personalization overview by cron */
	public function setOverview()
	{
		$orderModel = Mage::getModel('sales/order')->getCollection();
		$orderModel->getSelect()->where('personalization_ids IS NOT NULL');
		//$orderModel->printlogquery(true);
		//print_r($orderModel->getData());
		$personalizationVisitModel = Mage::getModel('personalization/personalizationVisit')->getCollection();
		foreach($personalizationVisitModel->getData() as $values)
		{
			
			$id = $values['personalization_id'];
			$totalVisit = $values['visit_count'];
			$personalizationVisitorModel = Mage::getModel('personalization/personalizationVisitor')->getCollection()->addFieldToFilter('personalization_id',$id);
			$visitors = count($personalizationVisitorModel->getData());
			$bounceRate = ($values['bounce_count']/$values['visit_count'])*100;
			$bounceRate = number_format ($bounceRate, 2)."%";
			$conversionModel = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('personalization_ids',array('finset'=>$id));
			$conversion = count($conversionModel->getData());
			$conversionRate = ($conversion/$totalVisit)*100;
			$conversionRate = number_format ($conversionRate, 2)."%";
			
			$overview = Mage::getModel('personalization/overview')->getCollection()->addFieldToFilter('personalization_id',$id);


			if(count($overview)>0)
			{
				$overview = $overview->load();
				foreach($overview as $overview)
				{
					$revenuePerVisit = $overview->getRevenues()/$totalVisit;
					$overview->setBounceRate($bounceRate);
					$overview->setVisitors($visitors);
					$overview->setConversions($conversion);
					$overview->setConversionRate($conversionRate);
					$overview->setRevenuePerVisit($revenuePerVisit);
					$overview->setUpdateTime(now());
					$overview->save();
				}
			}
			else{
				$overview = Mage::getModel('personalization/overview');
				$overview->setPersonalizationId($id);
				$overview->setBounceRate($bounceRate);
				$overview->setVisitors($visitors);
				$overview->setConversions($conversion);
				$overview->setConversionRate($conversionRate);
				$overview->setRevenuePerVisit(0);
				$overview->setCreatedTime(now());
				$overview->setUpdateTime(now());
				$overview->save();
			}
		}
		
	}
/*End set personalization overview by cron */
}
