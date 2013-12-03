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
		$app = JFactory::getApplication();
		
		if ($app->isAdmin())
			return true;
		
		$content = JResponse::getBody();
		
		$content = $this->replace($content);
		
		JResponse::setBody($content);
		
		return true;
		
	}
	
	protected function replace($content = '')
	{
		$patterns = array();
		$replacements = array();
		$matches = array();
		
		/* hotel */
		$patterns[0] = '/{load_hotel\:\s?(\d+)}/si';
		
		preg_match_all($patterns[0], $content, $matches);
		
		if (!empty($matches[1]))
		{
			foreach ($matches[1] as $hotelId)
			{
// 				$hotelId = isset($matches[1]) ? $matches[1] : null;

				$pattern = '/{load_hotel\:\s?('.$hotelId.')}/si';
						
				$hotelData = $this->getData($hotelId, 'hotels');
				
// 				var_dump($hotelId, $hotelData->id, $hotelData->name);
				
				$replacement = $this->loadBlock('hotel', $hotelData);
				
				$content = preg_replace($pattern, $replacement, $content);
			}
		}
		/* end hotel */
		
		return $content;
	}
	
	private function getData($id = 0, $type = 'hotels')
	{
		if (!$id)
			return;
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')->from('#__ntrip_'. $type)->where('state = 1')->where('id = ' . $id);
		
		$db->setQuery($query);
		
		$obj = $db->loadObject();
		
		return $obj;
	}
	
	private function loadBlock($block = 'hotel', $item = null)
	{
		if (empty($item))
			return ;
		
		$filename = JPATH_ROOT . DS . 'plugins/system/locareplace/tpl_blocks/' . $block . '.php';
		
		ob_start();
		
		include ($filename);
		
		$content = ob_get_contents();
		
		ob_end_clean();
		
		return $content;
	}
}
