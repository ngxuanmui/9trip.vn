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
		
		$loc = JRequest::getInt('catid');
		
		if (!$loc)
			$loc = JFactory::getSession()->get('loca_location');
		
		$this->setState('filter.location', $loc);
		
		$value = JRequest::getUInt('limit', 10);
		$this->setState('list.limit', $value);
		
		$value = JRequest::getUInt('limitstart', 0);
		$this->setState('list.start', $value);
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
		
		// filter by rating
		$rating = $this->getState('filter.rating');
		
		if ($rating)
		{
			if (strpos($rating, 'all') === false)
			{
				$rating = explode(',', $rating);
				
				if (end($rating) === '')
					array_pop($rating);
				
				$tmp = array();
				
				foreach ($rating as $r)
				{
					$tmp[] = '(a.user_rank >= '.(int) $r . ' AND a.user_rank <= ' . (int) ($r + 1) .')';
				}
				
				$tmp = implode(' OR ', $tmp);
				
				$query->where('('.$tmp.')');
			}
		}
		
		// filter by price
		$price = $this->getState('filter.price');
		
		if ($price)
		{
			if (strpos($price, 'all') === false)
			{
				$price = explode(',', $price);
			
				if (end($price) === '')
					array_pop($price);
			
				$tmp = array();
				
				$arrPrice = array(
									1 => array(0, 200000),
									2 => array(200000, 500000),
									3 => array(500000, 1000000),
									4 => array(1000000, 2000000),
									5 => array(2000000, 0)
								);
			
				foreach ($price as $p)
				{
					if ($arrPrice[$p][1] > 0)
						$tmp[] = '(a.price_from >= ' . (int) $arrPrice[$p][0] . ' AND (a.price_to <= ' . (int) $arrPrice[$p][1] . ' OR a.price_to = 0))';
					else
						$tmp[] = '(a.price_from >= ' . (int) $arrPrice[$p][0] . ')';
				}
			
				$tmp = implode(' OR ', $tmp);
			
				$query->where('('.$tmp.')');
			}
		}
		
		// filer by hotel_class
		$criteria = $this->getState('filter.criteria');
		
		if ($criteria)
		{
			if (strpos($criteria, 'all') === false)
			{
				$criteria = explode(',', $criteria);
					
				if (end($criteria) === '')
					array_pop($criteria);
					
				$tmp = array();
					
				foreach ($criteria as $c)
				{
					$tmp[] = '(a.hotel_class >= '.(int) $c . ' AND a.hotel_class <= ' . (int) ($c + 1) .')';
				}
					
				$tmp = implode(' OR ', $tmp);
					
				$query->where('('.$tmp.')');
			}
		}
		
		// Join over the users for the checked out user.
		$query->select('u.name AS author');
		$query->join('LEFT', '#__users AS u ON u.id=a.created_by');
		
		// Filter by location
		$loc = $this->getState('filter.location', 0);
		
		if ($loc)
		{
			$query->where('a.catid = ' . (int) $loc);
		}
		
		// join category
		$query->select('c.title AS category_title');
		$query->join('INNER', '#__categories c ON c.id = a.catid');
		
		$query->select('(SELECT COUNT(item_id) FROM #__ntrip_rating WHERE item_id = a.id AND item_type = "'.$type.'") AS count_rating');
		
		// check state
		$query->where('a.state = 1');
		
		// order
		$query->order('a.id DESC');
		
//		$query->join('INNER', '#__category_location cl ON a.type = cl.category_id');
//		$query->where('cl.category_id = ');

// 		echo nl2br(str_replace('#__', 'jos_', $query));
		
		return $query;
	}
	
	public function getItems()
	{
		$items = parent::getItems();
		
		foreach ($items as & $item)
		{
			$item->thumb = '';
			
			if (!empty($item->images))
			{
				$tmp = explode('/', $item->images);

				$image_name = end($tmp);

				$imagePath = JPATH_ROOT . DS . 'images';

				// shift an el (image folder) in $tmp
				array_shift($tmp);

				// remove last el (file name) in $tmp
				array_pop($tmp);

				$image_path = $imagePath . DS . implode('/', $tmp);

				$thumb_path = $imagePath . '/thumbs/' . implode('/', $tmp);

				$thumb_image_path = $thumb_path . DS . $image_name;

				@JFolder::create($thumb_path);

				// create thumb if not exist
				if (!file_exists($thumb_image_path) && file_exists($image_path . DS . $image_name))
					LocaHelper::thumbnail($image_path, $thumb_path, $image_name, $thumbW, $thumbH);

				$item->thumb = JURI::root() . 'images/thumbs/' . implode('/', $tmp) . '/' . 't-' . $thumbW . 'x' . $thumbH . '-' . $image_name;
			}
		}
		
		return $items;
	}


// 	protected function 
	
	protected function _customField($type = 'hotels')
	{
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		
		$id = $this->getState('filter.location');
		
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
		$query->where('published = 1');
		$query->order('lft ASC, id DESC');
		
//		echo $query;
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		return $rs;
	}
	
	public function getCategory()
	{
		$categoryId = $this->getState('filter.location', 0);;
		
// 		var_dump($categoryId);
		
		jimport('joomla.application.categories');
		
		$cat = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => ''));
		
		return $cat->get($categoryId);
	}
}