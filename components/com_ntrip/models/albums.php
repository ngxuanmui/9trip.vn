<?php

// no direct access
defined('_JEXEC') or die;

class NtripModelAlbums extends AbsNtripModelItems
{
	public function getListQuery() {
		return $this->_query('albums');
	}
	
	public function getCustomField()
	{
		$rs = $this->_customField('albums');
		
		return $rs;
	}
	
	protected function populateState($ordering = null, $direction = null) 
	{
		parent::populateState($ordering, $direction);
		
		$limit = CFG_LIMIT_ALBUMS;
		
		$this->setState('list.limit', $limit);
		
		JRequest::setVar('limit', $limit);
	}
}