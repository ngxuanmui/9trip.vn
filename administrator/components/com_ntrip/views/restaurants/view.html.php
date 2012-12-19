<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View class for a list of restaurants.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class BannersViewRestaurants extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		// Initialise variables.
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/banners.php';

		$canDo	= BannersHelper::getActions();

		JToolBarHelper::title(JText::_('COM_BANNERS_MANAGER_CLIENTS'), 'banners-restaurants.png');
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('restaurant.add');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('restaurant.edit');
		}
		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::publish('restaurants.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('restaurants.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolBarHelper::divider();
			JToolBarHelper::archiveList('restaurants.archive');
			JToolBarHelper::checkin('restaurants.checkin');
		}
		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'restaurants.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		} elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('restaurants.trash');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_ntrip');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help('JHELP_COMPONENTS_BANNERS_CLIENTS');
	}
}
