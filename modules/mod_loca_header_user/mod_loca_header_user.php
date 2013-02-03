<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_header_user
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
 require_once dirname(__FILE__).'/helper.php';

$type	= modLocaHeaderUserHelper::getType();
$return	= modLocaHeaderUserHelper::getReturnURL($params, $type);
$user	= JFactory::getUser();

require JModuleHelper::getLayoutPath('mod_loca_header_user', $params->get('layout', 'default'));
