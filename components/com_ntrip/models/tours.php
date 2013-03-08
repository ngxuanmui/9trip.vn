<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelTours extends AbsNtripModelItems
{
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
		
		$this->setState('list.limit', 5);
	}
}