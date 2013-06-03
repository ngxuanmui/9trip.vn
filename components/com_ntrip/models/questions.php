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
		
		$limit = CFG_LIMIT_QUESTIONS;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}