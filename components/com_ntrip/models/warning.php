<?php

class NtripModelWarning extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('warnings');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('warnings');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('warnings', $item);
		
		return $otherItems;		
	}
}