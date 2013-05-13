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
				->where('extension = "'.$extension.'"')
				->where('published = 1');
		
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
		
		$arrMultiLocation = LocaHelper::getLocationMultiType();
		
		$query->select('*')->from('#__ntrip_'.$type)->where('id = ' . $id);
		$db->setQuery($query);
		
		$rec = $db->loadObject();
		
		// if get multi type, must select from ntrip_item_type for multi value
		if (in_array($type, $arrMultiLocation))
		{
			$query = $db->getQuery(true);
			$query->select('type')->from('#__ntrip_item_type')->where('item_id = ' . $id);
			
			$db->setQuery($query);
			$rs = $db->loadResultArray();
			
			$rec->type = $rs;
		}
		
		return $rec;
	}
}