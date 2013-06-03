<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelRestaurants extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('restaurants');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('restaurants');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);
	
		$limit = CFG_LIMIT_RESTAURANTS;
	
		$this->setState('list.limit', $limit);
	
		JRequest::setVar('limit', $limit);
	}
}