<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JLoader::register('MenusHelper', JPATH_ADMINISTRATOR . '/components/com_menus/helpers/menus.php');
/**
 * Joomla! Location Plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	System.languagefilter
 * @since		1.6
 */
class plgSystemLocation extends JPlugin
{
	protected static $default_location;
	protected static $cookie;

	public function __construct(&$subject, $config)
	{
		// Ensure that constructor is called one time
		self::$cookie = '';
		
		parent::__construct($subject, $config);
	}

	public function onAfterRoute()
	{
		$get = JRequest::get('get');	
		
		if (isset($get['option']) && $get['option'] == 'com_ntrip' && isset($get['view']) && $get['view'] == 'category' && $get['id'] > 0)
			JFactory::getSession()->set('loca_location', $get['id']);			
	}
}
