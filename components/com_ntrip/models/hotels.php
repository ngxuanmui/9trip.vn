<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelHotels extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('hotels');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('hotels');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null) 
	{
		parent::populateState($ordering, $direction);
		
		$this->setState('list.limit', 5);
	}
}