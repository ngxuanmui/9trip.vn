<?php

class NtripModelRelax extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('relaxes');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('relaxes');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('relaxes', $item);
		
		return $otherItems;		
	}
}