<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category">
			<?php echo $item->title; ?>
		</div>
		
		<div class="item-container item-detail">
			<div class="address"><?php echo $item->address; ?></div>
			<div class="contact">
				<span class="website">Website</span>
				<span class="email">Email</span>
				<span class="phone">Phone</span>
			</div>
			
			<div class="info">
				<div class="img">
					<img src="<?php echo $item->images; ?>" />
				</div>
				
				<div class="info">
					<p class="ranking">Xếp hạng 1/35 nhà hàng ở Quảng Ninh</p>
					<p class="rating">3 * 256 đánh giá</p>
					<p class="description">
						<?php echo $item->description; ?>
					</p>
				</div>
				
				<div class="clr"></div>
			</div>
			
			<div class="other-images">
				<h3>Cơ sở vật chất</h3>
				
				<ul>
					<?php foreach ($this->otherImages as $img): ?>
					<li class="img">
						<img src="images/restaurants/<?php echo $item->id; ?>/thumbnail/<?php echo $img->images; ?>" />
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			
			<div class="clr"></div>
		</div>
		
		<div class="comments">
			Comment here
		</div>
		
		<?php if (!empty($this->otherItems)): ?>		
		<div class="other-items">
			<ul>
				<?php foreach ($this->otherItems as $other): ?>
				<li>
					<div class="img">
						<img src="<?php echo $item->images; ?>" />
					</div>				
					
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>		
		<?php endif; ?>
		
		<div class="clr"></div>
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