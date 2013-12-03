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
 * @subpackage	System.locareplace
 * @since		1.6
 */
class plgSystemLocaReplace extends JPlugin
{
	public function __construct(&$subject, $config)
	{
		// Ensure that constructor is called one time
		parent::__construct($subject, $config);
	}

	public function onAfterRender()
	{
		$content = JResponse::getBody();
		
		$content = $this->replace($content);
		
		JResponse::setBody($content);
		
		return true;
		
	}
	
	protected function replace($content = '')
	{
		$pattern = '/(keywords)/si';
		$replacement = 'test';
		
		$content = preg_replace($pattern, $replacement, $content);
		
		return $content;
	}
}
