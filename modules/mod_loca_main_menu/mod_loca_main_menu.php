<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_main_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$session = JFactory::getSession();
$location = $session->get('loca_location');

$id = JRequest::getInt('id');

$catId = JRequest::getInt('catid', 0);

// var_dump($_GET);

if (!$catId && $_GET['option'] == 'com_ntrip' && $_GET['view'] != 'search')
	$catId = $id;

jimport('joomla.application.categories');

$tmpCat = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => ''));
$locaCategory = $tmpCat->get($catId);

//var_dump($locaCategory);

$customFieldDiscover = LocaHelper::getCategories('com_ntrip.custom_field_discover');

// $moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_loca_main_menu', $params->get('layout', 'default'));
