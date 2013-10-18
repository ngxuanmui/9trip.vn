<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Content Component Controller
 *
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @since		1.5
 */
class NtripController extends JControllerLegacy
{
	protected $default_view = 'not_found';
	
	function __construct($config = array())
	{
		parent::__construct($config);
	}

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$cachable = true;

		$safeurlparams = array('catid'=>'INT', 'id'=>'INT', 'cid'=>'ARRAY', 'year'=>'INT', 'month'=>'INT', 'limit'=>'UINT', 'limitstart'=>'UINT',
			'showall'=>'INT', 'return'=>'BASE64', 'filter'=>'STRING', 'filter_order'=>'CMD', 'filter_order_Dir'=>'CMD', 'filter-search'=>'STRING', 'print'=>'BOOLEAN', 'lang'=>'CMD');

		$viewNotAvailables = array('warnings', 'warning', 'promotions', 'promotion');
		
		// Check Auth
		$viewsRequiredSignIn = array(
				'user_man_hotels',
				'user_man_hotel',
				'user_man_services',
				'user_man_service',
				'user_man_albums',
				'user_man_album',
				'user_man_discovers',
				'user_man_discover',
				'user_man_promotions',
				'user_man_promotion',
				'user_man_questions',
				'user_man_question',
				'user_man_relaxes',
				'user_man_relax',
				'user_man_restaurants',
				'user_man_restaurant',
				'user_man_services',
				'user_man_service',
				'user_man_shoppings',
				'user_man_shopping',
				'user_man_tours',
				'user_man_tour',
				'user_man_warnings',
				'user_man_warning',
		);
		
		$vName	= JRequest::getCmd('view', 'not_found');
		
		if (in_array($vName, $viewNotAvailables) || in_array($vName, $viewsRequiredSignIn))
			$vName = 'not_found';
		
		JRequest::setVar('view', $vName);
		
		$signInUrl	= JRoute::_('index.php?option=com_users&view=login', false);
		$user 		= JFactory::getUser();
		
		
		
		if (in_array($vName, $viewsRequiredSignIn) && !$user->get('id')) {
			$this->setRedirect($signInUrl, JText::_('Login please!'), 'notice');
			return $this;
		}
		
		parent::display($cachable, $safeurlparams);

		return $this;
	}
}
