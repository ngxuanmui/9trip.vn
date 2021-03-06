<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelHotels extends AbsNtripModelItems
{
	protected $thumbWidth = 150;
	protected $thumbHeight = 0;
	protected $fixInfoType = 'hotels';
	protected $getFeatured = true;
	
	public function getListQuery() {
		return $this->_query('hotels', $featured = 0);
	}
	
	public function getFeaturedItems()
	{
		$res = $this->_getFeaturedItems('hotels');
		
		return $res;
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