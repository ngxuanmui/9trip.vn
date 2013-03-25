<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @since		1.5
 */
class modCustomFieldHelper
{
	static function &getList(&$params)
	{
		$rows = array();
		
		// import categories
		jimport('joomla.application.categories');
		
		// get tour custom field
		$tourCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_tour', 'table'=>'#__ntrip_tours'));
		
		$rows['tours'] = $tourCustomField->get()->getChildren();
		
		$serviceCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_service', 'table'=>'#__ntrip_services'));
		
		$rows['services'] = $serviceCustomField->get()->getChildren();
		
		$shoppingCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_shopping', 'table'=>'#__ntrip_shoppings'));
		
		$rows['shoppings'] = $shoppingCustomField->get()->getChildren();
		
		$relaxCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_relax', 'table'=>'#__ntrip_relaxes'));
		
		$rows['relaxes'] = $relaxCustomField->get()->getChildren();
		
		$loc = JRequest::getInt('id');
		$rows['hotels'] = modCustomFieldHelper::_getCustomField('custom_field_hotel', $loc);
		
		$rows['restaurants'] = modCustomFieldHelper::_getCustomField('custom_field_restaurant', $loc);
		
		return $rows;
	}
	
	private function _getCustomField($type='custom_field_hotel', $location = 0)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')
				->from('#__categories')
				->where('id IN (SELECT category_id FROM #__category_location WHERE locations = '.$location.')')
//				->where('parent_id IN (SELECT category_id FROM #__category_location WHERE locations = '.$location.')', 'OR')
				->where('extension = "com_ntrip.'.$type.'"')
				->where('published = 1');
		
//		echo str_replace('#__', 'jos_', $query);
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		return $rs;
	}
}
