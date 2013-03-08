<?php

class NtripModelShopping extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('shoppings');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('shoppings');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('shoppings', $item);
		
		return $otherItems;		
	}
}