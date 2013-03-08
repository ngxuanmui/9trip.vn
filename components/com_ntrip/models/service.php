<?php

class NtripModelService extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('services');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('services');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('services', $item);
		
		return $otherItems;		
	}
}