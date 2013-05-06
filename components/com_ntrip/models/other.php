<?php

class NtripModelOther extends JModelLegacy
{
	public function save($itemId, $itemType, $rating)
	{
		$db = JFactory::getDbo();
		
		// Insert to tbl rating
		$obj = new JObject();
		
		$obj->item_id	= $itemId;
		$obj->item_type = $itemType;
		$obj->rated		= $rating;
		$obj->created	= date('Y-m-d H:i:s');
		$obj->created_by = JFactory::getUser()->id;
		
		$result = $db->insertObject('#__ntrip_rating', $obj, 'id');
		
		if (!$result)
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
		
		// get rating
		$query = $db->getQuery(true);
		$query->select('COUNT(item_id) AS total_rating, SUM(rated) AS total_score')
				->from('#__ntrip_rating')
				->where('item_type = ' . $db->quote($itemType))
				->where('item_id = ' . (int) $itemId)
			;
		
		$db->setQuery($query);
		$rec = $db->loadObject();
		
		$totalRating 	= $rec->total_rating;
		$totalScore 	= $rec->total_score;
		
		if (!$totalRating)
			$totalRating = 1;
		
		$userRating = $totalScore / $totalRating;
		
		// Update table $itemType
		$query = $db->getQuery(true);
		$query->update('#__ntrip_' . $itemType)->set('user_rank = ' . $userRating)->where('id = ' . $itemId);
		
		$db->setQuery($query);
		$db->query();
		
		if ($db->getErrorMsg ())
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
		
		return true;
	}

	function getRating($itemId, $itemType) {
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);
		$query->select('COUNT(item_id) AS total_rating, SUM(rated) AS total_score')
				->from('#__ntrip_rating')
				->where('item_type = ' . $db->quote($itemType))
				->where('item_id = ' . (int) $itemId)
			;

		$db->setQuery($query);
		$rec = $db->loadObject();

		$totalRating 	= $rec->total_rating;
		$totalScore 	= $rec->total_score;

		if ($totalRating) {
			$userRating = round($totalScore / $totalRating);

			return array('total' => $totalRating, 'avg_star' => $userRating);
		} else {
			return false;
		}
	}

	public function saveLike($itemId, $itemType) 
	{
		$db = JFactory::getDbo();
		
		$obj = new stdClass();
		
		$obj->item_id	= $itemId;
		$obj->item_type = $itemType;
		$obj->like		= 1;
		$obj->created	= date('Y-m-d H:i:s');
		$obj->created_by = JFactory::getUser()->id;

		$result = $db->insertObject('#__ntrip_user_like', $obj, 'id');

		if (!$result)
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
		
		// Update table $itemType
		$query = $db->getQuery(true);
		$query->update('#__ntrip_' . $itemType)->set('user_like = user_like + 1')->where('id = ' . $itemId);
		
		$db->setQuery($query);
		$db->query();
		
		if ($db->getErrorMsg ())
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
		
		return true;
	}
	
	public function saveImage($itemId, $itemType, $image, $desc)
	{
		$db = JFactory::getDbo();
		
		// Insert to tbl rating
		$obj = new JObject();
		
		$obj->item_id	= $itemId;
		$obj->item_type = $itemType;
		$obj->images	= $image;
		$obj->description = $desc;
		$obj->created	= date('Y-m-d H:i:s');
		$obj->created_by = JFactory::getUser()->id;
		
		$result = $db->insertObject('#__ntrip_images', $obj, 'id');
		
		if (!$result)
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
		
		return true;
	}
	
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