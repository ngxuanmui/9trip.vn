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
			JText::_('COM_NTRIP_SUBMENU_CATEGORIES_CUSTOM_VISIT_TIME'),
			'index.php?option=com_categories&extension=com_ntrip.custom_visit_time',
			$vName == 'categories' && $extension == 'com_ntrip.custom_visit_time'
		);
		if ($vName=='categories' && $extension == 'com_ntrip.custom_visit_time') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_ntrip_custom_field_hotel')),
				'hotels-categories');
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
	
	static function insertImages($itemId, $images = array(), $itemType = 'hotels')
	{
	    $db = JFactory::getDbo();
	    
	    foreach ($images as $img)
	    {
		$query = $db->getQuery(true);
		$query->insert('#__ntrip_images (item_id, item_type, title, description, images)')
			->values($itemId . ', "' . $itemType . '", "", "", "' . $img . '"' );
		
		$db->setQuery($query);
		$db->query();
		
		if ($db->getErrorMsg())
		    die($db->getErrorMsg ());
	    }
	    
	    return true;
	}
	
	static function updateImages($itemId, $curentImages = array(), $itemType = 'hotels')
	{
	    $db = JFactory::getDbo();
	    
	    // get old images
	    $images = NtripHelper::getImages($itemId, $itemType);
	    
	    foreach ($images as $img)
	    {
		$image = $img->images;
		
		if (!in_array($image, $curentImages))
		{
		    // delete image
		    $destFolder = JPATH_ROOT . DS . 'images' . DS . $itemType . DS . $itemId . DS;	    
		    $destThumbFolder = $destFolder . 'thumbnail' . DS;
		    
		    @unlink($destThumbFolder . $image);
		    @unlink($destFolder . $image);
		    
		    // delete rec in db
		    $query = $db->getQuery(true);
		    $query->delete('#__ntrip_images')
			    ->where('item_id = ' . $itemId)
			    ->where('item_type = "'.$itemType.'"')
			    ->where('images = "' . $image . '"');
		    
		    $db->setQuery($query);
		    $db->query();
		}
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
	    $rs = $db->loadObjectList();
	    
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
}
