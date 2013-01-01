<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Ntrip component helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class NtripHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{
		$extension = JRequest::getString('extension', '');
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_HOTELS'),
			'index.php?option=com_ntrip&view=hotels',
			$vName == 'hotels'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_RESTAURANTS'),
			'index.php?option=com_ntrip&view=restaurants',
			$vName == 'restaurants'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_LOCATIONS'),
			'index.php?option=com_categories&extension=com_ntrip',
			$vName == 'categories'
		);
		if ($vName=='categories' && $extension == 'com_ntrip') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip')),
				'hotels-categories');
		}
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_hotel',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_hotel'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_hotel') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_hotel')),
				'hotels-categories');
		}
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_VISIT_TIME'),
			'index.php?option=com_categories&extension=com_ntrip.custom_visit_time',
			$vName == 'categories' && $extension == 'com_ntrip.custom_visit_time'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_visit_time') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_hotel')),
				'hotels-categories');
		}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId)) {
			$assetName = 'com_ntrip';
			$level = 'component';
		} else {
			$assetName = 'com_ntrip.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_ntrip', $level);

		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}
