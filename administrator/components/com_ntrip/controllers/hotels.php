<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Hotels list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class NtripControllerHotels extends JControllerAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_NTRIP_HOTELS';

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
	public function getModel($name = 'Hotel', $prefix = 'NtripModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
	public function update_counter()
	{
		$model = $this->getModel('Hotels', 'NtripModel');
		
		//TODO: update info from db
		$categories = $model->updateCategoriesCounter();
				
		//TODO: redirect and notice success or fail
		$url = JRoute::_('index.php?option=com_ntrip', false);
		$this->setRedirect($url, 'Update counter successful');
		
		return true;
	}
}
