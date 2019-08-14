<?php
class Convertware_Adzones_Block_Adzones extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head'))) 
		{
			$block->setCanLoadTinyMce(true);
		}
		return parent::_prepareLayout();
    }
    
     public function getAdzones()     
     { 
        if (!$this->hasData('adzones')) {
            $this->setData('adzones', Mage::registry('adzones'));
        }
        return $this->getData('adzones');
        
    }
	/*function for finding addZones content */
	public function getAdzonesContent($position)
	{
		$contentDisplay = array();
		
		$adzonesModel = Mage::helper('adzones')->getActiveAdzones($position);
		$stylepos = array("menu-top","menu-bottom","left-sidebar-top","left-sidebar-bottom","right-sidebar-top","right-sidebar-bottom","content-top","page-bottom","checkout","customer");

		$_stylepos = $stylepos[$position-1];
		foreach($adzonesModel as $adzonesModel)
		{
			$imageDisplay = "";
			$mode = $adzonesModel->getMode();
			
			$image = Mage::getModel('adzones/adzones')->load($adzonesModel->getAdzonesID());
			/* getting image content */
			if($image->getAdzoneImage())
			{
				$imageDisplay = '<div class="adzone-image-'.$_stylepos.'"><a href="'.$image->getAdzoneUrl().'"><img src="'.$image->getAdzoneImage().'" /></a></div>';
			}
			
			if($mode == "2") 
			{
				$contentModel = Mage::helper('adzones')->getAdzonesContent($adzonesModel->getAdzonesID());
				$contentIds = 	$contentModel->getItems();
				$contentId = array_rand($contentIds);	
				$blockContent = Mage::getModel('adzones/adzonesContent')->load($contentId);
				$contentDisplay[] = $blockContent->getContent();
							
			}
			else 
			{
				$contentModel = Mage::helper('adzones')->getAdzonesContent($adzonesModel->getAdzonesID());
				foreach($contentModel->getData() as $content) 
				{
					$contentDisplay[] = '<div class="adzone-content-'.$_stylepos.'">'.$content['content'].'</div>';
				}

			}
			if($imageDisplay)
			{
				$contentDisplay[] = '<div class="adzone-content-'.$_stylepos.'">'.$imageDisplay.'</div>';
			}
		}
		$currentUrl = Mage::helper("core/url")->getCurrentUrl();
		$preUrl = Mage::getSingleton('core/session')->getPrevUrl();
		
		if(!Mage::getSingleton('core/session')->getBlockBounce() && ($currentUrl != $preUrl))
		{	
			$this->updateBounceCounter();
			Mage::getSingleton('core/session')->setBlockBounce(true);
		}
		Mage::getSingleton('core/session')->setPrevUrl($currentUrl);
		return $contentDisplay;
	}
	/*End function for finding addZones content */
	/* function for set bounce count for active personalization */
	public function updateBounceCounter()
	{
		
		if(isset($_COOKIE['bouncepersonalization'])  && $_COOKIE['bouncepersonalization'] !='' && $_COOKIE['bouncepersonalization']!=null)
		{
			$updatedBounce = array();
			$bouncePersonalization = $_COOKIE['bouncepersonalization'];
			$bouncePersonalization = explode(',',$bouncePersonalization);
			foreach($bouncePersonalization as $personalization)
			{
				$logset = 1;
				if($_COOKIE['updatedbouncepersonalization'])
				{
					$preset = explode(",",$_COOKIE['updatedbouncepersonalization']);
					if(in_array($personalization, $preset))
					{
						$logset = 0;
					}
					
				}
				if($logset)
				{
					$updatedBounce[] = $personalization;
					$personalizationModel = Mage::getModel('personalization/personalizationVisit')->getCollection()->addFieldToFilter('personalization_id',$personalization);
					$personalizationModel = $personalizationModel->load();
					if(count($personalizationModel)>0)
					{
						foreach($personalizationModel as $personalizationBounce)
						{
	
							$bounceCount = $personalizationBounce->getBounceCount();
							
							if($bounceCount>0)
							{	
								$bounceCount--;
								$personalizationBounce->setBounceCount($bounceCount);
								$personalizationBounce->setUpdateTime(now());
								$personalizationBounce->save();
								
							}
						}
						
					}
					
				}
			}
			
			if(count($updatedBounce)>0)
			{
				$updatedBounce = implode(",",$updatedBounce);
				setcookie("updatedbouncepersonalization",$updatedBounce);
			}
		}else { return;}
	} 
	/*End function for set bounce count for active personalization */
}
