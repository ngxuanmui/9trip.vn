<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_ntrip_comment
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
//require_once JPATH_COMPONENT.'/helpers/route.php';

// get helper from admin
require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'ntrip_comment.php';

$controller = JControllerLegacy::getInstance('Ntrip');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
