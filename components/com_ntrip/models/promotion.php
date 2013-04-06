<?php

class NtripModelPromotion extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('promotions');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('promotions');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('promotions', $item);
		
		return $otherItems;		
	}
}