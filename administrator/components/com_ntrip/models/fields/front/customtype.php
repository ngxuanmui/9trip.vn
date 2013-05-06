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
class JFormFieldFront_CustomType extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Front_CustomType';
	
	public function getInput()
	{
		$html = '<div id="custom-type" style="float: left;">
					Vui lòng lựa chọn Tỉnh / Thành
				</div>';
		
		$html .= '<script type="text/javascript">EXTENSION="'.$this->element['extension'].'"</script>';
		
		return $html;
	}
}