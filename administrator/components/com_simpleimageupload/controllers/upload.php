<?php
/**
 * @copyright	        Copyright (C) 2012 http://tuts4you.de All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');

/**
 * SimpleImageUpload File Controller
 *
 * @package		SimpleImageUploadPlugin
 * @subpackage		com_simpleImageUpload
 */
class SimpleImageUploadControllerUpload extends JController
{

	function upload()
	{
		// get the media Helper and the language
		require_once(JPATH_ADMINISTRATOR.'/components/com_media/helpers/media.php');
		$lang = JFactory::getLanguage();
		$lang->load('com_media', JPATH_ADMINISTRATOR);

		$params = JComponentHelper::getParams('com_simpleimageupload');

		// Get some data from the request
		$file		= JRequest::getVar('Filedata', '', 'files', 'array');
		$folder		= $params->getValue('folderPath');
		if($folder == "")
		{
			$folder = $params->getValue('data.params.folderPath', 'images');
		}

		$folder = JPATH_ROOT.DS.$folder;
		
		$saveInUserFolder = $params->getValue('saveInUserFolder');
		if($saveInUserFolder == "")
		{
			$saveInUserFolder = $params->getValue('data.params.saveInUserFolder', 0);
		}
		if($saveInUserFolder == "1" && !JFactory::getUser()->guest)
		{
			$folder = $folder.DS.JFactory::getUser()->username;
			
			if(!JFolder::exists($folder))
			{
				if(!JFolder::create($folder))
				{
					JError::raiseWarning(100, 'Cannot create folder');
					return false;
				}
			}
		}
		$return	= JRequest::getVar('return-url', null, 'post', 'base64');



		// Set the redirect
		//if ($return) {
		//	$this->setRedirect(base64_decode($return));
		//}



		// Make the filename safe
		$file['name']	= time().strtolower(JFile::makeSafe($file['name']));

		if (isset($file['name']))
		{
			// The request is valid
			$err = null;
			if (!MediaHelper::canUpload($file, $err))
			{
				JError::raiseNotice(100, JText::_($err));
				return false;
			}


			$filepath = JPath::clean($folder . '/' . strtolower($file['name']));

			// Trigger the onContentBeforeSave event.
			JPluginHelper::importPlugin('content');
			$dispatcher	= JDispatcher::getInstance();
			$object_file = new JObject($file);
			$object_file->filepath = $filepath;
			$result = $dispatcher->trigger('onContentBeforeSave', array('com_simpleimageupload.file', &$object_file));
			if (in_array(false, $result, true)) {
				JError::raiseWarning(100, JText::plural('COM_SIMPLEIMAGEUPLOAD_ERROR_BEFORE_SAVE', count($errors = $object_file->getErrors()), implode('<br />', $errors)));
				return false;
			}
			$file = (array) $object_file;


			$format = strtolower(JFile::getExt($file['name']));
			$allowedFormats = $params->getValue('allowedFormats');
			if($allowedFormats == "")
			{
				$allowedFormats = $params->getValue('data.params.allowedFormats', 'bmp,gif,jpg,png,jpeg');
			}
			$images = explode(',', $allowedFormats);
			if (!in_array($format, $images))
			{
				JError::raiseWarning(100, JText::_('COM_SIMPLEIMAGEUPLOAD_ERROR_UPLOAD_TYPE'));
				return false;
			}


			if (!JFile::upload($file['tmp_name'], $file['filepath']))
			{
				// Error in upload
				JError::raiseWarning(100, JText::_('COM_SIMPLEIMAGEUPLOAD_ERROR_UNABLE_TO_UPLOAD_FILE'));
				return false;
			}
			else
			{
				// Trigger the onContentAfterSave event.
				$dispatcher->trigger('onContentAfterSave', array('com_simpleimageupload.file', &$object_file, true));
				$this->setMessage(JText::sprintf('COM_SIMPLEIMAGEUPLOAD_UPLOAD_COMPLETE', substr($file['filepath'])));
				// eigenes
				$this->setRedirect(base64_decode($return).'&file=' . $file['name']);
				return true;
			}
		}
		else
		{
			$this->setRedirect('index.php', JText::_('COM_SIMPLEIMAGEUPLOAD_INVALID_REQUEST'), 'error');
			return false;
		}
	}
}
