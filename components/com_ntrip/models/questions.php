<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelQuestions extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('questions');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('questions');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null) 
	{
		parent::populateState($ordering, $direction);
		
		$this->setState('list.limit', 5);
	}
}