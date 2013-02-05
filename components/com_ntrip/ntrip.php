<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
//require_once JPATH_COMPONENT.'/helpers/route.php';

// get helper from admin
require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'ntrip.php';

// toolbar
require_once JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'user_toolbar.php';

$controller = JControllerLegacy::getInstance('Ntrip');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
