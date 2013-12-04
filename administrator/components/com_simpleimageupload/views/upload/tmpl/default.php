<?php
/**
 * @version		1.0
 * @package		simpleimageuploadplugin
 * @subpackage		com_simpleimageupload
 * @copyright		Copyright (C) 2012 tuts4you.de, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$params = JComponentHelper::getParams('com_simpleimageupload');
$folder		= $params->getValue('folderPath');
if($folder == "")
{
	$folder = $params->getValue('data.params.folderPath', 'images');
}

$saveInUserFolder = $params->getValue('saveInUserFolder');
if($saveInUserFolder == "")
{
	$saveInUserFolder = $params->getValue('data.params.saveInUserFolder', 0);
}
if($saveInUserFolder == "1" && !JFactory::getUser()->guest)
{
	$folder = $folder.DS.JFactory::getUser()->username;
}

?>

<?php if (JRequest::getVar('file') != ''): ?>
<form action="index.php?option=com_simpleimageupload" id="imageForm" method="post" enctype="multipart/form-data">
	<input type="hidden" id="f_url" value="<?php echo $folder.DS.JRequest::getVar('file') ?>" />

	<fieldset>
		<div class="commands">
			<button type="button" onclick="ImageManager.onok();window.parent.SqueezeBox.close();"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_INSERT') ?></button>
			<button type="button" onclick="window.parent.SqueezeBox.close();"><?php echo JText::_('JCANCEL') ?></button>
		</div>
	</fieldset>
	<fieldset>
		<table class="properties">
			<tr>
				<td><label for="f_url"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_URL') ?></label></td>
				<td><label><?php echo $folder.DS.JRequest::getVar('file') ?></label></td>
			</tr>
			<tr>
				<td><label for="f_align"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_ALIGN') ?></label></td>
				<td>
					<select size="1" id="f_align" >
						<option value="" selected="selected"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_NOTSET') ?></option>
						<option value="left"><?php echo JText::_('JGLOBAL_LEFT') ?></option>
						<option value="right"><?php echo JText::_('JGLOBAL_RIGHT') ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="f_alt"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_IMAGE_DESCRIPTION') ?></label></td>
				<td><input type="text" id="f_alt" value="" /></td>
			</tr>
			<tr>
				<td><label for="f_title"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_TITLE') ?></label></td>
				<td><input type="text" id="f_title" value="" /></td>
			</tr>
			<tr>
				<td><label for="f_caption"><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_CAPTION') ?></label></td>
				<td>
					<select size="1" id="f_caption" >
						<option value="" selected="selected" ><?php echo JText::_('JNO') ?></option>
						<option value="1"><?php echo JText::_('JYES') ?></option>
					</select>
				</td>
			</tr>
		</table>

		<input type="hidden" id="dirPath" name="dirPath" />
		<input type="hidden" id="image_file" name="image_file" />
		<input type="hidden" id="tmpl" name="component" />

	</fieldset>
</form>
<?php else: ?>
	<form action="<?php echo JURI::base(); ?>index.php?option=com_simpleimageupload&task=upload.upload&tmpl=component" id="uploadForm" name="uploadForm" method="post" enctype="multipart/form-data">
		<fieldset id="uploadform">
			<legend><?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_UPLOADIMAGETEXT'); // echo $this->config->get('upload_maxsize')=='0' ? JText::_('COM_SIMPLEIMAGEUPLOAD_UPLOADIMAGETEXT') : JText::sprintf('COM_MEDIA_UPLOAD_FILES', $this->config->get('upload_maxsize')); ?></legend>
			<fieldset id="upload-" class="actions">
				<input type="file" id="upload-file" name="Filedata" />
				<input type="submit" id="upload-submit" value="<?php echo JText::_('COM_SIMPLEIMAGEUPLOAD_START_UPLOAD'); ?>"/>
			</fieldset>
			<input type="hidden" name="return-url" value="<?php echo base64_encode('index.php?option=com_simpleimageupload&view=upload&tmpl=component&e_name='.JRequest::getCmd('e_name')); ?>" />
		</fieldset>
	</form>
<?php endif;?>