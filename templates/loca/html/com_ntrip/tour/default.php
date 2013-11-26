<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');

$userGuest = JFactory::getUser()->guest ? true : false;
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category list-hotels-content">
			<label><?php echo $item->name; ?></label>
		</div>

		<div class="item-container">
						
			<?php
			
			echo LocaHelper::renderModulesOnPosition(
						'loca-social',
						array(	'item' => $item,
								'item_type' => 'tours',
								'gmap' => array(	'address' => $item->address,
													'lat' => $item->gmap_lat,
													'long' => $item->gmap_long
											)
						)
					);
			?>
			
			<div class="clr"></div>

			<div class="info">
				
				<div class="content item-detail">
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
					
					<div class="clr"></div>
					
					<div>
						<?php echo $item->description; ?>
						<div class="clr"></div>
					</div>
					
					<?php
					echo LocaHelper::renderModulesOnPosition(
								'loca-rating',
								array(	'item' => $item,
										'item_type' => 'tours'
								)
							);
					?>
				</div>

				<div class="clr"></div>
			</div>
			
			<div class="clr"></div>
			
			<div class="fb-comments-container">
				<div class="fb-comments" data-href="<?php echo CFG_REQUEST_URI; ?>" data-width="630" data-num-posts="10"></div>
			</div>
		</div>

		<?php Ntrip_CommentHelper::showForm($item->id, 'tours', $item->name); ?>
		
		<div class="clr"></div>
		
		<?php if (!empty($this->otherItems)): ?>
		<div class="others margin-bottom5">
			<div class="title-category">
				Thưởng ngoạn khác
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
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>