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
		
		/* get id */
		$loc = JRequest::getInt('id');
		
		// import categories
		jimport('joomla.application.categories');
		
		$catObject = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => ''));
		
		$rows['category'] = $catObject->get($loc);
		
		// get tour custom field
//		$tourCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_tour', 'table'=>'#__ntrip_tours'));
//		
//		$rows['tours'] = $tourCustomField->get()->getChildren();
		
//		$serviceCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_service', 'table'=>'#__ntrip_services'));
//		
//		$rows['services'] = $serviceCustomField->get()->getChildren();
		
//		$shoppingCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_shopping', 'table'=>'#__ntrip_shoppings'));
//		
//		$rows['shoppings'] = $shoppingCustomField->get()->getChildren();
		
//		$relaxCustomField = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_relax', 'table'=>'#__ntrip_relaxes'));
//		
//		$rows['relaxes'] = $relaxCustomField->get()->getChildren();
		
		$rows['tours'] = modCustomFieldHelper::_getCustomField('custom_field_tour', $loc, 'tours');
		
		$rows['shoppings'] = modCustomFieldHelper::_getCustomField('custom_field_shopping', $loc, 'shoppings');
		
		$rows['relaxes'] = modCustomFieldHelper::_getCustomField('custom_field_relax', $loc, 'relaxes');
				
		$rows['services'] = modCustomFieldHelper::_getCustomField('custom_field_service', $loc, 'services');
		
		$rows['hotels'] = modCustomFieldHelper::_getCustomField('custom_field_hotel', $loc, 'hotels');
		
		$rows['restaurants'] = modCustomFieldHelper::_getCustomField('custom_field_restaurant', $loc, 'restaurants');
		
		return $rows;
	}
	
	private function _getCustomField($type='custom_field_hotel', $location = 0, $field = '')
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*')
				->from('#__categories')
//				->where('parent_id IN (SELECT category_id FROM #__category_location WHERE locations = '.$location.')', 'OR')
				->where('extension = "com_ntrip.'.$type.'"')
				->where('published = 1')
				->order('lft ASC');
		
//		echo str_replace('#__', 'jos_', $query);
		
		if ($type == 'custom_field_hotel' || $type == 'custom_field_restaurant')
			$query->where('id IN (SELECT category_id FROM #__category_location WHERE locations = '.$location.')');
		
		$db->setQuery($query);
		$rs = $db->loadObjectList();
		
		foreach ($rs as & $item)
		{
			$item->counter = 0;
			
			if ($field)
				$item->counter = modCustomFieldHelper::getCategoryCounter($location, $item->id, $field);
		}
		
		return $rs;
	}
	
	public function getCategoryCounter($catId = 0, $customFieldId = 0, $field = 'hotels')
	{
		if (!$catId)
			return false;
		
		$xmlFile = JPATH_ROOT . DS . 'loca' . DS . 'xml' . DS . 'category.counter.xml';
		
		$xml = simplexml_load_file($xmlFile); 
		
		$val = 0;
				
		foreach ($xml->category as $category)
		{
			$break = false;
			
			if ($category['id'] == $catId)
			{
				foreach ($xml->category->$field->custom_field as $f)
				{
					if ($f['id'] == $customFieldId)
					{
						$val = $f['value'];
						$break = true;
					}
				}
			}
			
			if ($break)
				break;
		}
				
//		die;
		return $val;
	}
}
