<?php
// no direct access
defined('_JEXEC') or die;

$fields = $this->fields;
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="intro-list-main-item">
			<label>Giải trí ở <?php echo $this->category->title; ?> </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft relax-quote">
				Nếu thông tin giải trí của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			<?php /*
			<input type="button" value="Tạo mới Giải trí" class="fltlft" />
			 * 
			 */ ?>
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->	
	
	<?php echo NtripFrontHelper::itemsMenu('relaxes'); ?>
	
	<div class="clr"></div>
	
	<div class="list-main-items-content">
		<ul class="tab-list-main display-none">
			<li class="active">Thích nhiều nhất</li>
			<li>Mới nhất</li>
			<div class="clr"></div>
		</ul>
		<!-- List nha hang -->
		<div class="list-main-items-content list-items">
			<ul>
				<?php 
				foreach ($this->items as $item): 
					$link = JRoute::_('index.php?option=com_ntrip&view=relax&id=' . $item->id . ':' . $item->alias, false);
				?>
				<li>
					<a class="title" href="<?php echo $link; ?>" title="<?php echo $item->name; ?>">
						<?php echo $item->name; ?>
					</a>
					<div class="img-container">
						<a class="title" href="<?php echo $link; ?>" title="<?php echo $item->name; ?>">
							<img alt="<?php echo $item->alias; ?>" src="<?php echo $item->images; ?>" />
						</a>
					</div>
					<div class="content">
						<b>Xếp hạng:</b> giải trí ở <?php echo $this->category->title; ?> <br/>
						<?php // echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
						<div class="clear"></div>
						<span class="full-star-over fltlft"><span class="star<?php echo round($item->user_rank); ?>"></span></span>
						<span class="fltlft total_votes"> <?php echo (int) $item->count_rating; ?> lượt đánh giá </span>
						<div class="clear"></div>
					</div>
					<div class="clr"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	</div>
	
	
</div>

<div id="right-content">
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>
	
	<?php echo LocaHelper::renderModulesOnPosition('loca-filter', array('fields' => $fields)); ?>
	
	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>