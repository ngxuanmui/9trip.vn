<?php

class Ntrip_CommentModelComment extends JModelLegacy
{
	public function getListComments($itemId, $itemType)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('c.*')
				->from('#__ntrip_comments c')
				->select('u.username')
				->join('LEFT', '#__users u ON c.created_by = u.id')
				->where('c.item_type = ' . $db->quote($itemType))
				->where('c.item_id = ' . $itemId)
				->where('c.parent_id = 0')
				->order('c.id ASC')
			;
		
//		echo str_replace('#__', 'jos_', $query);
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		// load sub comment
		foreach ($rs as & $comment)
		{
			$query = $db->getQuery(true);
		
			$query->select('c.*')
					->from('#__ntrip_comments c')
					->select('u.username')
					->join('LEFT', '#__users u ON c.created_by = u.id')
					->where('c.item_type = ' . $db->quote($itemType))
					->where('c.item_id = ' . $itemId)
					->where('c.parent_id = ' . $comment->id)
					->order('c.id ASC')
				;
			
			$db->setQuery($query);
			$comment->subComments = $db->loadObjectList();
		}
		
		return $rs;
	}
	
	public function isItemOwner($itemId, $itemType)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('id, created_by')->from('#__ntrip_' . $itemType)->where('id = ' . $itemId);
		$db->setQuery($query);
		
		$item = $db->loadObject();
		
		if ($item->created_by == JFactory::getUser()->id)
			return true;
		
		return false;
	}

	public function save($itemId, $itemType, $parentId, $content)
	{
		$obj = new JObject();
		
		$obj->parent_id = $parentId;
		$obj->item_id	= $itemId;
		$obj->item_type = $itemType;
		$obj->content	= $content;
		$obj->state		= 1;
		$obj->created	= date('Y-m-d H:i:s');
		$obj->created_by = JFactory::getUser()->id;
		
		$db = JFactory::getDbo();
		$result = $db->insertObject('#__ntrip_comments', $obj, 'id');
		
		if (!$result)
			return array('error' => 1, 'msg' => $db->getErrorMsg ());
		
		return $result;
	}
}