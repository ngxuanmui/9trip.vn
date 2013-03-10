<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;
?>

<div id="top-adv">
	<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
</div>
<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category list-hotels-content">
			<label><?php echo $item->name; ?></label>
		</div>

		<div class="hotel-container">
			<div class="address"><?php echo "Phường Hồng Hà, Thành Phố Hạ Long - Quảng Ninh"; ?></div>
			<div class="contact">
				<span class="website item">Website</span>
				<span class="email item">Email</span>
				<span class="phone item">Phone</span>
			</div>
			<div class="social-info">
				<img src="<?php echo JURI::base() . 'templates/loca/images/social-info.jpg'; ?>" />
			</div>

			<div class="info">
				<div class="img">
					<!--<img src="<?php echo $item->images; ?>" />-->
					<img src="<?php echo JURI::base() . 'templates/loca/images/hotel-detail.jpg'; ?>" />
				</div>

				<div class="content">
					<b>Xếp hạng:</b> 1/35 nhà hàng ở Quảng Ninh <br/>
					<b>Giá: </b>120 - 150 000 VNĐ/người <br />
					<div class="rating-content">
						<img src="<?php echo JURI::base() . 'templates/loca/'; ?>images/rate.gif" />
					</div>
					<div class="description">
						<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
					</div>

					<div class="rating-content">
						<img src="<?php echo JURI::base() . 'templates/loca/'; ?>images/rate.gif" />
						234 lượt đánh giá
					</div>
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