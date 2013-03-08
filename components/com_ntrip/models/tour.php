<?php

class NtripModelTour extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('tours');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('tours');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('tours', $item);
		
		return $otherItems;		
	}
}