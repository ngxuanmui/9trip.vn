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
	
	var ITEM_ID = <?php echo ($this->item->item_id) ? $this->item->item_id : 0; ?>;
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'promotion.cancel' || document.formvalidator.isValid(document.id('promotion-form'))) {
			Joomla.submitform(task, document.getElementById('promotion-form'));
		}
	}
	
	jQuery(function($){
		$('#jform_item_type').change(function(){
			var val = $(this).val();
			
			if (val == '')
			{
				$('#show-select-custom-item').css('display', 'none');
				$('#custom-item').css('display', 'block');
				return false;
			}
			
			var a = $('a.select-item');
			var href = a.attr('href').replace(/&item_id=[0-9]+&view=[a-z]+/, '');
			
			href += '&item_id=' + <?php echo ($this->item->item_id) ? $this->item->item_id : 0 ; ?>;
			href += '&view=' + $(this).val();
			
			a.attr('href', href);
			
			$('#custom-item').css('display', 'none');
			$('#show-select-custom-item').css('display', 'block');
		});
		
		$('#jform_item_type').change();
	});
</script>

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="promotion-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_NTRIP_NEW_PROMOTION') : JText::sprintf('COM_NTRIP_PROMOTION_DETAILS', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>

				<li><?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?></li>

				<li><?php echo $this->form->getLabel('item_type'); ?>
				    <?php echo $this->form->getInput('item_type'); ?>
				</li>
				
				<li><?php echo $this->form->getLabel('item_id'); ?>
				
					
					<div id="custom-item" style="line-height: 23px; float: left;">
						Please select type first
					</div>
					
					<div id="show-select-custom-item" style="display: none;">
						<?php echo $this->form->getInput('item_id'); ?>
					</div>
				
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
	<?php echo JHtml::_('sliders.start', 'promotion-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

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
				<li>
					<?php echo $this->form->getInput('uploadfile'); ?>
				</li>
				<li>
				    <div id="tmp-uploaded">
					<?php 
					$images = $this->item->other_images;
					
					$path = JURI::root() . 'images/promotions/' . $this->item->id . '/';
					
					if ($images):
					?>
					<table width="100%">
					    <?php foreach ($images as $img): ?>
					    <tr>
						<td width="80" style="background: #FAFAFA;">
						    <img src="<?php echo $path . 'thumbnail/' . $img->images; ?>" />
						    <input type="hidden" name="current_images[<?php echo $img->id; ?>]" value="<?php echo $img->images; ?>" />
						</td>
						<td valign="top">
							<?php echo $img->images . '<br><input type="text" size="40" name="current_desc['.$img->id.']" value="' . $img->description . '" placeholder="Input Description" />'; ?>
						</td>
						<td width="50" valign="top"><a href="javascript:;" class="delete-file">Del</a></td>
					    </tr>
					    <?php endforeach; ?>
					</table>
					<?php endif; ?>
				    </div>
				</li>
			</ul>
		</fieldset>

	<?php echo JHtml::_('sliders.end'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>

<div class="clr"></div>
</form>