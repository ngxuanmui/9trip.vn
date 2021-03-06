<?php

class NtripFrontHelper 
{
	public static function itemsMenu($itemType)
	{
		$arr = array(
						'services'		=> 'Phương tiện Dịch vụ'	,
						'hotels'		=> 'Khách sạn'	, 
						'restaurants'	=> 'Ẩm thực Nhà hàng'	, 
						'tours'			=> 'Thưởng ngoạn'	, 
						'relaxes'		=> 'Giải trí'	, 
						'shoppings'		=> 'Mua sắm'	, 
						
				);
		
		$html  = '<ul class="tab-categories">';
		
		$idx = 0;
		
		$catid = JRequest::getInt('catid');
		
		foreach ($arr as $itemKey => $itemMenu)
		{
			$classMenu = ($idx % 2 == 0) ? '' : 'even';
			$classActive = ($itemType == $itemKey) ? ' active' : '';
			
			//$link = JRoute::_( NtripHelperRoute::getItemsRoute($itemKey) );
			$link = JRoute::_( NtripHelperRoute::getMainItemsRoute($itemKey, $catid) );
			
			if (JRequest::getInt('id'))
				$link .= '&id=' . JRequest::getInt ('id');
			
			$itemMenu = '<a href="' . $link . '">' . $itemMenu . '</a>';
			
			$style_1 = '';
			$style_2 = '';
			
// 			if ($itemKey == 'services')
// 				$style_1 = 'style="width: 78px;"';
			
// 			if ($itemKey == 'restaurants')
// 				$style_1 = 'style="width: 61px;"';
				
			$html .= '<li class="' . $classMenu . $classActive . '" '. $style_1.'>'.$itemMenu.'</li>';
			
			$idx ++;
		}
		
		$html .= '</ul>';
		
		return $html;
	}
	
	public static function customFieldMenu($fields, $field, $type = 'discovers')
	{
		$html  = '<ul class="tab-categories">';
		
		$idx = 0;
		
		foreach ($fields as $itemMenu)
		{
			$classMenu = ($idx % 2 == 0) ? '' : 'even';
			$classActive = ($field == $itemMenu->id) ? ' active' : '';
			
			$link = JRoute::_('index.php?option=com_ntrip&view='.$type.'&custom_field=' . $itemMenu->id);
			
			if (JRequest::getInt('id', 0))
				$link .= '&id=' . JRequest::getInt ('id', 0);
			
			$link .= '&Itemid=' . JRequest::getInt('Itemid', 0);
			
			$html .= '<li class="' . $classMenu . $classActive . '">
						<a href="'.$link.'">'
							. $itemMenu->title .
						'</a>
					</li>';
			
			$idx ++;
		}
		
		$html .= '</ul>';
		
		return $html;
	}
	
	public static function updateGmapInfo($itemId, $itemType, $address)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$coordinate = LocaHelper::getGmapCoordinates($address . ', Việt Nam');
		
		$obj = new stdClass();
		
		$obj->item_id = $itemId;
		$obj->item_type = $itemType;
		$obj->gmap_lat = $coordinate['lat'];
		$obj->gmap_long = $coordinate['long'];
		
		// delete before insert
		$query->delete('#__ntrip_gmap_info')
				->where('item_id = ' . $itemId)
				->where('item_type = ' . $db->quote($itemType))
		;
		
		$db->setQuery($query);
		$db->query();
		
		if ($db->getErrorMsg())
			die ($db->getErrorMsg());
		
		// insert
		$db->insertObject('#__ntrip_gmap_info', $obj);
		
		if ($db->getErrorMsg())
			die ($db->getErrorMsg());
		
		return true;
	}
	
	public static function checkUserPermissionOnItem($id, $table = '#__ntrip_hotels', $pk = 'id')
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$userId = JFactory::getUser()->id;
		
		$query->select('id')->from($table)->where($pk.' = '.$id)->where('created_by = ' . (int) $userId);
		
		$db->setQuery($query);
		$result = $db->loadResult();
		
		if ($result)
			return true;
		
		return false;
	}
	
	public static function checkUserLike($itemId, $itemType)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$userId = JFactory::getUser()->id;
		
		$query->select('id')
				->from('#__ntrip_user_like')
				->where('item_id = ' . (int) $itemId)
				->where('item_type = "' . $itemType . '"')
				->where('created_by = ' . $userId);
		
		$db->setQuery($query);
		$result = $db->loadResult();
		
		if ($result)
			return $result;
		
		return false;
	}
	
	public static function checkUserRating($itemId, $itemType)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
	
		$userId = JFactory::getUser()->id;
	
		$query->select('id')
				->from('#__ntrip_rating')
				->where('item_id = ' . (int) $itemId)
				->where('item_type = "' . $itemType . '"')
				->where('created_by = ' . $userId);
	
		$db->setQuery($query);
		$result = $db->loadResult();
	
		if ($result)
			return $result;
	
		return false;
	}
	
	public static function getAvatar($userId = 0)
	{
		if (!$userId)
			$userId = JFactory::getUser()->id;
		
		$userProfile = JUserHelper::getProfile($userId);
		
		if (isset($userProfile->profile['avatar']) && $userProfile->profile['avatar'] != '')
			$avatar = JURI::base() . 'images/avatars/' . str_replace('\\', '/', $userProfile->profile['avatar']);
		else
			$avatar = JURI::base() . 'images/no_avatar_thumb.jpg';
		
		return $avatar;
	}
	
	public function getMetaData($item, $field = 'name')
	{
		$app	= JFactory::getApplication();
		
		//get current location
		$loc = JFactory::getSession()->get('loca_location');
		
		$cat = JCategories::getInstance('ntrip', array('extension' => 'com_ntrip', 'table' => ''));
		
		$doc = JFactory::getDocument();
		
		$moreTitle = ' | Du lịch ' . $cat->get($item->catid)->title . ' | Mạng xã hội du lịch Loca';
		
		$doc->setTitle($item->$field . $moreTitle);
		
		if ($item->metakey)
			$doc->setMetaData ('Keywords', $item->metakey);
		
		if ($item->metadesc)
			$doc->setDescription ($item->metadesc);
	}
}
