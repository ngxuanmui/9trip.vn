<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Bannerclient Field class for the Joomla Framework.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class JFormFieldUploadFile extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'UploadFile';

	public function getInput() 
	{
		JHtml::_('behavior.modal');
		
		$linkUploadFile = 'index.php?option=com_ntrip&view=uploadfile&tmpl=component&format=raw';
		
		$html = '<div class="fltlft" style="line-height: 23px;" id="uploaded">';
		
		$html .= '<a href="'.$linkUploadFile.'" class="modal" rel="{handler: \'iframe\'}" id="uploadfile">Select Image</a>';
				
		$html .= '</div>';
		
		return $html;
	}
}
