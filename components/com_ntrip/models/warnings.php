<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelWarnings extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('warnings');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('warnings');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null) 
	{
		parent::populateState($ordering, $direction);
		
		$this->setState('list.limit', 5);
	}
}