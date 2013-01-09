<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_ntrip')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Helper
require_once JPATH_COMPONENT.'/helpers/ntrip.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $session = JFactory::getSession();
    $session->set('request_method', 'delete');
    $_SERVER['REQUEST_METHOD'] = 'POST';
}

// Execute the task.
$controller	= JControllerLegacy::getInstance('Ntrip');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
