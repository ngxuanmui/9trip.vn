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
	var ITEM_TYPE = 'fix_infos';
	var ITEM_ID = <?php echo ($this->item->id) ? $this->item->id : 0; ?>;
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'fix_info.cancel' || document.formvalidator.isValid(document.id('fix_info-form'))) {
			Joomla.submitform(task, document.getElementById('fix_info-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="fix_info-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('New') : JText::sprintf('Edit', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?></li>

				<li><?php echo $this->form->getLabel('type'); ?>
				<?php echo $this->form->getInput('type'); ?></li>

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
				

				<li>
					<?php echo $this->form->getLabel('images'); ?>
					<?php echo $this->form->getInput('images'); ?>
				</li>
				 */ ?>
				<?php
				/*
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
				<?php endif; */ ?>

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>
			<div class="clr"> </div>
			
			<?php echo $this->form->getLabel('description'); ?>
			<div class="clr"> </div>
			<?php echo $this->form->getInput('description'); ?>
			
			<div class="clr"> </div>
			<?php echo $this->form->getInput('images2content'); ?>
			<div class="clr"> </div>
			
			<?php echo $this->form->getLabel('content'); ?>
			<div class="clr"> </div>
			<?php echo $this->form->getInput('content'); ?>
			
		</fieldset>
	</div>

<div class="width-40 fltrt">
	<?php echo JHtml::_('sliders.start', 'fix_info-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

	<?php echo JHtml::_('sliders.panel', JText::_('COM_NTRIP_GROUP_LABEL_PUBLISHING_DETAILS'), 'publishing-details'); ?>
		<fieldset class="panelform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field): ?>
				<li><?php echo $field->label; ?>
					<?php echo $field->input; ?></li>
			<?php endforeach; ?>
			</ul>
		</fieldset>

	<?php echo JHtml::_('sliders.end'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>

<div class="clr"></div>
</form>