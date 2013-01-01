<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$jqueryFileUploadPath = JURI::root() . 'media/jquery-ui-upload/';
?>

<style>
</style>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'hotel.cancel' || document.formvalidator.isValid(document.id('hotel-form'))) {
			Joomla.submitform(task, document.getElementById('hotel-form'));
		}
	}
</script>

<!-- jQuery UI styles -->
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" id="theme">
<!-- jQuery Image Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.com/jQuery-Image-Gallery/css/jquery.image-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the jQuery UI progress bars -->
<link rel="stylesheet" href="<?php echo $jqueryFileUploadPath; ?>css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo $jqueryFileUploadPath; ?>css/jquery.fileupload-ui-noscript.css"></noscript>

<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="hotel-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_NTRIP_NEW_HOTEL') : JText::sprintf('COM_NTRIP_HOTEL_DETAILS', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>

				<li><?php echo $this->form->getLabel('type'); ?>
				<?php echo $this->form->getInput('type'); ?></li>

				<li>
					<?php echo $this->form->getLabel('hotel_class'); ?>
					<?php echo $this->form->getInput('hotel_class'); ?>
				</li>
				
				<li><?php echo $this->form->getLabel('address'); ?>
				<?php echo $this->form->getInput('address'); ?></li>

				<li><?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?></li>
				
				<li><?php echo $this->form->getLabel('phone'); ?>
				<?php echo $this->form->getInput('phone'); ?></li>

				<li><?php echo $this->form->getLabel('hotline'); ?>
				<?php echo $this->form->getInput('hotline'); ?></li>

				<li>
					<?php echo $this->form->getLabel('website'); ?>
					<?php echo $this->form->getInput('website'); ?>
				</li>

				<li>
					<?php echo $this->form->getLabel('email'); ?>
					<?php echo $this->form->getInput('email'); ?>
				</li>

				<li>
					<?php echo $this->form->getLabel('price_from'); ?>
					<?php echo $this->form->getInput('price_from'); ?>
				</li>

				<li>
					<?php echo $this->form->getLabel('price_to'); ?>
					<?php echo $this->form->getInput('price_to'); ?>
				</li>

				<li>
					<?php echo $this->form->getLabel('system_rank'); ?>
					<?php echo $this->form->getInput('system_rank'); ?>
				</li>

				<li>
					<?php echo $this->form->getLabel('user_rank'); ?>
					<?php echo $this->form->getInput('user_rank'); ?>
				</li>

				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>
				
				<?php /*
				<li>
					<?php echo $this->form->getLabel(''); ?>
					<?php echo $this->form->getInput(''); ?>
				</li>

				<li>
					<?php echo $this->form->getLabel(''); ?>
					<?php echo $this->form->getInput(''); ?>
				</li>
				 */ ?>

				<li>
					<?php echo $this->form->getLabel('images'); ?>
					<?php echo $this->form->getInput('images'); ?>
				</li>
				
				<?php 
				$introImages = ($this->item->images) ? $this->item->images : false; 
				?>

				<?php if ($introImages): ?>
				<li class="control-group form-inline">
					<?php echo $this->form->getLabel('del_image'); ?>
					<?php echo $this->form->getInput('del_image'); ?>
				</li>
				
				<li>
					<label>Intro image uploaded</label>
					<a href="<?php echo JUri::root() . $introImages; ?>" class="modal">
						<img src="<?php echo JUri::root() . $introImages; ?>" style="width: 100px;" />
					</a>
				</li>
				<?php endif; ?>

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>
			<div class="clr"> </div>
			
			<?php echo $this->form->getLabel('description'); ?>
			<?php echo $this->form->getInput('description'); ?>
			
			<div class="clr"> </div>
			
		</fieldset>
	</div>

<div class="width-40 fltrt">
	<?php echo JHtml::_('sliders.start', 'hotel-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

	<?php echo JHtml::_('sliders.panel', JText::_('COM_NTRIP_GROUP_LABEL_PUBLISHING_DETAILS'), 'publishing-details'); ?>
		<fieldset class="panelform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field): ?>
				<li><?php echo $field->label; ?>
					<?php echo $field->input; ?></li>
			<?php endforeach; ?>
			</ul>
		</fieldset>

	<?php echo JHtml::_('sliders.panel', JText::_('JGLOBAL_FIELDSET_METADATA_OPTIONS'), 'metadata'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<?php foreach($this->form->getFieldset('metadata') as $field): ?>
					<li><?php echo $field->label; ?>
						<?php echo $field->input; ?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
	
	<?php echo JHtml::_('sliders.panel', JText::_('Other Images'), 'metadata'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<li id="fileupload">
					<!-- Redirect browsers with JavaScript disabled to the origin page -->
					<noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
					<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
					<div class="row fileupload-buttonbar">
						<div class="span7">
							<!-- The fileinput-button span is used to style the file input field as button -->
							<span class="btn btn-success fileinput-button">
								<i class="icon-plus icon-white"></i>
								<span>Add files...</span>
								<input type="file" name="files[]" multiple>
								
							</span>
						</div>
						<div class="clr"></div>
						<!-- The global progress information -->
						<div class="span5 fileupload-progress fade">
							<!-- The global progress bar -->
							<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								<div class="bar" style="width:0%;"></div>
							</div>
							<!-- The extended global progress information -->
							<div class="progress-extended">&nbsp;</div>
						</div>
					</div>
					<!-- The loading indicator is shown during file processing -->
					<div class="fileupload-loading"></div>
					<br>
					<!-- The table listing the files available for upload/download -->
					<table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>

				</li>
			</ul>
		</fieldset>

	<?php echo JHtml::_('sliders.end'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>

<div class="clr"></div>
</form>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td class="start">{% if (!o.options.autoUpload) { %}
                
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
<!-- jQuery Image Gallery -->
<script src="http://blueimp.github.com/jQuery-Image-Gallery/js/jquery.image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo $jqueryFileUploadPath; ?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo $jqueryFileUploadPath; ?>js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="<?php echo $jqueryFileUploadPath; ?>js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo $jqueryFileUploadPath; ?>js/jquery.fileupload-ui.js"></script>
<!-- The File Upload jQuery UI plugin -->
<script src="<?php echo $jqueryFileUploadPath; ?>js/jquery.fileupload-jui.js"></script>
<!-- The main application script -->
<script src="<?php echo $jqueryFileUploadPath; ?>js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="<?php echo $jqueryFileUploadPath; ?>js/cors/jquery.xdr-transport.js"></script><![endif]-->
