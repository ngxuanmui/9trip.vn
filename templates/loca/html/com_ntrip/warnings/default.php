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
			Chia sẻ các cảnh báo du lịch <?php echo $this->items[0]->category_title; ?>
		</div>

		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft album-quote">
				Hãy chia sẻ những thắc mắc, những lo lắng của mình trước chuyến du lịch, 
				các chuyên gia và thành viên Loca.vn sẽ cùng thảo luận với bạn.
			</span>
			<a href="#" class="block icons loca-button fltlft"><span class="txt-btn">Chia sẻ trải nghiệm</span></a>
		</div>

		<div class="clr"></div>
	</div>
	
	<div class="tabs">
			<ul class="tab-categories">
				<li class="active">Mới nhất</li>
				<li class="even">Hữu ích nhất</li>
				<li>Trả lời nhiều nhất</li>
			</ul>
			<div class="clr"></div>
		</div>

	<div class="list-container">
		
		<div class="items">
			<ul class="list-warnings list-items">
				<?php foreach ($this->items as $item): ?>
				<li>
					<h2>
						<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=warning&id=' . $item->id . ':' . $item->alias, false); ?>">
							<?php echo $item->name; ?>
						</a>
					</h2>

					<div class="item-info">
						<span class="user"><?php echo $item->author; ?></span>
						<span class="datetime"><?php echo date("D, d/m/Y", strtotime('item->created')); ?></span>
						<span class="counter"><?php echo $item->hits; ?> lượt</span>
						<span class="no-reply">0 trả lời</span>
					</div>

					<div class="img">
						<img src="<?php echo $item->images; ?>" />
					</div>

					<div class="description"><?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?></div>
					<div class="clr" style="padding-top: 10px;"></div>
					<div class="social-info fltlft">
						<span>12 thành viên thích</span>
					</div>
					
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=warning&id=' . $item->id . ':' . $item->alias, false); ?>" class="block icons loca-button fltright">
						<span class="txt-btn">Chi tiết &raquo;</span>
					</a>
					<div class="clr"></div>
					<div class="saparate-line"></div>
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
