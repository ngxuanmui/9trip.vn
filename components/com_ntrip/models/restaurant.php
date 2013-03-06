<?php

class NtripModelRestaurant extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('restaurants');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('restaurants');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('restaurants', $item);
		
		return $otherItems;		
	}
}