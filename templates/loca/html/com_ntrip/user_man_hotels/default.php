<?php
defined('_JEXEC') or die;

$items = $this->items;

//var_dump($items);
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
				<li class="active"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_hotels'); ?>">Khách sạn</a></li>
				<li class="even"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_restaurants'); ?>">Nhà hàng</a></li>
				<li><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_tours'); ?>">Tham quan</a></li>
				<li class="even" ><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_services'); ?>">Dịch vụ</a></li>
				<li><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_shoppings'); ?>">Mua sắm</a></li>
				<li class="even"><a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=user_man_relaxes'); ?>">Giải trí</a></li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="list-hotels-container" style="padding: 10px 0; margin-top: 0">
			<form method="post" action="<?php echo ''; ?>">
				<table class="list-user-hotels" cellpadding="10" border="0" cellspacing="0" width="98%">
					<tr class="oven">
						<th>Tiêu đề</th>
						<th>Tỉnh thành</th>
						<th>Rating</th>
						<th>Trạng thái</th>
					</tr>
					<?php foreach ($items as $key => $item): ?>
					<tr class="<?php if (($key+1) %2 == 0) echo 'oven' ?>">
						<td>
							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.edit&id='. $item->id . '&Itemid=' . JRequest::getInt('Itemid'), false); ?>">
								<?php echo $item->name; ?>
							</a>
						</td>
						<td><?php echo $item->category_title; ?></td>
						<td>
							<span class="full-star-over fltlft"><span class="star<?php echo round($item->user_rank); ?>"></span></span>
						</td>
						<td><?php echo ($item->state == 1) ? 'Yes' : 'No'; ?></td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="5">							
						</td>
					</tr>

					<!--<tr>
						<td colspan="10">
							<input type="hidden" name="task" value="" />
							<?php echo JHtml::_('form.token'); ?>
							<?php echo Ntrip_User_Toolbar::buttonList('user_man_hotel'); ?>
						</td>
					</tr>-->
				</table>
				<div class="clear">
					<div class="pagination fltleft" style="background: #fff;"><?php echo $this->pagination->getPagesLinks();//$this->pagination->getListFooter(); ?></div>
					<div class="fltright">
						<a href="#" class="icons loca-button"><span class="txt-btn">Thêm mới</span></a>
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
