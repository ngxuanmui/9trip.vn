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
	public static function getItemRoute($id, $view, $catid = 0, $language = 0)
	{
		$needles = array(
			'discovers'  => array((int) $id),
			'promotion'  => array((int) $id),
			'warning'  => array((int) $id),
			'question'  => array((int) $id)
		);
		
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

// 		if ($item = self::_findItem($needles)) {
// 			$link .= '&Itemid='.$item;
// 		}
// 		elseif ($item = self::_findItem()) {
// 			$link .= '&Itemid='.$item;
// 		}

		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		
		$query->select('*')->from('#__menu')->where('menutype = "main-top-menu"');
		$db->setQuery($query);
		
		$menus = $db->loadObjectList();
		
		foreach ($menus as $menu)
		{
			if (strpos($menu->link, $view) !== false)
			{
				$link .= '&Itemid=' . $menu->id;
				break;
			}
		}

		return $link;
	}
	
	/**
	 * @param	int	The route of the newsfeed
	 */
	public static function getOtherRoute($view = 'feedback', $tmpl = '')
	{
		$needles = null;
		
		//Create the link
		$link = 'index.php?option=com_ntrip&view='.$view;
		
		if ($tmpl)
			$link .= '&tmpl=' . $tmpl;
		
		if ($item = self::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		}
		elseif ($item = self::_findItem()) {
			$link .= '&Itemid='.$item;
		}
		
		echo $link;
		
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
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
					if (!isset(self::$lookup[$view])) {
						self::$lookup[$view] = array();
					}
					if (isset($item->query['id'])) {
						self::$lookup[$view][$item->query['id']] = $item->id;
					}
				}
			}
		}

		if ($needles)
		{
			foreach ($needles as $view => $ids)
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
