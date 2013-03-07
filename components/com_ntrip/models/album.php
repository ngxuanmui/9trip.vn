<?php

class NtripModelAlbum extends AbsNtripModelItem
{
	public function getItem() 
	{
		$item = parent::getItem('albums');
		
		return $item;
	}
	
	public function getOtherImages() 
	{
		$otherImages = parent::getOtherImages('albums');
		
		return $otherImages;
	}
	
	public function getOtherItems() 
	{
		$item = $this->getItem();
		$otherItems = parent::getOtherItems('albums', $item);
		
		return $otherItems;		
	}
}