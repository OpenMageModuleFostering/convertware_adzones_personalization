<?php

class Convertware_Adzones_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getActiveAdzones($position)
	{
		$store_id = $this->getStore();
		$customerGroupId = $this->getCustomerGroup();
		//$adzonesModel = Mage::getModel('adzones/adzones')->getCollection()->addFieldToFilter('block_position',$position)->setOrder('sort_order', 'ASC')->addFieldToFilter('status','1');
		
		$adzonesModel = $this->getActivePersonalizationBlock();
		$adzonesModel = $adzonesModel->addFieldToFilter('block_position',$position)->setOrder('sort_order', 'ASC')->addFieldToFilter('status','1');
			
		$adzonesModel = $this->getCurrentActiveRoute($adzonesModel);
/*get Block according to store */
		$adzonesModel->addFieldToFilter('store_id',array(
				array('attribute'=>'store_id',array('finset'=>$store_id)),
				array('attribute'=>'store_id',array('finset'=>'0')),           
			));
/*end get Block according to store */
/*get Block according to customer group*/

		$adzonesModel->addFieldToFilter('customer_group',array('finset'=>$customerGroupId));
/*end get Block according to customer group*/
		$adzonesModel = $this->getDisplayBlockDate($adzonesModel);
		$adzonesModel = $this->getScheduleTime($adzonesModel);
		
		$adzonesModel = $adzonesModel->load();
		return $adzonesModel;
	}
/* function for finding add zones content */
	public function getAdzonesContent($adzonesId)
	{
		$contentModel = Mage::getModel('adzones/adzonesContent')->getCollection()->addFieldToFilter('adzones_id',$adzonesId)->setOrder('content_sort_order', 'ASC');
		return $contentModel;
	}
/* function for finding current store id*/
	public function getStore()
	{
		$store = Mage::app()->getStore(); // return current store details
		$store_id = Mage::app()->getStore()->getId();
		return $store_id;
	}
/* function for finding current customer group */
	public function getCustomerGroup()
	{
		$groupId = 0;
		$login = Mage::getSingleton( 'customer/session' )->isLoggedIn(); //Check if User is Logged In
		if($login)
		{
			$groupId = Mage::getSingleton('customer/session')->getCustomerGroupId();
			
		}
		return $groupId;
	}
/* finding adzones display dates */
	public function getDisplayBlockDate($adzonesModel)
	{
		foreach($adzonesModel->getItems() as $key => $block)
		{
			
			$startDate = $block['display_from'];
			$endDate = $block['display_to'];
			if($startDate && $startDate)
			{
				if(!($startDate <= now() && now() <= $endDate))
				{
					$adzonesModel->removeItemByKey($key);
				}
				
			}
		}
		return $adzonesModel;
	}
/* finding adzones display time */
	public function getScheduleTime($adzonesModel)
	{
		foreach($adzonesModel->getItems() as $key => $block)
		{
			$scheduleDay = $block['show_pattern'];
			$currentTime =  date('H:i:s');
			$weekday = date('N', strtotime(now()));
			if(!($scheduleDay == 0 || $scheduleDay == $weekday))
			{
				$adzonesModel->removeItemByKey($key);
			}
			else
			{
				$startTime 	 = $block['show_pattern_from'];
				$endTime 	 = $block['show_pattern_to'];
				
				if($startTime && $endTime)
				{
					$startTime 	 = date('H:i:s',strtotime($startTime));
					$endTime 	 = date('H:i:s',strtotime($endTime));
					if(!($startTime <= $currentTime && $currentTime <= $endTime))
					{
						$adzonesModel->removeItemByKey($key);
					}
				}
			}
		}
		return $adzonesModel;
	}
/*  finding the adzones which shown in cms pages ,product and category pages */
	public function getCurrentActiveRoute($adzonesModel)
	{
		$routerName = Mage::app()->getRequest()->getRouteName();
		$controllerName = Mage::app()->getRequest()->getControllerName();
		if($routerName == "cms")
		{
			$adzonesModel->addFieldToFilter('cms_page','1');
		}
		else if($routerName == "catalog")
		{
			if($controllerName == "product")
			{
				$_product = Mage::registry('current_product')->getId();
				$adzonesModel->addFieldToFilter('product_id',array('finset'=>$_product));
			}
			else if($controllerName == "category")
			{
				$_category = Mage::registry('current_category')->getId();
				$categoryModel = Mage::getModel('catalog/category')->load($_category);
				$allCategory = $categoryModel->getPath();
				$allCategory = explode("/",$allCategory);
				foreach($adzonesModel->getItems() as $key => $block)
				{
					$blockCategory = explode(",",$block['category_id']);
					if($block['show_in_subcategory']==1)
					{
						
						$findCat = array_intersect($allCategory, $blockCategory);
						if(!$findCat)
						{
							$adzonesModel->removeItemByKey($key);
						}
					}
					else{
						if(!in_array($_category,$blockCategory))
						{
							$adzonesModel->removeItemByKey($key);
						}	
					}
				}
			}
		}
		return $adzonesModel;	
	}
/* get all active personalization */
	public function getActivePersonalizationBlock()
	{
		$activePersonlization = Mage::getSingleton('core/session')->getLogPersonalization();
		$activePersonlization = explode(',',$activePersonlization);
		$adzonesIds = "";
		foreach($activePersonlization as $id)
		{
			$personalizationModel = Mage::getModel('personalization/personalization')->load($id);
			$adzonesIds = $adzonesIds.",".$personalizationModel->getAdzonesIds();
			
		}
		$adzonesIds = explode(",",$adzonesIds);
		$adzonesIds = array_unique($adzonesIds);
		
		$adzonesModel = Mage::getModel('adzones/adzones')->getCollection()->addFieldToFilter('adzones_id',array('in'=>$adzonesIds));
		return $adzonesModel;
		
	}
}
