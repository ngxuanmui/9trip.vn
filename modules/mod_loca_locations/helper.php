<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_locations
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_locations
 * @since		1.5
 */
class modLocaLocationHelper
{
	static function &getList(&$params)
	{
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		return true;
	}
}
