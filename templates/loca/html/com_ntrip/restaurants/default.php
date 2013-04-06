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
			Nhà hàng
		</div>
		
		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft">
				Nếu nhà hàng của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			
			<a href="#" class="icons loca-button fltlft">Tạo mới nhà hàng</a>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<?php echo Ntrip_User_Toolbar::itemsMenu(); ?>
	
	<ul>
		<li>
			<h3>Phong cách</h3>
			<ul>
				<li><input type="checkbox" name="" value="" /> Tất cả</li>
				<?php foreach ($fields as $field): ?>
				<li>
					<input type="checkbox" name="" value="" /> <?php echo $field->title; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li>
			<h3>Giá</h3>
			<ul>
				<li>
					<input type="checkbox" name="" value="" /> Tất cả
				</li>
				<li><input type="checkbox" name="" value="" /> 0 VNĐ - 200N VNĐ</li>
				<li><input type="checkbox" name="" value="" /> 200N VNĐ - 500N VNĐ</li>
				<li><input type="checkbox" name="" value="" /> 500N VNĐ - 1TR VNĐ</li>
				<li><input type="checkbox" name="" value="" /> 1TR VNĐ - 2TR VNĐ</li>
				<li><input type="checkbox" name="" value="" /> Trên 2TR VNĐ</li>
			</ul>
		</li>
		<li>
			<h3>Đánh giá</h3>
			<ul>
				<li><input type="checkbox" name="" value="" /> Tất cả</li>
				<li><input type="checkbox" name="" value="" /> 1 *</li>
				<li><input type="checkbox" name="" value="" /> 2 *</li>
				<li><input type="checkbox" name="" value="" /> 3 *</li>
				<li><input type="checkbox" name="" value="" /> 4 *</li>
				<li><input type="checkbox" name="" value="" /> 5 *</li>
			</ul>
		</li>
	</ul>
	
	<div class="clr"></div>
	
	<div class="margin-bottom5">
		<div class="title-category">
			Kết quả tài trợ
		</div>
		
		<div class="item-container">
			<ul>
				<li>
					abc
				</li>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<div class="items">
		<div class="list-items-menu">
			<span class="mostlike">Thích nhiều nhất</span>
			<span class="cheapest">Rẻ nhất</span>
			<span class="newest">Mới nhất</span>
		</div>
		<div class="clr"></div>
		
		<ul class="list-restaurants">
			<?php foreach ($this->items as $item): ?>
			<li>
				<h2>
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=restaurant&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
				</h2>
				
				<div class="img">
					<img src="<?php echo $item->images; ?>" />
				</div>
				
				<div class="info">
					<p class="ranking">Xếp hạng 1/35 nhà hàng ở Quảng Ninh</p>
					<p class="price">Giá: <?php echo number_format($item->price_from) . ' - ' . number_format($item->price_to); ?> VNĐ / 1 người</p>
					<p class="rating">3 * 256 đánh giá</p>
					<p class="description">
						<?php echo $item->description; ?>
					</p>
				</div>
				
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
	</div>
	
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