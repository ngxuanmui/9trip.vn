<?php
// no direct access
defined('_JEXEC') or die;

$items = $this->items;

$fields = $this->fields;

$arrSearch = array(
					'common'	=> array('all' => 'Tất cả', 1, 2, 3, 4, 5),
					'price'		=> array(
											'all' => 'Tất cả', 
											1 => '0 VNĐ - 200N VNĐ', 
											2 => '200 VNĐ - 500N VNĐ', 
											3 => '500 VNĐ - 1TR VNĐ', 
											4 => '1TR VNĐ - 2TR VNĐ', 
											5 => 'TRÊN 2TR VNĐ'
									)
			);

$customField = explode(',', JRequest::getString('custom_field'));
$rating = explode(',', JRequest::getString('rating'));
$price = explode(',', JRequest::getString('price'));
$criteria = explode(',', JRequest::getString('criteria'));
?>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="intro-list-main-item">
			<label>Khách sạn <?php echo $this->category->title; ?> </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft hotel-quote">
				Nếu khách sạn của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			<a class="button fltlft" href="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.add'); ?>">
				Tạo mới khách sạn
			</a>
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->	
	
	<?php # echo NtripFrontHelper::itemsMenu('hotels'); ?>
	<?php echo LocaHelper::renderModulesOnPosition('menu-main-items'); ?>
	
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
					<a class="title" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=hotel&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
					<div class="img-container">
						<img src="<?php echo $item->images; ?>" />
					</div>
					<div class="content">
						<b>Xếp hạng:</b> Khách sạn ở <?php echo $this->category->title; ?><br/>
						<b>Giá: </b><?php echo (int) number_format((int)$item->price_from); ?> - 
									<?php echo (int) number_format((int)$item->price_to); ?> VNĐ/người <br />
						<label class="fltlft label-criteria">Tiêu chí:</label>
						<span class="fltlft full-star-over-yellow"><span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span></span>
						<?php // echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
						<div class="clear"></div>
						<span class="full-star-over fltlft"><span class="star<?php echo round($item->user_rank); ?>"></span></span>
						<span class="fltlft total_votes"> <?php echo (int) $item->count_rating; ?> lượt đánh giá </span>
						<div class="clear"></div>
						<a class="promotion-link" href="#"></a>
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

	<?php echo LocaHelper::renderModulesOnPosition('loca-filter', array('fields' => $fields, 'show' => array('price' => true, 'criteria' => true))); ?>
	
	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>