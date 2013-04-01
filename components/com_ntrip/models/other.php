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

	public function saveLike($itemId, $itemType) {
		$db = JFactory::getDbo();
		$obj->item_id	= $itemId;
		$obj->item_type = $itemType;
		$obj->like		= 1;
		$obj->created	= date('Y-m-d H:i:s');
		$obj->created_by = JFactory::getUser()->id;

		$result = $db->insertObject('#__ntrip_user_like', $obj, 'id');

		if (!$result)
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
	}
}