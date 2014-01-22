<?php

jimport('joomla.application.component.modelitem');

abstract class AbsNtripModelItem extends JModelItem
{
	public $itemType;
	protected $contentImageWidth = 600;
	
	public function getItem($type = '', $updateHits = true)
	{
		if (!$type)
			$type = $this->itemType;
		
		$id = JRequest::getInt('id', 0);
		
		// Update hits
		if ($updateHits)
			$this->updateHits($id, $type);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('a.*')
				->select('(SELECT COUNT(id) FROM #__ntrip_rating WHERE item_type = "'.$type.'" AND item_id = '.(int) $id.') AS count_rating')
				->select('(SELECT COUNT(id) FROM #__ntrip_comments WHERE item_type = "'.$type.'" AND item_id = '.(int) $id.') AS count_comment')
				->from('#__ntrip_'. $type . ' a')
				->where('a.id = ' . $id)
				->where('a.state = 1');
		
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
		$address = '';
		
		if (isset($item->address))
			$address = $item->address;
		
		if (is_object($item))
		{
			$category = $this->getCategory($item->catid);
			
			if ($address)
			{
				$address = $item->address . ', ' . $item->category_title;
					
				// 			if ($category->parent_id > 0)
					// 			{
					// 				$parent = $category->getParent();
					// 				$address .= ', ' . $parent->title;
					// 			}
					
				$item->gmap = $this->getGmapInfo($item->id, $type, $address);
				
				$item->gmap_lat = $item->gmap->gmap_lat;
				$item->gmap_long = $item->gmap->gmap_long;
			}
		}
		
		if (!empty($item->description))
		{
			$item->description = $this->_prepareText($item->description);
		}
		
// 		$item->address = $address;
		
		// var_dump($item);
		
		
		return $item;
	}
	
	protected function _prepareText($text)
	{
		// loop all img tags
		preg_match_all('/<img [^>]*src\s*=\s*"(.*?)"[^>]*\/>/i', $text, $matches);
		
		for ($i = 0; $i < count($matches[0]); $i++)
		{
			$img = $matches[0][$i];
			$src = $matches[1][$i];
			
// 			$new_src = $this->_resizer->resize($src);

			$tmp = explode('/', $src);
			
			$image_name = end($tmp);
			
			$imagePath = JPATH_ROOT . DS . 'cache/images';
			
			// shift an el (image folder) in $tmp
			array_shift($tmp);
			
			// remove last el (file name) in $tmp
			array_pop($tmp);
			
			$image_path = JPATH_ROOT . DS . 'images' . DS . implode('/', $tmp);
			
			$thumb_path = JPATH_ROOT . '/cache/images/' . implode('/', $tmp);
			
			JFolder::create($thumb_path);
			
			//$thumbName = $thumb_path . '/' . $image_name;
				
			$thumbW = $this->contentImageWidth;
			$thumbH = 0;
				
			$thumb_image_path = $thumb_path . DS . $image_name;
			
// 			var_dump(file_exists($image_path . DS . $image_name), $image_path . DS . $image_name, $thumb_image_path); die;
			
			// create thumb if not exist
			if (!file_exists($thumb_image_path) && file_exists($image_path . DS . $image_name))
				LocaHelper::thumbnail($image_path, $thumb_path, $image_name, $thumbW, 0);
			
			$new_src = JURI::root() . 'cache/images/' . implode('/', $tmp) . '/' .'t-' . $thumbW . 'x' . $thumbH . '-' . $image_name;
			
			// has new src to replace?
			if ($new_src)
			{
				$new_img =  preg_replace('/ src\s*=\s*"(.*?)"/i', ' src="'.$new_src.'"', $img);

				// replace with new width and height
// 				list($new_width, $new_height) = @getimagesize($new_src);
				
// 				$new_img = $this->_replaceOrAddImgAttribute($new_img, 'width', $new_width);
// 				$new_img = $this->_replaceOrAddImgAttribute($new_img, 'height', $new_height);

				$text = str_replace($img, $new_img, $text);
			}
		}

		return $text;
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
	
	public function getOtherImages($type = '')
	{
		if (!$type)
			$type = $this->itemType;
		
		$item = $this->getItem($type, false);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')
				->from('#__ntrip_images')
				->where('item_type = "' . $type . '"')
				->where('item_id = ' . (int) $item->id)
				->order('id DESC');
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		if ($db->getErrorMsg())
			die($db->getErrorMsg ());
		
		return $rs;
	}
	
	public function getOtherItems($type = '', $item = null)
	{
		if (!$type)
			$type = $this->itemType;
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		if (!is_object($item))
			$item = $this->getItem($type, false);
		
		$query->select('*')
				->from('#__ntrip_'. $type)
				->where('id != ' . (int) $item->id)
				->where('state = 1')
				->where('catid = ' . (int) $item->catid);
				
		if (isset($item->type))
				$query->where('type = "' . $item->type . '"');
		
		$query->order('id DESC');
		
		$db->setQuery($query, 0, CFG_DEFAULT_NUMBER_OF_OTHER_ITEMS);
		$rs = $db->loadObjectList();
		
		if ($db->getErrorMsg())
			die($db->getErrorMsg ());
		
		return $rs;
	}
	
	protected function updateHits($itemId = 0, $itemType = '')
	{
		if (!$itemType)
			$itemType = $this->itemType;
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->update('#__ntrip_' . $itemType)->set('hits = hits + 1')->where('id = ' . $itemId);
		
		$db->setQuery($query);
		
		$db->query();
		
		if ($db->getErrorMsg())
			die ($db->getErrorMsg());
	}
}