<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category list-hotels-content">
			<label>
				<?php echo $item->name; ?>
				
				
			</label>
			
			<span class="fltlft full-star-over-yellow">
				<span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span>
			</span>
			
			<a class="fltrgt notice-info" href="#" title="Báo sai"></a>
		</div>

		<div class="item-container">
			
			<?php
			
			echo LocaHelper::renderModulesOnPosition(
						'loca-social',
						array(	'item' => $item,
								'item_type' => 'hotels',
								'gmap' => array(	'address' => $item->address,
													'lat' => $item->gmap_lat,
													'long' => $item->gmap_long
											)
						)
					);
			?>
			
			<div class="clr"></div>

			<div class="info">
				
				<div class="content">
					<div class="contact fltlft">
						<?php if (!empty($item->address)): ?>
						<span class="item contact-address">
							<span class="icons address"></span>
							<?php echo $item->address; ?>
						</span>
						<?php endif; ?>
						<?php if (!empty($item->website)): ?>
						<span class="item clr contact-website">
							<span class="icons website"></span>
							<a href="<?php echo strpos($item->website, 'http://') === false ? 'http://' .$item->website : $item->website; ?>" target="_blank">
								<?php echo $item->website; ?>
							</a>
						</span>
						<?php endif; ?>
						<?php if (!empty($item->email)): ?>
						<span class="item clr">
							<span class="email icons"></span>
							<a href="mailto:<?php echo $item->email; ?>">
								<?php echo $item->email; ?>
							</a>
						</span>
						<?php endif; ?>
						<?php if (!empty($item->phone)): ?>
						<span class="item clr contact-phone">
							<span class="phone icons"></span>
							<?php echo $item->phone; ?>
						</span>
						<?php endif; ?>
						<div class="clr"></div>
						
					</div>
					
					<?php if (isset($item->external_link) && $item->external_link != ''): ?>
					<div class="external-link fltrgt" style="margin-right: 10px;">
						
						<a href="<?php echo $item->external_link; ?>" target="_blank">Giá tham khảo</a>
						
					</div>
					<?php endif; ?>
			
					<?php /*?>
					<p><b>Xếp hạng:</b> Khách sạn ở <?php echo $item->category_title; ?></p>
					<p>
						<b>Giá: </b><?php echo number_format((int) $item->price_from); ?> - <?php echo number_format((int) $item->price_to); ?> VNĐ/người
						
						
					</p>
					<div class="description">
						<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
					</div>
					 */ ?>
					 
					<?php
			
					echo LocaHelper::renderModulesOnPosition(
								'loca-rating',
								array(	'item' => $item,
										'item_type' => 'hotels'
								)
							);
					?>

					<?php
					/*
					$checkUserRating = NtripFrontHelper::checkUserRating($item->id, 'hotels');
					
					$rank = round($item->user_rank);
					?>
					<div id="<?php echo $item->id; ?>" class="rating-content rate_widget" rated="<?php echo $rank; ?>">
						<?php for ($i = 1; $i <= 5; $i ++): ?>
						<div class="<?php if (!$checkUserRating): ?>user-rating<?php endif;?> star_<?php echo $i; ?> ratings_stars <?php if ($i <= $rank) echo 'ratings_vote'; ?>"></div>
						<?php endfor; ?>
						<span class="total_votes total_votes-detail"> <?php echo $item->count_rating; ?> đánh giá</span>
					</div>
					*/ ?>
				</div>

				<div class="clr"></div>
				
				<?php if (!empty($item->description)): ?>
				<div class="item-description">
					<?php echo $item->description; ?>
				</div>
				<?php endif; ?>
			</div>
			
			<div class="fb-comments-container">
				<div class="fb-comments" data-href="<?php echo CFG_REQUEST_URI; ?>" data-width="630" data-num-posts="10"></div>
			</div>
				
		</div>
		
		<div class="clr"></div>
		
				

		<?php Ntrip_CommentHelper::showForm($item->id, 'hotels', $item->name); ?>

		<div class="clr"></div>
		
		<?php if (!empty($this->otherItems)): ?>
		<div class="others margin-bottom5">
			<div class="title-category">
				Khách sạn khác
			</div>
		
			<div class="item-container item-detail">
					
				<div class="other-items">
					<ul class="hotel-other-items">
						<?php foreach ($this->otherItems as $other): ?>
						<li class="fltleft">
							<div class="img">
								<img src="<?php echo $other->images; ?>" />
							</div>

							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=hotel&id=' . $other->id . ':' . $other->alias, false); ?>">
								<?php echo $other->name; ?>
							</a>
							
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="clr"></div>
		
		<?php if (!empty($item->content)): ?>
		<div class="others margin-bottom5">
			<div class="title-category">
				Thông tin thêm
			</div>
			<div class="item-container item-content">
				<?php echo $item->content; ?>
			</div>
		</div>
		
		<div class="clr"></div>
		<?php endif; ?>
	</div>
</div>

<div id="right-content">
	<?php /*?>
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>
	*/ ?>
	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>