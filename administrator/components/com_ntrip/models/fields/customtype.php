<?php

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Bannerclient Field class for the Joomla Framework.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class JFormFieldCustomType extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'CustomType';
	
	public function getInput()
	{
		$html = '<div id="custom-type" style="float: left; line-height: 23px;">
					Please select location first
				</div>';
		
		return $html;
	}
}