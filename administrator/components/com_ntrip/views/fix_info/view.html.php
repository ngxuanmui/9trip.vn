<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View to edit a fix_info.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.5
 */
class NtripViewFix_Info extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
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
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
		// Since we don't track these assets at the item level, use the category id.
		$canDo		= NtripHelper::getActions($this->item->catid,0);

		JToolBarHelper::title($isNew ? JText::_('Fix Info: New') : JText::_('Fix Info: Edit'), 'fix_infos.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit') || count($user->getAuthorisedCategories('com_ntrip', 'core.create')) > 0)) {
			JToolBarHelper::apply('fix_info.apply');
			JToolBarHelper::save('fix_info.save');
		}

		if (empty($this->item->id))  {
			JToolBarHelper::cancel('fix_info.cancel');
		}
		else {
			JToolBarHelper::cancel('fix_info.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
