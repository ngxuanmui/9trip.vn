<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_ntrip.category');
$saveOrder	= $listOrder=='ordering';
$params		= (isset($this->state->params)) ? $this->state->params : new JObject();
?>


<div id="top-adv">
	<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
</div>
<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category">
			Quản lý dịch vụ
		</div>
		<div class="profile-menu">
			<?php echo LocaHelper::renderModulesOnPosition('profile-menu') ?>
		</div>
		<div class="tabs">
			<ul class="tab-categories">
				<li class=""><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_hotels'); ?>">Khách sạn</a></li>
				<li class="even"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_restaurants'); ?>">Nhà hàng</a></li>
				<li class="active"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_tours'); ?>">Tham quan</a></li>
				<li class="even" ><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_services'); ?>">Dịch vụ</a></li>
				<li><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_shoppings'); ?>">Mua sắm</a></li>
				<li class="even"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_relaxes'); ?>">Giải trí</a></li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="list-hotels-container" style="padding: 10px 0; margin-top: 0">
			<form action="index.php" method="post" name="userForm" id="userForm">
				<table class="list-user-hotels" cellpadding="10" border="0" cellspacing="0" width="98%">
					<tr class="oven header">
						<th>
							Tiêu đề
						</th>
						<th>
							Trạng thái
						</th>
						<th>
							Tỉnh thành
						</th>
						<th>
							Comment
						</th>
					</tr>

					<?php foreach ($this->items as $i => $item): ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'tours.', true); ?>
							<?php endif; ?>

							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&task=tour.edit&id='.(int) $item->id); ?>">
								<?php echo $this->escape($item->name); ?>
							</a>
						</td>
						<td class="center">
							<?php echo JHtml::_('jgrid.published', $item->state, $i, 'tours.', false, 'cb', $item->publish_up, $item->publish_down); ?>
						</td>
						<td class="center">
							<?php echo $this->escape($item->category_title); ?>
						</td>
						<td class="center">
							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=comments&type=tour&item_id='.$item->id); ?>">
								Bình luận
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			
			<div class="clear">
				<div class="pagination fltleft" style="background: #fff;"><?php echo $this->pagination->getPagesLinks();//$this->pagination->getListFooter(); ?></div>
				<div class="fltright">
					<input type="hidden" name="task" value="" />
					<?php echo JHtml::_('form.token'); ?>
					<?php echo Ntrip_User_Toolbar::buttonList('user_man_tour'); ?>
				</div>
				<div class="clear"></div>
			</div>
			</form>
		</div>
	</div>
</div>

<div id="right-content">
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>