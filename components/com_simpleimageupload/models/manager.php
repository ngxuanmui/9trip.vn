<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

/**
 * SimpleImageUpload Model
 *
 * @package		pkg_simpleimageupload
 * @subpackage		com_simpleimageupload
 * @since 1.5
 */
class SimpleImageUploadModelManager extends JModel
{

	function getState($property = null, $default = null)
	{
		static $set;

		if (!$set) {

			$fieldid = JRequest::getCmd('fieldid', '');
			$this->setState('field.id', $fieldid);

			$set = true;
		}

		return parent::getState($property, $default);
	}
}
