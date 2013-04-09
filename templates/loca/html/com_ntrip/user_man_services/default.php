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
				<li><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_tours'); ?>">Tham quan</a></li>
				<li class="active" ><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_services'); ?>">Dịch vụ</a></li>
				<li><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_shoppings'); ?>">Mua sắm</a></li>
				<li class="even"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_relaxes'); ?>">Giải trí</a></li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="list-hotels-container" style="padding: 10px 0; margin-top: 0">
			<form action="<?php echo JRoute::_('index.php?option=com_ntrip&view=services'); ?>" method="post" name="adminForm" id="adminForm">
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
								<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'hotels.', true); ?>
							<?php endif; ?>

							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&task=service.edit&id='.(int) $item->id); ?>">
								<?php echo $this->escape($item->name); ?>
							</a>							
						</td>
						<td class="center">
							<?php echo JHtml::_('jgrid.published', $item->state, $i, 'hotels.', false, 'cb', $item->publish_up, $item->publish_down); ?>
						</td>
						<td class="center">
							<?php echo $this->escape($item->category_title); ?>
						</td>
						<td class="center">
							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=comments&type=hotel&item_id='.$item->id); ?>">
								Bình luận
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="5">							
						</td>
					</tr>					
				</table>				
				<!--<div>
					<input type="hidden" name="task" value="" />
					<input type="hidden" name="boxchecked" value="0" />
					<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
					<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</div>-->
			</form>
			<div class="clear">
				<div class="pagination fltleft" style="background: #fff;"><?php echo $this->pagination->getPagesLinks();//$this->pagination->getListFooter(); ?></div>
				<div class="fltright">
					<a href="#" class="icons loca-button"><span class="txt-btn">Thêm mới</span></a>
				</div>
				<div class="clear"></div>
			</div>
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