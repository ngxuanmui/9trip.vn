<?php

class NtripModelHotel extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('hotels');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('hotels');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('hotels', $item);
		
		return $otherItems;		
	}
}