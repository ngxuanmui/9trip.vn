<style type="text/css">
    #sbox-btn-close { display: none; }
</style>

<script type="text/javascript">
    function tmpUpload(files)
    {
	
	console.log(files);
	
	arrFiles = JSON.decode(files);
	
//	console.log(arrFiles.files);
	
	html = '<table width="100%">';
	
//	html += '<tr><td>' + files + '</td></tr>';
	
	Array.each(arrFiles, function(val){
	    
	    value = val['files'][0];
	    
	    console.log(value);
	    
	    if (value.size > 0)
	    {
		hidden = '<input type="hidden" name="other_img[]" value="' + value.name + '" />';

		html += '<tr>';

		html += '<td><img src="' + value.thumbnail_url + '" /></td>';
		html += '<td>' + value.name + '<br><strong>' + value.txt + '</strong></td>';
		html += '<td><a href="#">Del</a></td>';

		html += '</tr>';
	    }
	});
	
	html += '</table>'
	
	$('tmp-uploaded').set('html', html);
    }
</script>
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
		
		$linkUploadFile = JRoute::_('index.php?option=com_ntrip&view=uploadfile&tmpl=component&format=raw', false);
		
		$html = '<div class="fltlft" style="line-height: 23px;" id="uploaded">';
		
		$html .= '<a href="'.$linkUploadFile.'" class="modal" rel="{handler: \'iframe\', closable: 0}" id="uploadfile">Select Image</a>';
				
		$html .= '</div>';
		
		return $html;
	}
}
