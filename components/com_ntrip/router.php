<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.categories');

function ntripGetViews()
{
	/* use this variable to check views */
	$arrViews = array(
						'discover' => 'discovers', 
						'relax' => 'relaxes', 
						'promotion' => 'promotions', 
						'warning' => 'warnings', 
						'hotel' => 'hotels', 
						'hotels' => 'hotels',
						'restaurants' => 'restaurants',
						'relaxes' => 'relaxes',
						'tours' => 'tours',
						'shoppings' => 'shoppings',
						'services' => 'services',
						'service' => 'services',
						'shopping' => 'shoppings',
						'restaurant' => 'restaurants',
						'tour' => 'tours',
						'question' => 'questions',
						'album' => 'albums',
						'feedback' => 'feedback',
						'search' => 'search'
			);
	
// 	$arrViews = array();
	
	return $arrViews;
}

/**
 * Build the route for the com_ntrip component
 *
 * @param	array	An array of URL arguments
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 * @since	1.5
 */
function NtripBuildRoute(&$query)
{
	$arrViews = ntripGetViews();
	
	$arrViewKeys = array_keys($arrViews);
	
	$segments	= array();
	

	// get a menu item based on Itemid or currently active
	$app		= JFactory::getApplication();
	$menu		= $app->getMenu();
	$params		= JComponentHelper::getParams('com_ntrip');
	$advanced	= $params->get('sef_advanced_link', 0);

	// we need a menu item.  Either the one specified in the query, or the current active one if none specified
	if (empty($query['Itemid'])) {
		$menuItem = $menu->getActive();
		$menuItemGiven = false;
	}
	else {
		$menuItem = $menu->getItem($query['Itemid']);
		$menuItemGiven = true;
	}
	
	if (isset($query['limitstart']))
		unset($query['limitstart']);
	
	if (isset($query['start']))
	{
		$limit = JRequest::getInt('limit');
		
		$page = $limit > 0 ? round($query['start'] / $limit) + 1 : 1;
		
		$segments[] = 'page-'.$page;
		
		unset($query['start']);
	}

	if (isset($query['view'])) {
		$view = $query['view'];
		unset($query['view']);
	}
	else {
		// we need to have a view in the query or it is an invalid URL
		return $segments;
	}
	
	if (isset($query['custom_field']) && $view == 'discovers')
	{
		unset($query['custom_field']);
	}
	
	// are we dealing with an discover or category that is attached to a menu item?
	if (($menuItem instanceof stdClass) && $menuItem->query['view'] == @$query['view'] && isset($query['id']) && isset($menuItem->query['id']) && $menuItem->query['id'] == intval($query['id'])) {
		unset($query['view']);

		if (isset($query['catid'])) {
			unset($query['catid']);
		}
		
		if (isset($query['layout'])) {
			unset($query['layout']);
		}

		unset($query['id']);
		
		return $segments;
	}
	
	if ($view == 'category' || in_array($view, $arrViewKeys))
	{
		if (!$menuItemGiven) {
			$segments[] = $view;
		}

		unset($query['view']);

		if (in_array($view, $arrViewKeys)) {
			
			if (isset($query['id'])) {
				
				// Make sure we have the id and the alias
				if (strpos($query['id'], ':') === false) {
					$db = JFactory::getDbo();
					$aquery = $db->setQuery($db->getQuery(true)
						->select('alias')
						->from('#__ntrip_' . $arrViews[$view])
						->where('id='.(int)$query['id'])
					);
					$alias = $db->loadResult();
					
					if ($db->getErrorMsg())
						die ($db->getErrorMsg());
					
					$query['id'] = $query['id'].':'.$alias;
					
					
				}
			} else {
				// if exist query catid, unset it
				unset($query['catid']);
				
				// we should have these two set for this view.  If we don't, it is an error
				return $segments;
			}
		}
		else {
			if (isset($query['id'])) {
				$catid = $query['id'];
			} else {
				// we should have id set for this view.  If we don't, it is an error
				return $segments;
			}
		}

		if ($menuItemGiven && isset($menuItem->query['id'])) {
			$mCatid = $menuItem->query['id'];
		} else {
			$mCatid = 0;
		}

		if (in_array($view, $arrViewKeys)) {
			if ($advanced) {
				list($tmp, $id) = explode(':', $query['id'], 2);
			}
			else {
				$id = $query['id'];
			}
			$segments[] = $id;
		}
		
		unset($query['id']);
		unset($query['catid']);
	}
		
	$arrFormViews = array('user_man_service' => 'quan-ly-dich-vu');
	
	$arrFormViewsKey = array_keys($arrFormViews);
	
	
	if (isset($query['view']) && in_array($query['view'], $arrFormViewsKey))
	{
		$segments[] = $arrFormViews[$query['view']];
		
		unset($query['view']);
	}
	
	$arrTasks = array('user_man_service.add' => 'them-moi', 'user_man_service.edit' => 'sua');
	
	if (isset($query['task']) && in_array($query['task'], $arrTasks))
	{
		$segments[] = $arrTasks[$query['task']];
			
		unset($query['task']);
	}
	
	if (isset($query['catid'])) {
		unset($query['catid']);
	}

	return $segments;
}



