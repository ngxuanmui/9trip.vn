<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Promotions list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class NtripControllerPromotions extends JControllerAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_NTRIP_PROMOTIONS';

	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask('sticky_unpublish',	'sticky_publish');
	}

	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Promotion', $prefix = 'NtripModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	/**
	 * @since	1.6
	 */
	public function sticky_publish()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$user	= JFactory::getUser();
		$ids	= JRequest::getVar('cid', array(), '', 'array');
		$values	= array('sticky_publish' => 1, 'sticky_unpublish' => 0);
		$task	= $this->getTask();
		$value	= JArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids)) {
			JError::raiseWarning(500, JText::_('COM_NTRIP_NO_PROMOTIONS_SELECTED'));
		} else {
			// Get the model.
			$model	= $this->getModel();

			// Change the state of the records.
			if (!$model->stick($ids, $value)) {
				JError::raiseWarning(500, $model->getError());
			} else {
				if ($value == 1) {
					$ntext = 'COM_NTRIP_N_PROMOTIONS_STUCK';
				} else {
					$ntext = 'COM_NTRIP_N_PROMOTIONS_UNSTUCK';
				}
				$this->setMessage(JText::plural($ntext, count($ids)));
			}
		}

		$this->setRedirect('index.php?option=com_ntrip&view=promotions');
	}
}
