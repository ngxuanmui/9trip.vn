<?php
// no direct access
defined('_JEXEC') or die;

$fields = $this->fields;
?>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category">
			Khuyến mại
		</div>
		
		<div class="clr"></div>
	</div>

	<div class="list-hotels-container">
		<div class="tabs">
			<ul class="tab-categories">
				<li class="active">Khuyến mại mới nhất</li>
				<li>Khuyến mại xem nhiều nhất</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="items">
			<ul class="list-promotions">
				<?php foreach ($this->items as $item): ?>
				<li>
					<div class="fltlft question-avatar-image">

					</div>
					<div class="promotion-content fltlft">

						<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=promotion&id=' . $item->id, false); ?>">
							<h3><?php echo $item->name; ?></h3>
						</a>
						<?php echo JHtml::_('string.truncate', $item->description, 100); ?>

						<div class="promotion-detail-info">
							<span class="user">Đăng bởi: <label class="author"><?php echo $item->author; ?></label></span> |
							<span class="datetime"><?php echo date("D, d/m/Y", strtotime('item->created')); ?></span> |
							<span class="counter"><?php echo $item->hits; ?> lượt</span> |
							<span class="no-reply">0 trả lời</span>
						</div>
					</div>

					<div class="promotion-info fltrgt">
						<div class="clr">
							<a class="like" href="#" id="like-<?php echo $item->id; ?>"> Thích</a> <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>
						</div>
						<div class="clr">Like FB</div>
						<div class="clr">Like G+</div>
					</div>
					<div class="clr saparate-line"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>


	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
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