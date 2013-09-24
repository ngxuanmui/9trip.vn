<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_latest
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_latest
 * @since		1.5
 */
class modLocaLatestHelper
{
    static function &getList(&$params)
    {
		$db		= JFactory::getDbo();
		$rows	= array();
		$query	= $db->getQuery(true);
		
		$type = $params->get('type');
		$limit = $params->get('limit', 10);

		//$location = JFactory::getSession()->get('loca_location', 0);
		$location = JRequest::getInt('catid');
		
		if (!$location && JRequest::getString('view') == 'category')
			$location = JRequest::getInt('id');
		
		$table = '';
		
		switch ($type)
		{
			case 'warning':
				$table = '#__ntrip_warnings';
				break;
			case 'promotion':
				$table = '#__ntrip_promotions';
				break;
			case 'discover':
				$table = '#__ntrip_discovers';
				break;
		}
		
		$query->select('a.*, UNIX_TIMESTAMP(a.created) AS unix_time_created')
				->from($table . ' a')
				->where('a.state = 1')
				->select('c.title AS category_title, c.id AS category_id, c.alias AS category_alias')
				->join('INNER', '#__categories c ON a.catid = c.id')
				->order('a.id desc');
		
		if ($location)
			$query->where('catid = ' . (int) $location);
		
		$db->setQuery($query, 0, $limit);
		$rows = $db->loadObjectList();
		
		foreach ($rows as & $item)
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

			@JFolder::create($thumb_path);

			//$thumbName = $thumb_path . '/' . $image_name;
			
			$thumbW = 80;
			$thumbH = 0;
			
			$thumb_image_path = $thumb_path . DS . $image_name;

			// create thumb if not exist
			if (!file_exists($thumb_image_path) && file_exists($image_path . DS . $image_name))
				LocaHelper::thumbnail($image_path, $thumb_path, $image_name, 80, 0);

			$item->thumb = JURI::root() . 'images/thumbs/' . implode('/', $tmp) . '/' .'t-' . $thumbW . 'x' . $thumbH . '-' . $image_name;
		}

		return $rows;
    }
}
