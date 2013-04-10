<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
//require_once JPATH_COMPONENT.'/helpers/route.php';

// get helper from admin
require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'ntrip.php';

// get front helper
require_once JPATH_COMPONENT.'/helpers/ntrip.php';

// toolbar
require_once JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'user_toolbar.php';

// abs class
require_once JPATH_COMPONENT_SITE . DS . 'models' . DS . 'items.php';
require_once JPATH_COMPONENT_SITE . DS . 'models' . DS . 'item.php';

// get comment helper
require_once JPATH_SITE . DS . 'components/com_ntrip_comment/helpers/ntrip_comment.php';

$doc = JFactory::getDocument();
$doc->addScript('http://maps.googleapis.com/maps/api/js?key='.CFG_GOOGLE_MAP_API.'&sensor=true');

$controller = JControllerLegacy::getInstance('Ntrip');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
