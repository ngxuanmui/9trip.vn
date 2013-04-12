<?php

jimport('joomla.application.component.modelitem');

abstract class AbsNtripModelItem extends JModelItem
{
	protected function getItem($type)
	{
		$id = JRequest::getInt('id', 0);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('a.*')
				->select('(SELECT COUNT(id) FROM #__ntrip_rating WHERE item_type = "'.$type.'" AND item_id = '.(int) $id.') AS count_rating')
				->from('#__ntrip_'. $type . ' a')
				->where('a.id = ' . $id);
		
		// join category
		$query->select('c.title AS category_title');
		$query->join('INNER', '#__categories c ON c.id = a.catid');
		
		// join gmap info
		// $query->select('g.*');
		// $query->join('LEFT', '#__ntrip_gmap_info g ON a.id = g.item_id AND g.item_type = "'.$type.'"');
		
		$db->setQuery($query);
		
		$item = $db->loadObject();
		
		if ($db->getErrorMsg())
		{
			die($db->getErrorMsg());
		}
		
		$item->gmap = false;
		
		$address = $item->address;
		
		if (is_object($item))
		{
			$category = $this->getCategory($item->catid);
			
			$address = $item->address . ', ' . $item->category_title;
			
			if ($category->parent_id > 0)
			{
				$parent = $category->getParent();
				$address .= ', ' . $parent->title;
			}
			
			$item->gmap = $this->getGmapInfo($item->id, $type, $address);
			
		}
		
		$item->address = $address;
		
		// var_dump($item);
		
		
		return $item;
	}
	
	public function getGmapInfo($itemId, $type, $address)
	{
		// update gmap info
		NtripFrontHelper::updateGmapInfo($itemId, $type, $address);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// join gmap info
		$query->select('g.*');
		$query->from('#__ntrip_gmap_info g');
		$query->where('g.item_id = '. (int) $itemId .' AND g.item_type = "'.$type.'"');
		
		$db->setQuery($query);
		$rec = $db->loadObject();
		
		return $rec;
	}
	
	/**
	 * func to get parent category of $id
	 */
	protected function getCategory($id)
	{
		jimport('joomla.application.categories');
		
		$category = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => '#__ntrip_hotels'));
		
		$cat = $category->get($id);
		
		return $cat;
	}
	
	protected function getOtherImages($type)
	{
		$item = $this->getItem($type);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')
				->from('#__ntrip_images')
				->where('item_type = "' . $type . '"')
				->where('item_id = ' . $item->id);
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		if ($db->getErrorMsg())
			die($db->getErrorMsg ());
		
		return $rs;
	}
	
	protected function getOtherItems($type, $item)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')
				->from('#__ntrip_'. $type)
				->where('id != ' . $item->id)
				->where('state = 1')
				->where('catid = ' . $item->catid);
				
		if (isset($item->type))
				$query->where('type = "' . $item->type . '"');
		
		$db->setQuery($query, 0, CFG_DEFAULT_NUMBER_OF_OTHER_ITEMS);
		$rs = $db->loadObjectList();
		
		if ($db->getErrorMsg())
			die($db->getErrorMsg ());
		
		return $rs;
	}
}