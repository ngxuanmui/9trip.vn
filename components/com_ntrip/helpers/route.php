<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.application.categories');

/**
 * Content Component Route Helper
 *
 * @static
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @since 1.5
 */
abstract class NtripHelperRoute
{
	protected static $lookup;

	/**
	 * @param	int	The route of the content item
	 */
	public static function getItemRoute($id, $view, $catid = 0, $customField = 0)
	{
		$needles = array();
		
		if ($view == 'discover')
		{
			$needles = array(
				'discovers' => array($catid, 'custom_field' => array('custom_field' => $customField, 'catid' => $catid))
			);
		}
		
		if ($view == 'album')
			$needles['albums'] = array((int) $catid);
		
		if ($view == 'warning')
			$needles['warnings'] = array((int) $catid);
		
		if ($view == 'question')
			$needles['questions'] = array((int) $catid);
		
		if ($view == 'promotion')
			$needles['promotions'] = array((int) $catid);
		
		//Create the link
		$link = 'index.php?option=com_ntrip&view='.$view.'&id='. $id;
		
		if ((int)$catid > 1)
		{
			$categories = JCategories::getInstance('Ntrip');
			$category = $categories->get((int)$catid);
			if($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		}
		elseif ($item = self::_findItem()) {
			$link .= '&Itemid='.$item;
		}
		
// 		var_dump($link);

// 		$db = JFactory::getDbo();
		
// 		$query = $db->getQuery(true);
		
// 		$query->select('*')->from('#__menu')->where('menutype = "main-top-menu"');
// 		$db->setQuery($query);
		
// 		$menus = $db->loadObjectList();
		
// 		foreach ($menus as $menu)
// 		{
// 			if (strpos($menu->link, $view) !== false)
// 			{
// 				$link .= '&Itemid=' . $menu->id;
// 				break;
// 			}
// 		}

		return $link;
	}
	
	/**
	 * @param	int	The route of the newsfeed
	 */
	public static function getOtherRoute($view = 'feedback', $tmpl = '', $id = 0)
	{
		$needles = array(
			$view => array($id)
		);
		
		//Create the link
		$link = 'index.php?option=com_ntrip&view='.$view;
		
		if ($tmpl)
			$link .= '&tmpl=' . $tmpl;
		
// 		if ($id)
// 			$link .= '&id=' . $id;
		
		if ($item = self::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		}
		elseif ($item = self::_findItem()) {
			$link .= '&Itemid='.$item;
		}
		
// 		echo $link;
		
		return $link;
	}
	
	/**
	 * @param	int	The route of the newsfeed
	 */
	public static function getMainItemsRoute($view = 'hotels', $catid = 0, $customField = 0)
	{
		$needles = array(
			$view => array($catid, 'custom_field' => array('custom_field' => $customField, 'catid' => $catid))
		);
		
		//Create the link
		$link = 'index.php?option=com_ntrip&view='.$view;
	
		if ($catid)
			$link .= '&catid=' . $catid;
		
		if ($customField)
			$link .= '&custom_field=' . $customField;
		
// 		echo $link; die;
	
		if ($item = self::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		}
		
// 		if ($view == 'discovers')
// 			var_dump($link);
		
		return $link;
	}
	
	public static function getFormRoute($view, $task = '', $itemId = 0, $id = 0)
	{
		$needles = array(
			'user_man_service'  => array(),
		);
		
		if (!$task)
			$task = $view . '.add';
		else
			$task = $view. '.' . $task;
		
		$link = 'index.php?option=com_ntrip&view='.$view.'&task='.$task;
		
		if ($item = self::_findItem()) {
			$link .= '&Itemid='.$item;
		}
		
		if ($id)
			$link .= '&id=' . $id;
		
		return $link;
	}

	public static function getItemsRoute($view = 'hotels', $customField = false)
	{
		$link = 'index.php?option=com_ntrip&view=' . $view;
// 		var_dump($link.'}}}');
		
		if ($customField)
			$link .= '&custom_field=' . $customField;
		
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		$query->select('*')->from('#__menu')->where('menutype = "menu-main-items"');
		$db->setQuery($query);
		
		$menus = $db->loadObjectList();
				
		foreach ($menus as $menu)
		{
// 			var_dump($menu->id, $menu->link, 'custom_field=' . $customField, strpos($menu->link, 'custom_field=' . $customField));
			
			if (
					(strpos($menu->link, $view) !== false && !$customField)
					||
					(strpos($menu->link, $view) !== false && strpos($menu->link, 'custom_field=' . $customField) !== false && $customField)
				)
			{
				$link .= '&Itemid=' . $menu->id;
				break;
			}
		}
		
		return $link;
	}

	public static function getCategoryRoute($catid)
	{
		if ($catid instanceof JCategoryNode)
		{
			$id = $catid->id;
			$category = $catid;
		}
		else
		{
			$id = (int) $catid;
			$category = JCategories::getInstance('Ntrip')->get($id);
		}

		if($id < 1)
		{
			$link = '';
		}
		else
		{
			$needles = array(
				'category' => array($id)
			);

			if ($item = self::_findItem($needles))
			{
				$link = 'index.php?Itemid='.$item;
			}
			else
			{
				//Create the link
				$link = 'index.php?option=com_ntrip&view=category&id='.$id;
				if($category)
				{
					$catids = array_reverse($category->getPath());
					$needles = array(
						'category' => $catids,
						'categories' => $catids
					);
					if ($item = self::_findItem($needles)) {
						$link .= '&Itemid='.$item;
					}
					elseif ($item = self::_findItem()) {
						$link .= '&Itemid='.$item;
					}
				}
			}
		}

		return $link;
	}

	protected static function _findItem($needles = null)
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');

		// Prepare the reverse lookup array.
		if (self::$lookup === null)
		{
			self::$lookup = array();

			$component	= JComponentHelper::getComponent('com_ntrip');
			$items		= $menus->getItems('component_id', $component->id);
			
			foreach ($items as $item)
			{
				$intergratedId = null;
				
				if (isset($item->query) && isset($item->query['custom_field']))
				{
					if (!isset(self::$lookup['custom_field'])) {
						self::$lookup['custom_field'] = array();
					}
					
					if (isset($item->query['custom_field']))
					{
						$customFieldId = $item->query['custom_field'];
						$catId = (!empty($item->query['catid'])) ? $item->query['catid'] : 0;
						self::$lookup['custom-field'][$catId][$customFieldId] = $item->id;
					}
				}
				
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
					
					if (!isset(self::$lookup[$view])) {
						self::$lookup[$view] = array();
					}
					if (isset($item->query['id'])) {
						self::$lookup[$view][$item->query['id']] = $item->id;
					}
					elseif (isset($item->query['catid'])) {
						self::$lookup[$view][$item->query['catid']] = $item->id;
					}
				}
			}
		}
		
// 		var_dump (self::$lookup['custom-field']['18'], $needles['discovers']);
		
		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if ($view == 'discovers')
				{
					if (isset(self::$lookup['custom_field']))
					{
						
						if (!empty($view['custom_field']))
						{
							$customField = $needles[$view]['custom_field'];
							
							$catId = isset($customField['catid']) ? $customField['catid'] : 0;
							$customFieldId = isset($customField['custom_field']) ? $customField['custom_field'] : 0;
							
							if (isset(self::$lookup['custom-field'][$catId][$customFieldId]))
							{
								$itemId = self::$lookup['custom-field'][$catId][$customFieldId];
								
								return $itemId;
							}
						}
					}
				}
				else
				{
					if (isset(self::$lookup[$view]))
					{
						foreach($ids as $id)
						{
							if (isset(self::$lookup[$view][(int)$id])) {
								return self::$lookup[$view][(int)$id];
							}
						}
					}
				}
			}
		}
		else
		{
			$active = $menus->getActive();
			if ($active && $active->component == 'com_ntrip') {
				return $active->id;
			}
		}

		return null;
	}
}
