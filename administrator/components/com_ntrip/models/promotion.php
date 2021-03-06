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
 * Promotion model.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 * @since       1.6
 */
class NtripModelPromotion extends JModelAdmin
{
	/**
	 * @var    string  The prefix to use with controller messages.
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_NTRIP_PROMOTION';

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
	public function getTable($type = 'Promotion', $prefix = 'NtripTable', $config = array())
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
		$form = $this->loadForm('com_ntrip.promotion', 'promotion', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('promotion.id'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
		    // Disable fields for display.
		    $form->setFieldAttribute('ordering', 'disabled', 'true');
		    $form->setFieldAttribute('publish_up', 'disabled', 'true');
		    $form->setFieldAttribute('publish_down', 'disabled', 'true');
		    $form->setFieldAttribute('state', 'disabled', 'true');
		    $form->setFieldAttribute('sticky', 'disabled', 'true');

		    // Disable fields while saving.
		    // The controller has already verified this is a record you can edit.
		    $form->setFieldAttribute('ordering', 'filter', 'unset');
		    $form->setFieldAttribute('publish_up', 'filter', 'unset');
		    $form->setFieldAttribute('publish_down', 'filter', 'unset');
		    $form->setFieldAttribute('state', 'filter', 'unset');
		    $form->setFieldAttribute('sticky', 'filter', 'unset');
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
		$data = JFactory::getApplication()->getUserState('com_ntrip.edit.promotion.data', array());

		if (empty($data))
		{
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('promotion.id') == 0)
			{
				$app = JFactory::getApplication();
				$data->set('catid', JRequest::getInt('catid', $app->getUserState('com_ntrip.promotions.filter.category_id')));
			}
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
	    
	    $item->other_images = NtripHelper::getImages($item->id, 'promotions');
	    
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
	    if (parent::save($data))
	    {
			$id = (int) $this->getState($this->getName() . '.id');

			// Update images
//			$currentImages = (isset($_POST['current_images'])) ? $_POST['current_images'] : array();
//			NtripHelper::updateImages($id, $currentImages, 'promotions');
			
			// Update images
			$currentImages = (isset($_POST['current_images'])) ? $_POST['current_images'] : array();
			$currentDesc = (isset($_POST['current_desc'])) ? $_POST['current_desc'] : array();
			NtripHelper::updateImages($id, $currentImages, $currentDesc, 'promotions');

			// Temp files
			if (isset($_POST['tmp_other_img']))
			{
				// Copy file 
				NtripHelper::copyTempFiles($id, $_POST['tmp_other_img'], 'promotions');
				// Insert images
				NtripHelper::insertImages($id, $_POST['tmp_other_img'], $_POST['tmp_desc'], 'promotions');
			}

			if ($id)
				$data['id'] = $id;

			$delImage = isset($data['del_image']) ? $data['del_image'] : null;

			// Upload thumb
			$item = $this->getItem();
			$data['images'] = NtripHelper::uploadImages('images', $item, $delImage, 'promotions');
			
			$coordinates = LocaHelper::getGmapCoordinates($data['address']);
			
			$data['gmap_lat'] = $coordinates['lat'];
			$data['gmap_long'] = $coordinates['long'];
			
			// update content
			$content = NtripHelper::copyFilesOnSave($data['description'], 'promotions', $id);
				
			if ($content)
				$data['description'] = $content;

			return parent::save($data);
	    }

	    return false;
	}
}
