<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelRelaxes extends AbsNtripModelItems
{
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
		
		$this->setState('list.limit', 5);
	}
}