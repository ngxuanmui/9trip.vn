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
			<label>Khách sạn <?php echo $this->items[0]->category_title; ?> </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft hotel-quote">
				Nếu nhà hàng của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			<input type="button" value="Tạo mới nhà hàng" class="fltlft" />
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->	
	
	<?php echo NtripFrontHelper::itemsMenu('restaurants'); ?>
	
	<div class="clr"></div>
	<div class="search-conditions">
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
				<label class="title">Giá</label>
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
				<div class="row-input"><input type="checkbox" name="all" /> 0 VNĐ - 200N VNĐ </div>
				<div class="row-input"><input type="checkbox" name="all" /> 200 VNĐ - 500N VNĐ </div>
				<div class="row-input"><input type="checkbox" name="all" /> 500 VNĐ - 1TR VNĐ </div>
				<div class="row-input"><input type="checkbox" name="all" /> 1TR VNĐ - 2TR VNĐ </div>
				<div class="row-input"><input type="checkbox" name="all" />TRÊN 2TR VNĐ </div>

			</div>
			<div class="col">
				<label class="title">Tiêu chuẩn</label>
				<div class="row-input"><input type="checkbox" name="all" /> Tất cả </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-yellow1"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-yellow2"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-yellow3"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-yellow4"></div> </div>
				<div class="row-input"><input type="checkbox" name="all" /> <div class="star-yellow5"></div> </div>
				
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
					<a class="title" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=restaurant&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
					<div class="img-container">
						<img src="<?php echo $item->images; ?>" />
					</div>
					<div class="content">
						<b>Xếp hạng:</b> 1/35 nhà hàng ở Quảng Ninh <br/>
						<b>Giá: </b>120 - 150 000 VNĐ/người <br />
						<label class="fltlft label-criteria">Tiêu chí:</label>
						<span class="fltlft full-star-over-yellow"><span class="star-yellow<?php echo str_replace('.', '-', $item->restaurant_class); ?>"></span></span>
						<?php // echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
						<div class="clear"></div>
						<span class="full-star-over fltlft"><span class="star<?php echo round($item->user_rank); ?>"></span></span>
						<span class="fltlft total_votes"> <?php echo (int) $item->count_rating; ?> lượt đánh giá </span>
						<div class="clear"></div>
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