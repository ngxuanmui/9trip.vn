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
		
		// get gmap info
		$rows['gmap_info'] = $this->getGmapInfo($catid);
		
//		$rows['hotels']		= $this->_getLatestItems('hotels', $catid);
		$rows['discovers'] = $this->_getLatestItems('discovers', $catid);
		$rows['promotions'] = $this->_getLatestItems('promotions', $catid);
//		$rows['suggests']	= $this->_getLatestItems('suggests', $catid);
		$rows['warnings']	= $this->_getLatestItems('warnings', $catid);
		$rows['albums']	= $this->_getLatestItems('albums', $catid);
		$rows['questions']	= $this->_getLatestItems('questions', $catid);
		
// 		var_dump($rows);
				
		return $rows;
	}
	
	public function _getLatestItems($type = 'hotels', $catid = 0, $limit = 5)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('a.*')
				->from('#__ntrip_'.$type.' a')
				->select('u.name AS author')
				->join('LEFT', '#__users u ON a.created_by = u.id')
				->where('a.state = 1')
				->where('(a.catid = '. $catid.' OR a.catid IN (SELECT id FROM #__categories WHERE parent_id = '. $catid.'))')
				->order('a.id DESC');
		
		$db->setQuery($query, 0, $limit);
		$rs = $db->loadObjectList();
		
		return $rs;
	}
	
	public function getGmapInfo($itemId)
	{
		$category = $this->getCategory();
		
		// update gmap info
		NtripFrontHelper::updateGmapInfo($itemId, 'category', $category->title);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// join gmap info
		$query->select('g.*');
		$query->from('#__ntrip_gmap_info g');
		$query->where('g.item_id = '. (int) $itemId .' AND g.item_type = "category"');
		
		$db->setQuery($query);
		$rec = $db->loadObject();
		
		return $rec;
	}

	public function getCategory()
	{
		$catid = $this->getState('filter.catid', 0);
		
		jimport('joomla.application.categories');
		
		$category = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => '#__ntrip_hotels'));
		
		return $category->get($catid);
	}
	
	public function getFirstAlbum()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$catid = $this->getState('filter.catid', 0);
		
		$query->select('a.*')
				->from('#__ntrip_albums a')
				->select('u.name AS author')
				->join('LEFT', '#__users u ON a.created_by = u.id')
				->where('a.state = 1')
				->where('(a.catid = '. $catid.' OR a.catid IN (SELECT id FROM #__categories WHERE parent_id = '. $catid.'))')
				->order('a.id DESC');
		
		$db->setQuery($query);
		$row = $db->loadObject();
		
		$row->other_images = '';
		
		if (isset($row->id))
		{
			$query = $db->getQuery(true);

			$query->select('i.*')
					->from('#__ntrip_images i')
					->select('u.name AS author')
					->join('LEFT', '#__users u ON i.created_by = u.id')
					->where('i.item_type = "albums"')
					->where('i.item_id = ' . $row->id);

			$db->setQuery($query);
			$rs = $db->loadObjectList();

			if ($db->getErrorMsg())
				die($db->getErrorMsg ());

			$row->other_images = $rs;
			
			return $row;
		}
		
		return null;
	}
}