<?php

class NtripModelOther extends JModel
{
	public function getLocations()
	{
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		
		$locationId = JRequest::getInt('location');
		$extension = JRequest::getString('extension');
		
		$arrExt = LocaHelper::getExtensionLocation();
		
		$query->select('*')
				->from('#__categories')
				->where('extension = "'.$extension.'"');
		
		if (in_array($extension, $arrExt))
			$query->where('id IN (SELECT category_id FROM #__category_location WHERE locations = '.$locationId.')');
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		return $rs;
	}
	
	public function getItem()
	{
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		
		$id = JRequest::getInt('item_id');
		$type = JRequest::getString('type');
		
		$query->select('*')->from('#__ntrip_'.$type)->where('id = ' . $id);
		$db->setQuery($query);
		
		$rec = $db->loadObject();
		
		return $rec;
	}
}