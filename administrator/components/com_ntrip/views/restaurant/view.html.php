<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('BannersHelper', JPATH_COMPONENT.'/helpers/banners.php');

/**
 * View to edit a restaurant.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.5
 */
class NtripViewRestaurant extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		// Initialise variables.
		$this->form	= $this->get('Form');
		$this->item	= $this->get('Item');
		$this->state	= $this->get('State');

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
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= BannersHelper::getActions();

		JToolBarHelper::title($isNew ? JText::_('COM_BANNERS_MANAGER_CLIENT_NEW') : JText::_('COM_BANNERS_MANAGER_CLIENT_EDIT'), 'banners-restaurants.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||$canDo->get('core.create'))) {
			JToolBarHelper::apply('restaurant.apply');
			JToolBarHelper::save('restaurant.save');
		}
		if (!$checkedOut && $canDo->get('core.create')) {

			JToolBarHelper::save2new('restaurant.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('restaurant.save2copy');
		}

		if (empty($this->item->id))  {
			JToolBarHelper::cancel('restaurant.cancel');
		} else {
			JToolBarHelper::cancel('restaurant.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_BANNERS_CLIENTS_EDIT');
	}
}
