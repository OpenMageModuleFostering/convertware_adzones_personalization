<?php
class Convertware_Personalization_Block_Adminhtml_Personalization_Traffic extends Mage_Core_Block_Template
{
	public function getPersonalizationOverview()
	{
		$id = Mage::getSingleton('adminhtml/session')->getPersonalizationTrafficId();
		$personalizationTraffic = Mage::helper('personalization/system')->getPersonalizationOverview($id);
		return $personalizationTraffic;
	}
	public function getSiteTraffic()
	{
		$siteTraffic = Mage::helper('personalization/system')->getSiteTraffic();
		return $siteTraffic;
	}
	public function getApplyClass($type)
	{
		$personalizationTraffic = $this->getPersonalizationOverview();
		$siteTraffic = $this->getSiteTraffic();
		
		if($personalizationTraffic[$type] <= $siteTraffic[$type]) 
		{
			$class = "good";
		}
		else
		{
			$class = "bad";
		}
		if($type == "bounce_rate" && $class == "good")
		{
			$class = "bad";
		}
		elseif($type == "bounce_rate" && $class == "bad")
		{
			$class = "good";
		}
		return $class;
	}
	public function getApplyClassPer($type)
	{
		$personalizationTraffic = $this->getPersonalizationOverview();
		$siteTraffic = $this->getSiteTraffic();
		
		if($personalizationTraffic[$type] > $siteTraffic[$type]) 
		{
			$class = "good";
		}
		else
		{
			$class = "bad";
		}
		if($type == "bounce_rate" && $class == "good")
		{
			$class = "bad";
		}
		elseif($type == "bounce_rate" && $class == "bad")
		{
			$class = "good";
		}
		return $class;
	}

}
