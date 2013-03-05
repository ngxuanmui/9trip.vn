<?php

class NtripModelCategory extends JModel
{
	public function populateState() 
	{
		$id = JRequest::getInt('id', 0);
		$this->setState('filter.catid', $id);
	}

	public function getItems()
	{
		$rows = array();
		
		$catid = $this->getState('filter.catid', 0);
		
//		$rows['hotels']		= $this->_getLatestItems('hotels', $catid);
		$rows['discovers'] = $this->_getLatestItems('discovers', $catid);
		$rows['promotions'] = $this->_getLatestItems('promotions', $catid);
//		$rows['suggests']	= $this->_getLatestItems('suggests', $catid);
		$rows['warnings']	= $this->_getLatestItems('warnings', $catid);
		$rows['albums']	= $this->_getLatestItems('albums', $catid);
				
		return $rows;
	}
	
	public function _getLatestItems($type = 'hotels', $catid = 0, $limit = 5)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')
				->from('#__ntrip_'.$type)
				->where('state = 1')
				->where('(catid = '. $catid.' OR catid IN (SELECT id FROM #__categories WHERE parent_id = '. $catid.'))')
				->order('id DESC');
		
		$db->setQuery($query, 0, $limit);
		$rs = $db->loadObjectList();
		
		return $rs;
	}
	
	public function getCategory()
	{
		$catid = $this->getState('filter.catid', 0);
		
		jimport('joomla.application.categories');
		
		$category = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => '#__ntrip_hotels'));
		
		return $category->get($catid);
	}
}