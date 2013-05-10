<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');

$userGuest = JFactory::getUser()->guest ? true : false;
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

		<div class="item-container">
			<div class="address"><?php echo $item->address; ?></div>
			
			<div class="contact">
				<span class="item">
					<span class="icons website"></span>
					<a href="<?php echo strpos($item->website, 'http://') === false ? 'http://' .$item->website : $item->website; ?>" target="_blank">
						Website
					</a>
				</span>
				<span class="item">
					<span class="email icons"></span>
					<a href="mailto:<?php echo $item->email; ?>">
						Email
					</a>
				</span>
				<span class="item">
					<span class="phone icons"></span>
					<?php echo $item->phone; ?>
				</span>
				
				<div class="clr"></div>
				
			</div>
			
			
			
			<!-- mod social -->
			
			<div class="clr"></div>

			<div class="info">
				
				<div class="content">
					<p><b>Xếp hạng:</b> Nhà hàng ở Quảng Ninh</p>
					<p><b>Giá: </b><?php echo number_format((int) $item->price_from); ?> - <?php echo number_format((int) $item->price_to); ?> VNĐ/người</p>
					<div class="rating-content">
						<span class="fltlft criteria">Tiêu chí: </span>
						<span class="fltlft full-star-over-yellow">
							<span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span>
						</span>
					</div>
					<?php /*
					<div class="description">
						<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
					</div>
					 */ ?>

					<?php $rank = round($item->user_rank); ?>
					<div id="<?php echo $item->id; ?>" class="rating-content rate_widget" rated="<?php echo $rank; ?>">						
						<?php for ($i = 1; $i <= 5; $i ++): ?>
						<div class="star_<?php echo $i; ?> ratings_stars <?php if ($i <= $rank) echo 'ratings_vote'; ?>"></div>
						<?php endfor; ?>
						<span class="total_votes"> <?php echo $item->count_rating; ?> đánh giá</span>
					</div>
				</div>

				<div class="clr"></div>
			</div>
		</div>

		<?php Ntrip_CommentHelper::showForm($item->id, 'hotels'); ?>

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