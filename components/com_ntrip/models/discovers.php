<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelDiscovers extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('discovers');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('discovers');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null) 
	{
		parent::populateState($ordering, $direction);
		
		$limit = CFG_LIMIT_DISCOVERS;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}