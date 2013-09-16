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

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="userForm" id="tour-form" class="form-validate" enctype="multipart/form-data">
<div id="left-content">
	<div class="container-edit-page">
		<h1><?php if ($this->item->id) echo 'Sửa thông tin'; else echo 'Thêm mới'; ?> điểm tham quan</h1>
		<div class="saparate-line-breakcrum"></div>
		<div style="padding: 10px">
			<ul class="user-form">
				<li>
					<label>
						Địa chỉ:
						<span class="fltrt note">(Tối đa 250 ký tự)</span>
					</label>
					<?php echo $this->form->getInput('address'); ?>
				</li>
				<li>
					<label>
						Điểm tham quan:
						<span class="fltrt note">(Tối đa 250 ký tự)</span>
					</label>
					<?php echo $this->form->getInput('name'); ?>
				</li>
				<li>
					<label>
						Tỉnh / Thành:
					</label>
					<?php echo $this->form->getInput('catid'); ?>
				</li>
				<li>
					<label>
						Website:
					</label>
					<?php echo $this->form->getInput('website'); ?>
				</li>
				<li>
					<label>
						Email liên hệ:
					</label>
					<?php echo $this->form->getInput('email'); ?>
				</li>
				<li>
					<label>
						Điện thoại:
					</label>
					<?php echo $this->form->getInput('hotline'); ?>
				</li>
				<li>
					<label>
						Mô tả:
						<span class="fltrt note">(Tối đa 250 ký tự)</span>
					</label>
					<?php echo $this->form->getInput('description'); ?>
				</li>
				<li>
					<label>
						Ảnh giới thiệu
					</label>
					<?php echo $this->form->getInput('images'); ?>
				</li>
				<?php
				$introImages = ($this->item->images) ? $this->item->images : false;
				
				if ($introImages):
				?>
				<li>
					<label>Xóa ảnh</label>
					<?php echo $this->form->getInput('del_image'); ?>
				</li>
				<li>
					<label>Ảnh đã upload</label>
					<a href="<?php echo JUri::root() . $introImages; ?>" class="modal">
						<img src="<?php echo JUri::root() . $introImages; ?>" style="width: 100px;" />
					</a>
				</li>
				<?php endif; ?>
				
				<li>
					<label>&nbsp;</label>
					<?php echo $this->form->getInput('uploadfile'); ?>
				</li>
				
				<li>
					<div id="tmp-uploaded" style="margin-top: 10px;">
						<?php 
						$images = $this->item->other_images;
						
						$path = JURI::root() . 'images/tours/' . $this->item->id . '/';
						
						if ($images):
						?>
						<table width="100%" class="tbl-tmp-upload">
							    <?php foreach ($images as $img): ?>
							    <tr>
								<td width="80" style="background: #FAFAFA;">
								    <img src="<?php echo $path . 'thumbnail/' . $img->images; ?>" style="width: 80px;" />
								    <input type="hidden" name="current_images[<?php echo $img->id; ?>]" value="<?php echo $img->images; ?>" />
								</td>
								<td valign="top">
									<?php echo $img->images . '<br><input type="text" size="40" name="current_desc['.$img->id.']" value="' . $img->description . '" placeholder="Input Description" />'; ?>
								</td>
								<td width="50"><a href="javascript:;" class="delete-file">Xóa ảnh</a></td>
							    </tr>
							    <?php endforeach; ?>
							</table>
						<?php endif; ?>
				    </div>
				</li>
				
			</ul>
			
			<div class="clear" style="margin: 10px 0 0;">
			
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
			
				<?php echo Ntrip_User_Toolbar::buttonEdit('user_man_tour'); ?>
			</div>
		</div>

		<div class="clear"></div>
	</div>
</div>
</form>


<div id="right-content">
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>


<!--	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_NTRIP_NEW_TOUR') : JText::sprintf('COM_NTRIP_TOUR_DETAILS', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>
				
				<li><?php echo $this->form->getLabel('address'); ?>
				<?php echo $this->form->getInput('address'); ?></li>

				<li><?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?></li>
				
				<li><?php echo $this->form->getLabel('phone'); ?>
				<?php echo $this->form->getInput('phone'); ?></li>

				<li><?php echo $this->form->getLabel('hotline'); ?>
				<?php echo $this->form->getInput('hotline'); ?></li>

				<li><?php echo $this->form->getLabel('website'); ?>
				    <?php echo $this->form->getInput('website'); ?>
				</li>

				<li><?php echo $this->form->getLabel('email'); ?>
				    <?php echo $this->form->getInput('email'); ?>

				<li><?php echo $this->form->getLabel('system_rank'); ?>
				    <?php echo $this->form->getInput('system_rank'); ?>
				</li>

				<li><?php echo $this->form->getLabel('user_rank'); ?>
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
	<fieldset class="panelform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field): ?>
				<li><?php echo $field->label; ?>
					<?php echo $field->input; ?></li>
			<?php endforeach; ?>
				
				<?php foreach($this->form->getFieldset('metadata') as $field): ?>
					<li><?php echo $field->label; ?>
						<?php echo $field->input; ?></li>
				<?php endforeach; ?>
					
				<li>
					<?php echo $this->form->getInput('uploadfile'); ?>
				</li>
				<li>
				    <div id="tmp-uploaded">
					<?php 
					$images = $this->item->other_images;
					
					$path = JURI::root() . 'images/shoppings/' . $this->item->id . '/';
					
					if ($images):
					?>
					<table width="100%">
					    <?php foreach ($images as $img): ?>
					    <tr>
						<td width="80" style="background: #FAFAFA;">
						    <img src="<?php echo $path . 'thumbnail/' . $img->images; ?>" />
						    <input type="hidden" name="current_images[]" value="<?php echo $img->images; ?>" />
						</td>
						<td valign="top"><?php echo $img->images . '<br><strong>' . $img->title . '</strong>'; ?></td>
						<td width="50" valign="top"><a href="javascript:;" class="delete-file">Del</a></td>
					    </tr>
					    <?php endforeach; ?>
					</table>
					<?php endif; ?>
				    </div>
				</li>
				
			</ul>
		</fieldset>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>

<div class="clr"></div>
</form>-->