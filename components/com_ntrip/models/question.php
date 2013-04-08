<?php

class NtripModelQuestion extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('questions');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('questions');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('questions', $item);
		
		return $otherItems;		
	}
}