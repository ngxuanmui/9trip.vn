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
		<div class="intro-list-hotel">
			<label> Khám phá </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft">
				Hãy chia sẻ những trải nghiệm của bạn về chuyến đi của mình,
				các chia sẻ thực tế của bạn sẽ giúp ích rất nhiều cho các
				thành viên khác.
			</span>
			<div class="clear"></div>
			<input type="button" value="Chia sẻ trải nghiệm" />
			<div class="clear"></div>
		</div>
		
		<!--<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft">
				Hãy chia sẻ những trải nghiệm của bạn về chuyến đi của mình, 
				các chia sẻ thực tế của bạn sẽ giúp ích rất nhiều cho các 
				thành viên khác.
			</span>
			
			<a href="#" class="icons loca-button fltlft">Chia sẻ trải nghiệm</a>
		</div>-->
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->	
	<ul>
		<?php foreach ($fields as $field): ?>
		<li>
			<a class="title" href="#"><?php echo $field->title; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	
	<ul class="tab-categories">
		<li>Khách sạn</li>
		<li class="active">Nhà hàng</li>
		<li class="">Giải trí</li>
		<li class="even">Tham quan</li>
		<li class="">Mua sắm</li>
		<li class="even">Dịch vụ</li>
	</ul>
	<div class="clr"></div>
	<div class="search-conditions">
		<div class="style">
			<label class="title">Phong cách</label>
			<div style="float: left; margin-right: 10px;">
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
				<div class="row-input"><input type="checkbox" name="all" /> Miền Bắc </div>
				<div class="row-input"><input type="checkbox" name="all" /> Miền Trung</div>
			</div>
			<div style="float: left; margin-right: 10px;">
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
				<div class="row-input"><input type="checkbox" name="all" /> Miền Bắc </div>
				<div class="row-input"><input type="checkbox" name="all" /> Miền Trung</div>
			</div>
			<div style="float: left; margin-right: 10px;">
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
				<div class="row-input"><input type="checkbox" name="all" /> Miền Bắc </div>
				<div class="row-input"><input type="checkbox" name="all" /> Miền Trung</div>
			</div>
		</div>
		<div class="other-conditions">
			<div class="col">
				<label class="title">Đánh giá</label>
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
			</div>
			<div class="col">
				<label class="title">Giá</label>
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
			</div>
			<div class="col">
				<label class="title">Tiêu chuẩn</label>
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="clr"></div>
	<div class="list-hotels-container">
		<ul class="tab-list-hotels">
			<li class="active">Thích nhiều nhất</li>
			<li>Rẻ nhất</li>
			<li>Mới nhất</li>
			<div class="clr"></div>
		</ul>
		<!-- List nha hang -->
		<div class="list-hotels-content">
			<ul>
				<?php foreach ($this->items as $item): ?>
				<li>
					<a class="title" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
					<div class="img-container">
						<img src="<?php echo $item->images; ?>" />
					</div>
					<div class="content">
						<b>Xếp hạng:</b> 1/35 nhà hàng ở Quảng Ninh <br/>
						<b>Giá: </b>120 - 150 000 VNĐ/người <br />
						<div class="rating-content">
							<img src="<?php echo JURI::base() . 'templates/loca/'; ?>images/rate.gif" />
						</div>
						<div class="description" style="display: none;">
							<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
						</div>

						<div class="rating-content">
							<img src="<?php echo JURI::base() . 'templates/loca/'; ?>images/rate.gif" />
							234 lượt đánh giá
						</div>
						<a class="promotion-link" href="#">KHuyến mại đặt 2 tặng 1 chỉ có tai nhà hàng Hạ Long</a>
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