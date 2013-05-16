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
		<div class="intro-list-main-item">
			<label>Giải trí ở <?php echo $this->category->title; ?> </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft relax-quote">
				Nếu thông tin giải trí của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			<input type="button" value="Tạo mới Giải trí" class="fltlft" />
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->	
	
	<?php echo NtripFrontHelper::itemsMenu('relaxes'); ?>
	
	<div class="clr"></div>
	<div class="search-conditions">
		<div class="other-conditions">
			<div class="col">
				<label class="title">Đánh giá</label>
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-1"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-2"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-3"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-4"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-5"></div> </div>
			</div>
			<div class="col">
				<div class="style">
					<label class="title">Phong cách</label>
					<div style="float: left; margin-right: 10px;">
						<ul>
							<li class="row-input fltlft custom-field-input">
								<input type="checkbox" name="all" /> Tất cả
							</li>
							<?php
								foreach ($fields as $field):
							?>
							<li class="row-input fltlft custom-field-input">
								<input type="checkbox" name="all" /> <?php echo $field->title; ?>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="clr"></div>
	<div class="list-main-items-content">
		<ul class="tab-list-main">
			<li class="active">Thích nhiều nhất</li>
			<li>Rẻ nhất</li>
			<li>Mới nhất</li>
			<div class="clr"></div>
		</ul>
		<!-- List nha hang -->
		<div class="list-main-items-content">
			<ul>
				<?php foreach ($this->items as $item): ?>
				<li>
					<a class="title" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=relax&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
					<div class="img-container">
						<img src="<?php echo $item->images; ?>" />
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

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>