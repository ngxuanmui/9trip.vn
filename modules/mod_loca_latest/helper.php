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

		$location = JFactory::getSession()->get('loca_location', 0);
		
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

		return $rows;
    }
}
