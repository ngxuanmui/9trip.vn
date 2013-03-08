<?php

class NtripModelQuestion extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('discovers');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('discovers');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('discovers', $item);
		
		return $otherItems;		
	}
}