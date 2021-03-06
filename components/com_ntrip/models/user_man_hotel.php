<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Hotel model.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 * @since       1.6
 */
class NtripModelUser_Man_Hotel extends JModelAdmin
{
	/**
	 * @var    string  The prefix to use with controller messages.
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_NTRIP_HOTEL';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 *
	 * @since   1.6
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->state != -2)
			{
				return;
			}
			$user = JFactory::getUser();

			if (!empty($record->catid))
			{
				return $user->authorise('core.delete', 'com_ntrip.category.' . (int) $record->catid);
			}
			else
			{
				return parent::canDelete($record);
			}
		}
	}

	/**
	 * Method to test whether a record can have its state changed.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
	 *
	 * @since   1.6
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		// Check against the category.
		if (!empty($record->catid))
		{
			return $user->authorise('core.edit.state', 'com_ntrip.category.' . (int) $record->catid);
		}
		// Default to component settings if category not known.
		else
		{
			return parent::canEditState($record);
		}
	}

	/**
	 * Returns a JTable object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate. [optional]
	 * @param   string  $prefix  A prefix for the table class name. [optional]
	 * @param   array   $config  Configuration array for model. [optional]
	 *
	 * @return  JTable  A database object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Hotel', $prefix = 'NtripTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form. [optional]
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not. [optional]
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_ntrip.user_man_hotel', 'user_man_hotel', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_ntrip.edit.user_man_hotel.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
	
	/**
	 * 
	 * @param int $pk
	 * @return object
	 */
	function getItem($pk = null)
	{
	    $item = parent::getItem($pk);
	    
	    $id = $item->id;
	    
	    if (isset($id) && (int) $id > 0)
	    {
	    	if (!NtripFrontHelper::checkUserPermissionOnItem($id, '#__ntrip_hotels'))
	    		exit();
	    }
	    
	    $item->other_images = NtripHelper::getImages($item->id, 'hotels');
	    
	    return $item;
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param   JTable  $table  A record object.
	 *
	 * @return  array  An array of conditions to add to add to ordering queries.
	 *
	 * @since   1.6
	 */
	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'catid = '. (int) $table->catid;
		$condition[] = 'state >= 0';
		return $condition;
	}
	
	public function save($data) 
	{
		// always set state is unpublish for each save
		$data['state'] = 0;
		
		$id = $data['id'];
		 
		if (isset($id) && (int) $id > 0)
		{
			if (!NtripFrontHelper::checkUserPermissionOnItem($id, '#__ntrip_hotels'))
				exit();
		}
		
	    if (parent::save($data))
	    {
			$id = (int) $this->getState($this->getName() . '.id');

			// Update images
			$currentImages = (isset($_POST['current_images'])) ? $_POST['current_images'] : array();
			$currentDesc = (isset($_POST['current_desc'])) ? $_POST['current_desc'] : array();
			NtripHelper::updateImages($id, $currentImages, $currentDesc, 'hotels');

			// Temp files
			if (isset($_POST['tmp_other_img']))
			{
				// Copy file 
				NtripHelper::copyTempFiles($id, $_POST['tmp_other_img'], 'hotels');
				// Insert images
				NtripHelper::insertImages($id, $_POST['tmp_other_img'], $_POST['tmp_desc'], 'hotels');
			}

			if ($id)
				$data['id'] = $id;

			$delImage = isset($data['del_image']) ? $data['del_image'] : null;

			// Upload thumb
			$item = $this->getItem();
			$data['images'] = NtripHelper::uploadImages('images', $item, $delImage, 'hotels');
			
			$coordinates = LocaHelper::getGmapCoordinates($data['address']);
			
			$data['gmap_lat'] = $coordinates['lat'];
			$data['gmap_long'] = $coordinates['long'];

			return parent::save($data);
	    }

	    return false;
	}
}
