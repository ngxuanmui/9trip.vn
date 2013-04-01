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
		
		
		
		$db->setQuery($query);
		
		$item = $db->loadObject();
		
		if ($db->getErrorMsg())
		{
			die($db->getErrorMsg());
		}
		
		return $item;
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