<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelPromotions extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('promotions');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('promotions');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null) 
	{
		parent::populateState($ordering, $direction);
		
		$this->setState('list.limit', 5);
	}
}