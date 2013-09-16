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

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'relax.cancel' || document.formvalidator.isValid(document.id('relax-form'))) {
			Joomla.submitform(task, document.getElementById('relax-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="relax-form" class="form-validate" enctype="multipart/form-data">
<div id="left-content">
	<div class="container-edit-page">
		<h1><?php if ($this->item->id) echo 'Sửa thông tin'; else echo 'Thêm mới'; ?> giải trí</h1>
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
						Tiêu đề:
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

						$path = JURI::root() . 'images/relaxes/' . $this->item->id . '/';

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

				<input type="hidden" name="task" value="user_man_relax.apply" />
				<?php echo JHtml::_('form.token'); ?>

				<?php echo Ntrip_User_Toolbar::buttonEdit('user_man_relax'); ?>
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