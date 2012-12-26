<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View class for a list of comments.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 * @since       1.6
 */
class NtripViewComments extends JViewLegacy
{
	protected $categories;
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 * @since   1.6
	 */
	public function display($tpl = null)
	{
		// Initialise variables.
		$this->categories	= $this->get('CategoryOrders');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT . '/helpers/ntrip.php';

		$canDo = NtripHelper::getActions($this->state->get('filter.category_id'));
		$user = JFactory::getUser();
		JToolBarHelper::title(JText::_('COM_NTRIP_MANAGER_COMMENTS'), 'comments.png');
		if (count($user->getAuthorisedCategories('com_ntrip', 'core.create')) > 0)
		{
			JToolBarHelper::addNew('comment.add');
		}

		if (($canDo->get('core.edit')))
		{
			JToolBarHelper::editList('comment.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolBarHelper::divider();
				JToolBarHelper::publish('comments.publish', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::unpublish('comments.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($this->state->get('filter.state') != -1)
			{
				JToolBarHelper::divider();
				if ($this->state->get('filter.state') != 2)
				{
					JToolBarHelper::archiveList('comments.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolBarHelper::unarchiveList('comments.publish');
				}
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::checkin('comments.checkin');
		}

		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'comments.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::trash('comments.trash');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_ntrip');
			JToolBarHelper::divider();
		}
		JToolBarHelper::help('JHELP_COMPONENTS_COMMENTS_COMMENTS');
	}
}
