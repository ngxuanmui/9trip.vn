<?php

jimport('joomla.application.component.modellist');

abstract class AbsNtripModelItems extends JModelList
{
	protected function populateState($ordering = null, $direction = null)
	{
		// location id
		$id = JRequest::getInt('id', 0);
		$this->setState('filter.id', $id);
		
		$customField = JRequest::getString('custom_field', 0);
		$this->setState('filter.custom_field', $customField);
		
		$rating = JRequest::getString('rating');
		$this->setState('filter.rating', $rating);
		
		$price = JRequest::getString('price');
		$this->setState('filter.price', $price);
		
		$criteria = JRequest::getString('criteria');
		$this->setState('filter.criteria', $criteria);
	}

	protected function _query($type = 'hotels') 
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('a.*')->from('#__ntrip_' . $type . ' a');
		
		$id = $this->getState('filter.id');
		
		if ($id)
		{
			$query->where('(a.catid = ' . $id . ' 
							OR a.catid IN (SELECT id FROM #__categories WHERE parent_id = ' . $id . '))');
		}
		
		$customField = $this->getState('filter.custom_field');
		
		if ($customField)
		{
			$customField = explode(',', $customField);
			
			if (end($customField) === '')
				array_pop($customField);
			
			$customField = implode(',', $customField);
			
			if (strpos($customField, 'all') === false)
				$query->where('a.type IN (' . $customField .')');
			
		}
		
		$rating = $this->getState('filter.rating');
		
		if ($rating)
		{
			$rating = explode(',', $rating);
			
			if (strpos($rating, 'all') === false)
			{
				$tmp = array();
				
				foreach ($rating as $r)
				{
					$tmp[] = '(a.user_rank >= '.(int) $r . ' AND a.user_rank < ' . (int) ($r + 1) .')';
				}
				
				$tmp = implode(' OR ', $tmp);
				
				$query->where('('.$tmp.')');
			}
		}
		
		
		// Join over the users for the checked out user.
		$query->select('u.name AS author');
		$query->join('LEFT', '#__users AS u ON u.id=a.created_by');
		
		// join category
		$query->select('c.title AS category_title');
		$query->join('INNER', '#__categories c ON c.id = a.catid');
		
		$query->select('(SELECT COUNT(item_id) FROM #__ntrip_rating WHERE item_id = a.id AND item_type = "'.$type.'") AS count_rating');
		
		$query->order('a.id DESC');
		
//		$query->join('INNER', '#__category_location cl ON a.type = cl.category_id');
//		$query->where('cl.category_id = ');
		
		return $query;
	}
	
// 	protected function 
	
	protected function _customField($type = 'hotels')
	{
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		
		$id = $this->getState('filter.id');
		
		$query->select('*')
				->from('#__categories');				
		
		switch ($type)
		{
			case 'restaurants':
				$extension = 'com_ntrip.custom_field_restaurant';
				break;

			case 'tours':
				$extension = 'com_ntrip.custom_field_tour';
				break;

			case 'services':
				$extension = 'com_ntrip.custom_field_service';
				break;

			case 'shoppings':
				$extension = 'com_ntrip.custom_field_shopping';
				break;

			case 'relaxes':
				$extension = 'com_ntrip.custom_field_relax';
				break;
			
			case 'discovers':
				$extension = 'com_ntrip.custom_field_discover';
				break;

			default :
				$extension = 'com_ntrip.custom_field_hotel';
				break;

		}
		
		if ($type == 'restaurants' || $type == 'hotels')
		{
			$query->where('id IN (SELECT category_id FROM #__category_location WHERE locations = '.$id.')');
		}
		
		$query->where('extension = "'.$extension.'"');
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		return $rs;
	}
	
	public function getCategory()
	{
		$categoryId = JRequest::getInt('id');
		
		jimport('joomla.application.categories');
		
		$cat = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => ''));
		
		return $cat->get($categoryId);
	}
}