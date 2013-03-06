<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Ntrip component helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class NtripHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{
		$extension = JRequest::getString('extension', '');
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_HOTELS'),
			'index.php?option=com_ntrip&view=hotels',
			$vName == 'hotels'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_RESTAURANTS'),
			'index.php?option=com_ntrip&view=restaurants',
			$vName == 'restaurants'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_TOURS'),
			'index.php?option=com_ntrip&view=tours',
			$vName == 'tours'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_WARNINGS'),
			'index.php?option=com_ntrip&view=warnings',
			$vName == 'warnings'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_RELAXES'),
			'index.php?option=com_ntrip&view=relaxes',
			$vName == 'relaxes'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_SHOPPINGS'),
			'index.php?option=com_ntrip&view=shoppings',
			$vName == 'shoppings'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_SERVICES'),
			'index.php?option=com_ntrip&view=services',
			$vName == 'services'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_DISCOVERS'),
			'index.php?option=com_ntrip&view=discovers',
			$vName == 'discovers'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_PROMOTIONS'),
			'index.php?option=com_ntrip&view=promotions',
			$vName == 'promotions'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_ALBUMS'),
			'index.php?option=com_ntrip&view=albums',
			$vName == 'albums'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_LOCATIONS'),
			'index.php?option=com_categories&extension=com_ntrip',
			$vName == 'categories'
		);
		if ($vName=='categories' && $extension == 'com_ntrip') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip')),
				'hotels-categories');
		}
		
		JSubMenuHelper::addEntry(
			JText::_('[Discover: Type]'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_discover',
			$vName == 'categories'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_discover') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_discover_category')),
				'discovers-categories');
		}
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_hotel',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_hotel'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_hotel') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_hotel')),
				'hotels-categories');
		}
		
		JSubMenuHelper::addEntry(
			/* JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL') */
			JText::_('[Restaurant: Type]'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_restaurant',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_restaurant'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_restaurant') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_restaurant')),
				'restaurants-categories');
		}
		
		JSubMenuHelper::addEntry(
			/* JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL') */
			JText::_('[Tour: Type]'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_tour',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_tour'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_tour') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_tour')),
				'tours-categories');
		}
		
		JSubMenuHelper::addEntry(
			/* JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL') */
			JText::_('[Service: Type]'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_service',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_service'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_service') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_service')),
				'services-categories');
		}
		
		JSubMenuHelper::addEntry(
			/* JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL') */
			JText::_('[Shopping: Type]'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_shopping',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_shopping'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_shopping') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_shopping')),
				'shoppings-categories');
		}
		
		JSubMenuHelper::addEntry(
			/* JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_FIELD_HOTEL') */
			JText::_('[Relax: Type]'),
			'index.php?option=com_categories&extension=com_ntrip.custom_field_relax',
			$vName == 'categories' && $extension == 'com_ntrip.custom_field_relax'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_field_relax') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_relax')),
				'relaxs-categories');
		}
		
		JSubMenuHelper::addEntry(
			JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_VISIT_TIME'),
			'index.php?option=com_categories&extension=com_ntrip.custom_visit_time',
			$vName == 'categories' && $extension == 'com_ntrip.custom_visit_time'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_visit_time') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_custom_visit_time')),
				'custom_visit_times-categories');
		}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId)) {
			$assetName = 'com_ntrip';
			$level = 'component';
		} else {
			$assetName = 'com_ntrip.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_ntrip', $level);

		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
	
	static function copyTempFiles($itemId, $images = array(), $itemType = 'hotels')
	{
	    $tmpFolder = JPATH_ROOT . DS . 'tmp' . DS . JFactory::getUser()->id . DS . JFactory::getSession()->getId() . DS;
	    $tmpThumbFolder = $tmpFolder . 'thumbnail' . DS;
	    
	    $destFolder = JPATH_ROOT . DS . 'images' . DS . $itemType . DS . $itemId . DS;	    
	    $destThumbFolder = $destFolder . 'thumbnail' . DS;
	    
	    jimport( 'joomla.filesystem.folder' );
	    
	    // make folder	    
	    JFolder::create($destFolder, 0777);
	    
	    // make thumb
	    JFolder::create($destThumbFolder, 0777);
	    
	    foreach ($images as $img)
	    {
		$src = $tmpFolder . $img;
		$dest = $destFolder . $img;
		
		copy($src, $dest);
		copy($tmpThumbFolder . $img, $destThumbFolder . $img);
	    }
	    
	    // delete tmp folder
	    if (is_dir($tmpFolder))
		JFolder::delete($tmpFolder);
	}
	
	static function insertImages($itemId, $images = array(), $desc = array(), $itemType = 'hotels')
	{
	    $db = JFactory::getDbo();
	    
	    foreach ($images as $key => $img)
	    {
			$query = $db->getQuery(true);
			$query->insert('#__ntrip_images (item_id, item_type, title, description, images)')
				->values($itemId . ', "' . $itemType . '", "", "'.$desc[$key].'", "' . $img . '"' );

			$db->setQuery($query);
			$db->query();

			if ($db->getErrorMsg())
				die($db->getErrorMsg ());
	    }
	    
	    return true;
	}
	
	static function updateImages($itemId, $curentImages = array(), $currentDesc = array(), $itemType = 'hotels')
	{
	    $db = JFactory::getDbo();
	    
	    // get old images
	    $images = NtripHelper::getImages($itemId, $itemType);
		
//		var_dump($images, $curentImages, $currentDesc);
//		
//		die;
	    
	    foreach ($images as $img)
	    {
			$image = $img->images;
			
			$query = $db->getQuery(true);

			if (!in_array($img->id, array_keys($curentImages)))
			{
				// delete image
				$destFolder = JPATH_ROOT . DS . 'images' . DS . $itemType . DS . $itemId . DS;	    
				$destThumbFolder = $destFolder . 'thumbnail' . DS;

				@unlink($destThumbFolder . $image);
				@unlink($destFolder . $image);

				// delete rec in db
				
				$query->delete('#__ntrip_images')
					->where('id = ' . $img->id);
			}
			else
			{
				$query->update('#__ntrip_images')->set('description = "'.$currentDesc[$img->id].'"')->where('id = ' . $img->id);				
			}
			
			$db->setQuery($query);
			$db->query();
	    }
	}
	
	static function getImages($itemId, $itemType = 'hotels')
	{
	    $db = JFactory::getDbo();
	    $query = $db->getQuery(true);
	    
	    $query->select('*')
		    ->from('#__ntrip_images')
		    ->where('item_id = ' . $itemId)
		    ->where('item_type = "'.$itemType.'"');
	    
	    $db->setQuery($query);
	    $rs = $db->loadObjectList('id');
	    
	    return $rs;
	}

	static function uploadImages($field, $item, $delImage = 0, $itemType = 'hotels')
	{
		$jFileInput = new JInput($_FILES);
		$file = $jFileInput->get('jform', array(), 'array');
		
		// If there is no uploaded file, we have a problem...
		if (!is_array($file)) {
//			JError::raiseWarning('', 'No file was selected.');
			return '';
		}

		// Build the paths for our file to move to the components 'upload' directory
		$fileName = $file['name'][$field];
		$tmp_src    = $file['tmp_name'][$field];
		
		$image = '';
		$oldImage = '';
		$flagDelete = false;
		
//		$item = $this->getItem();
		
		// if delete old image checked or upload new file
		if ($delImage || $fileName)
		{			
			$oldImage = JPATH_ROOT . DS . str_replace('/', DS, $item->images);
			
			// unlink file
			if (is_file($oldImage))
				@unlink($oldImage);
			
			$flagDelete = true;
			
			$image = '';
		}
		
		$date = date('Y') . DS . date('m') . DS . date('d');
		
		$dest = JPATH_ROOT . DS . 'images' . DS . $itemType . DS . $date . DS . $item->id . DS;
		
		// Make directory
		@mkdir($dest, 0777, true);
		
		if (isset($fileName) && $fileName) {
			
			$filepath = JPath::clean($dest.$fileName);

			/*
			if (JFile::exists($filepath)) {
				JError::raiseWarning(100, JText::_('COM_MEDIA_ERROR_FILE_EXISTS'));	// File exists
			}
			*/

			// Move uploaded file
			jimport('joomla.filesystem.file');
			
			if (!JFile::upload($tmp_src, $filepath))
			{
				JError::raiseWarning(100, JText::_('COM_MEDIA_ERROR_UNABLE_TO_UPLOAD_FILE')); // Error in upload
				return '';
			}

			// set value to return
			$image = 'images/'.$itemType.'/' . str_replace(DS, '/', $date) . '/' . $item->id . '/' . $fileName;
		}
		else
			if (!$flagDelete)
			    $image = $item->images;
		
		return $image;
	}
	
	public static function updateCountLocations($type = 'hotels', $locId = 0, $add = false, $custom = false, $categoryId = 0)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		if ($custom)
		{
			$table = '#__ntrip_count_location';
		}
		else
		{
			$table = '#__ntrip_count_custom_field';
		}
		
		$query->select('*')
				->from($table)
				->where('location_id = ' . $locId)
				->where('type= ' . $type);
		
		if ($custom)
			$query->where ('category_id = ' . $categoryId);
		
		$db->setQuery($query);
		$rec = $db->loadObject();
		
		if ($rec->location_id)
		{
			// if add
			if ($add)
			{
				
			}
			else
			{
				// subtract
			}
		}
	}
}
