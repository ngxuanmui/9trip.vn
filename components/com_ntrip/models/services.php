<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelServices extends AbsNtripModelItems
{
	protected $fixInfoType = 'services';
	
	public function getListQuery() {
		return $this->_query('services');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('services');
		
		return $rs;
	}
	
protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);
		
		$limit = CFG_LIMIT_SERVICES;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}