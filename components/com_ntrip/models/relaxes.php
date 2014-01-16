<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelRelaxes extends AbsNtripModelItems
{
	protected $fixInfoType = 'relaxes';
	
	public function getListQuery() {
		return $this->_query('relaxes');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('relaxes');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);
		
		$limit = CFG_LIMIT_RELAXES;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}