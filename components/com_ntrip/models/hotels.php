<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelHotels extends AbsNtripModelItems
{
	protected $thumbWidth = 200;
	protected $thumbHeight = 0;
	
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
		
		$limit = CFG_LIMIT_HOTELS;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}