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

$fixInfo = $this->fix_info;
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="intro-list-main-item">
			<label>Khách sạn <?php echo $this->category->title; ?> </label>
			<?php /*<span class="icons quote fltlft"></span>
			<span class="fltlft hotel-quote">
				Nếu khách sạn của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			
			<a class="button fltlft" href="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.add'); ?>">
				Tạo mới khách sạn
			</a>
			 *
			 */ ?>
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->
	
	<?php echo NtripFrontHelper::itemsMenu('hotels'); ?>
	<?php # echo LocaHelper::renderModulesOnPosition('menu-main-items'); ?>
	
	<div class="clr"></div>
	
	
	<div class="list-main-items-content">
	<?php /*
		<ul class="tab-list-main">
			<li class="active">
				<a href="#">
					Thích nhiều nhất
				</a>
			</li>
			<li>
				<a href="#">
					Rẻ nhất
				</a>
			</li>
			<li>
				<a href="#">
					Mới nhất
				</a>
			</li>
			<div class="clr"></div>
		</ul>
		*/ ?>
		
		<!-- List khach san -->
		<div class="list-main-items-content list-items">
			<?php if (!empty($fixInfo->description)): ?>
			<div class="fix-info">
				<?php echo $fixInfo->description; ?>
			</div>
			<?php endif; ?>
			
			<!-- Start Featured items -->
			<ul>
				<?php
				foreach ($this->featured_items as $item):
					$link = JRoute::_('index.php?option=com_ntrip&view=hotel&id=' . $item->id . ':' . $item->alias, false);
				?>
				<li>
					
					<div class="clr"></div>
					
					<div class="img-container">
					
						<a class="title" href="<?php echo $link; ?>">
							<?php if (!empty($item->thumb)): ?>
							<img src="<?php echo $item->thumb; ?>" />
							<?php else: ?>
							NO IMAGE
							<?php endif; ?>
						</a>
					</div>
					<div class="content">
						<h1>
							<a class="title" href="<?php echo $link; ?>">
								*** <?php echo $item->name; ?>
							</a>
							
							<span class="fltlft full-star-over-yellow">
								<span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span>
							</span>
							
							
						</h1>
						
						<div class="clr item-address bold"><?php echo $item->address; ?></div>
						<?php
							// echo JHtml::_('string.truncate', strip_tags($item->description), 100);
							
							$string 	= strip_tags($item->description);
							$maxLength 	= 100;
							
							echo LocaHelper::mbCutWord($string, $maxLength);
						?>
						<div class="clear"></div>
					</div>
					<div class="clr"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<!-- End featured items -->
			
			<ul>
				<?php
				foreach ($this->items as $item):
					$link = JRoute::_('index.php?option=com_ntrip&view=hotel&id=' . $item->id . ':' . $item->alias, false);
				?>
				<li>
					
					<div class="clr"></div>
					
					<div class="img-container">
						<a class="title" href="<?php echo $link; ?>">
							<img src="<?php echo $item->thumb; ?>" />
						</a>
					</div>
					<div class="content">
						<h1>
							<a class="title" href="<?php echo $link; ?>">
								<?php echo $item->name; ?>
							</a>
							
							<span class="fltlft full-star-over-yellow">
								<span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span>
							</span>
							
							
						</h1>
						
						<div class="clr item-address bold"><?php echo $item->address; ?></div>
						<?php /*?>
						<b>Xếp hạng:</b> Khách sạn ở <?php echo $this->category->title; ?><br/>
						<b>Giá: </b><?php echo number_format((float)$item->price_from); ?> -
									<?php echo number_format((float)$item->price_to); ?> VNĐ/người <br />
						*/ ?>
						<?php
							// echo JHtml::_('string.truncate', strip_tags($item->description), 100);
							
							$string 	= strip_tags($item->description);
							$maxLength 	= 100;
							
							echo LocaHelper::mbCutWord($string, $maxLength);
						?>
						<div class="clear"></div>
						<?php /*?>
						<span class="full-star-over fltlft"><span class="star<?php echo round($item->user_rank); ?>"></span></span>
						<span class="fltlft total_votes"> <?php echo (int) $item->count_rating; ?> lượt đánh giá </span>
						<div class="clear"></div>
						<a class="promotion-link" href="#"></a>
						*/ ?>
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
