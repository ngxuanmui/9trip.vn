<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelShoppings extends AbsNtripModelItems
{
	protected $fixInfoType = 'shoppings';
	
	public function getListQuery() {
		return $this->_query('shoppings');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('shoppings');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);
		
		$limit = CFG_LIMIT_SHOPPINGS;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}