<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelTours extends AbsNtripModelItems
{
	protected $fixInfoType = 'tours';
	
	public function getListQuery() {
		return $this->_query('tours');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('tours');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);
	
		$limit = CFG_LIMIT_TOURS;
	
		$this->setState('list.limit', $limit);
	
		JRequest::setVar('limit', $limit);
	}
}