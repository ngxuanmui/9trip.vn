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

<div id="top-adv">
	<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
</div>
<div class="clear"></div>

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.apply&id='.(int) $this->item->id); ?>" method="post" name="userForm" id="hotel-form" class="form-validate" enctype="multipart/form-data">
<div id="left-content">
	<div class="container-edit-page">
		<h1>Thêm mới khách sạn</h1>
		<div class="saparate-line-breakcrum"></div>
		<div style="padding: 10px">
			<div>
				<label class="title-field">Địa chỉ:</label>
				<span class="fltrt note">(Tối đa 250 ký tự)</span>
			</div>
			<?php echo $this->form->getInput('address'); ?>

			<div>
				<label class="title-field">Tên khách sạn:</label>
				<span class="fltrt note">(Tối đa 250 ký tự)</span>
			</div>
			<?php echo $this->form->getInput('name'); ?>

			<div class="clear">
				<label class="title-field">Dịch vụ:</label>
				<div class="clear"></div>
				<?php echo $this->form->getInput('type'); ?>
			</div>
			<div class="clear"></div>

			<div class="clear">
				<label class="title-field">Tỉnh thành:</label>
				<?php echo $this->form->getInput('catid'); ?>
			</div>			
			<div class="clear"></div>

			<div class="fltlft col">
				<label class="title-field">Website:</label>
				<div><?php echo $this->form->getInput('website'); ?></div>
			</div>
			<div class="fltlft col">
				<label class="title-field">Email liên hệ:</label>
				<div><?php echo $this->form->getInput('email'); ?></div>
			</div>
			<div class="clear"></div>

			<div class="fltlft col">
				<label class="title-field">Điện thoại:</label>
				<div><?php echo $this->form->getInput('hotline'); ?></div>
			</div>
			<div class="clear"></div>

			<div>
				<label class="title-field">Mô tả:</label>
				<span class="fltrt note">(Tối đa 250 ký tự)</span>
			</div>
			<div class="clear"><?php echo $this->form->getInput('description'); ?></div>

			<div class="fltlft col">
				<label class="title-field">Giá từ:</label>
				<div><?php echo $this->form->getInput('price_from'); ?></div>
			</div>
			<div class="fltlft col">
				<label class="title-field">Đến:</label>
				<div><?php echo $this->form->getInput('price_to'); ?></div>
			</div>
			<div class="clear"></div>

			<div class="fltlft col">
				<label class="title-field">Trạng thái:</label>
				<div><?php echo $this->form->getInput('state'); ?></div>
			</div>
			<div class="clear"></div>

			<div class="col">
				<label class="title-field">Cơ sở vật chất:</label>
			</div>
			<div class="clear">
				<div class="fltlft"><?php echo $this->form->getInput('images'); ?></div>
				<div class="fltright">
					<a href="#" class="icons loca-button"><span class="txt-btn">Thêm ảnh</span></a>
				</div>
			</div>

			<?php
				$introImages = ($this->item->images) ? $this->item->images : false;
			?>

			<?php if ($introImages): ?>
			<div class="fltlft">
				<label>Xóa ảnh</label>
				<?php echo $this->form->getInput('del_image'); ?>
			</div>
			<label>Intro image uploaded</label>
			<a href="<?php echo JUri::root() . $introImages; ?>" class="modal">
				<img src="<?php echo JUri::root() . $introImages; ?>" style="width: 100px;" />
			</a>
			<?php endif; ?>
			<div class="clear">
				<div class="fltlft" style="margin-right: 10px;"><a href="#" class="icons loca-button"><span class="txt-btn">LƯU THÔNG TIN</span></a></div>
				<div class="fltlft"><a href="#" class="icons loca-button"><span class="txt-btn">TẠO KHÁCH SẠN MỚI</span></a></div>
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

<!--
<div class="width-40 fltrt">
	<fieldset class="panelform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field): ?>
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
					
					$path = JURI::root() . 'images/hotels/' . $this->item->id . '/';
					
					if ($images):
					?>
					<table width="100%">
					    <?php foreach ($images as $img): ?>
					    <tr>
						<td width="80">
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
	
	<input type="hidden" name="task" value="user_man_hotel.apply" />
	<?php echo JHtml::_('form.token'); ?>
</div>

	<?php echo Ntrip_User_Toolbar::buttonEdit('user_man_hotel'); ?>

<div class="clr"></div>
</form>-->