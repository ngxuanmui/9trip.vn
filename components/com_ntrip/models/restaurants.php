<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelRestaurants extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('restaurants');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('restaurants');
		
		return $rs;
	}
}