/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 * @since	1.5
 */
function NtripParseRoute($segments)
{
	// get views
	$arrViews = ntripGetViews();
	
	$arrViewKeys = array_keys($arrViews);
	
// 	$arrMapMenuAlias = array(
// 			'khuyen-mai' => 'promotion', 
// 			'kham-pha' => array('item' => 'discover', 'items' => 'discovers', 'limit' => CFG_LIMIT_DISCOVERY),
// 			'khach-san' => 'hotel',
// 			'canh-bao' => 'warning',
// 			'nha-hang' => 'restaurant',
// 			'khach-san' => 'hotel',
// 			'giai-tri' => 'relax',
// 			'tham-quan' => 'tour',
// 			'mua-sam' => 'shopping',
// 			'dich-vu' => 'service',
// 			'hoi-dap' => 'question',
// 			'feedback' => 'feedback'
// 			);
	
	$arrMapMenuAlias = array();
	
	$vars = array();

	//Get the active menu item.
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$itemMenu = $item	= $menu->getActive();
	$params = JComponentHelper::getParams('com_ntrip');
	$advanced = $params->get('sef_advanced_link', 0);
	$db = JFactory::getDBO();

	// Count route segments
	$count = count($segments);

	// Standard routing for discovers.  If we don't pick up an Itemid then we get the view from the segments
	// the first segment is the view and the last segment is the id of the discover or category.
	if (!isset($item)) {
		$vars['view']	= $segments[0];
		$vars['id']		= $segments[$count - 1];

		return $vars;
	}
	
	if ($menu->getActive() == $menu->getDefault())
		return $vars;
	
// 	var_dump($count, $segments, $item); die;

	// if there is only one segment, then it points to either an discover or a category
	// we test it first to see if it is a category.  If the id and alias match a category
	// then we assume it is a category.  If they don't we assume it is an discover
	if ($count == 1) {
		// we check to see if an alias is given.  If not, we assume it is an discover
		if (strpos($segments[0], ':') === false) {
			if (isset($arrMapMenuAlias[$item->alias]))
				$vars['view'] = $arrMapMenuAlias[$item->alias];
			else
			{
				
			}
			$vars['id'] = (int)$segments[0];
			return $vars;
		}
		
		list($id, $alias) = explode(':', $segments[0], 2);
		
		// first we check if it is a category
		$category = JCategories::getInstance('Ntrip')->get($id);
		
		if ($category && $category->alias == $alias) {
			$vars['view'] = 'category';
			$vars['id'] = $id;

			return $vars;
		} else {
			if (isset($vars['view']))
			{
				$query = 'SELECT alias, catid FROM #__ntrip_'.$arrViewKeys[$vars['view']].' WHERE id = '.(int)$id;
				$db->setQuery($query);
				$item = $db->loadObject();
				
				if ($item) {
					if ($item->alias == $alias) {
						$vars['view'] = $arrMapMenuAlias[$itemMenu->alias];
						$vars['catid'] = (int)$item->catid;
						$vars['id'] = (int)$id;
						
						return $vars;
					}
				}
			}
		}
	}

	// if there was more than one segment, then we can determine where the URL points to
	// because the first segment will have the target category id prepended to it.  If the
	// last segment has a number prepended, it is an discover, otherwise, it is a category.
	if (!$advanced) {
		$cat_id = (int)$segments[0];

		$item_id = (int)$segments[$count - 1];
		
		$urlParam = getParams($itemMenu->link);
		
// 		var_dump($urlParam); die;

		$vars['view'] = $urlParam['view'];
		
		$viewItem = '';
		
		switch ($vars['view'])
		{
			case 'discovers':
				$limit = CFG_LIMIT_DISCOVERS;
				$viewItem = 'discover';
				break;
			case 'hotels':
				$limit = CFG_LIMIT_HOTELS;
				$viewItem = 'hotel';
				break;
			case 'restaurants':
				$limit = CFG_LIMIT_RESTAURANTS;
				$viewItem = 'restaurant';
				break;
			case 'relaxes':
				$limit = CFG_LIMIT_RELAXES;
				$viewItem = 'relax';
				break;
			case 'tours':
				$limit = CFG_LIMIT_TOURS;
				$viewItem = 'tour';
				break;
			case 'shoppings':
				$limit = CFG_LIMIT_SHOPPINGS;
				$viewItem = 'shopping';
				break;
			case 'services':
				$limit = CFG_LIMIT_SERVICES;
				$viewItem = 'service';
				break;
			case 'promotions':
				$limit = CFG_LIMIT_PROMOTIONS;
				$viewItem = 'promotion';
				break;
			case 'questions':
				$limit = CFG_LIMIT_QUESTIONS;
				$viewItem = 'question';
				break;
			case 'warnings':
				$limit = CFG_LIMIT_WARNINGS;
				$viewItem = 'warning';
				break;
			case 'albums':
				$limit = CFG_LIMIT_ALBUMS;
				$viewItem = 'album';
				break;
		}
		
		if ($item_id > 0) 
		{

			$query = "SELECT id, catid FROM #__ntrip_".$vars['view']." WHERE id = " . $item_id;
			$db->setQuery($query);
			
			$tmp = $db->loadObject();

			$vars['view'] = $viewItem;
			
			if (isset($item->custom_field))
				$vars['custom_field'] = $item->custom_field;
			
			$vars['catid'] = $tmp->catid;
			$vars['id'] = $item_id;
		} else {
			if (strpos($segments[0], 'page') !== false)
			{
				list($page, $pageVal) = explode(':', $segments[0]);
				
				$vars['limitstart'] = $limit * ($pageVal - 1);
				$vars['catid'] = $urlParam['catid'];
				
// 				$vars['view'] = $arrMapMenuAlias[$itemMenu->alias]['items'];
			}
			else
			{
// 				$vars['view'] = 'category';
				$vars['id'] = $cat_id;
			}
		}

		return $vars;
	}

	// we get the category id from the menu item and search from there
	$id = $item->query['id'];
	$category = JCategories::getInstance('Ntrip')->get($id);

	if (!$category) {
		JError::raiseError(404, JText::_('COM_NTRIP_ERROR_PARENT_CATEGORY_NOT_FOUND'));
		return $vars;
	}

	$categories = $category->getChildren();
	$vars['catid'] = $id;
	$vars['id'] = $id;
	$found = 0;

	foreach($segments as $segment)
	{
		$segment = str_replace(':', '-', $segment);

		foreach($categories as $category)
		{
			if ($category->alias == $segment) {
				$vars['id'] = $category->id;
				$vars['catid'] = $category->id;
				$vars['view'] = 'category';
				$categories = $category->getChildren();
				$found = 1;
				break;
			}
		}

		if ($found == 0) {
			if ($advanced) {
				$db = JFactory::getDBO();
				$query = 'SELECT id FROM #__content WHERE catid = '.$vars['catid'].' AND alias = '.$db->Quote($segment);
				$db->setQuery($query);
				$cid = $db->loadResult();
			} else {
				$cid = $segment;
			}

			$vars['id'] = $cid;

			if ($item->query['view'] == 'archive' && $count != 1){
				$vars['year']	= $count >= 2 ? $segments[$count-2] : null;
				$vars['month'] = $segments[$count-1];
				$vars['view']	= 'archive';
			}
			else {
				$vars['view'] = 'discover';
			}
		}

		$found = 0;
	}

	return $vars;
}

function getParams($str)
{
	$tmp = explode('?', $str);
	
	$tmp = explode('&', $tmp[1]);
	
	$param = array();
	
	foreach ($tmp as $var)
	{
		$tmp_1 = explode('=', $var);
		
		$varName = $tmp_1[0];
		
		$param[$varName] = $tmp_1[1];
	}
	
	return $param;
}
