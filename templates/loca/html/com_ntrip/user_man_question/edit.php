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

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_question.apply&id='.(int) $this->item->id); ?>" method="post" name="userForm" id="user_man_hotel-form" class="form-validate" enctype="multipart/form-data">
<div id="left-content">
	<div class="container-edit-page">
		<h1><?php if ($this->item->id) echo 'Sửa thông tin'; else echo 'Thêm mới'; ?> Câu hỏi</h1>
		<div class="saparate-line-breakcrum"></div>
		<div style="padding: 10px">
			<ul class="user-form">
				
				<li>
					<label>
						Tỉnh / Thành:
					</label>
					<?php echo $this->form->getInput('catid'); ?>
				</li>
				
				<li>
					<label>
						Tiêu đề
						<span class="fltrt note">(Tối đa 250 ký tự)</span>
					</label>
					<?php echo $this->form->getInput('title'); ?>
				</li>

			</ul>
			
			<div class="clr"></div>
			
			<label><strong>Nội dung</strong></label>
			
			<?php echo $this->form->getInput('content'); ?>
			

			<div class="clear" style="margin: 10px 0 0;">

				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>

				<?php echo Ntrip_User_Toolbar::buttonEdit('user_man_question'); ?>
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