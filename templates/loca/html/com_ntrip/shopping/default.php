<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category list-hotels-content">
			<label><?php echo $item->name; ?></label>
		</div>

		<div class="item-container">
			<div class="address"><?php echo $item->address; ?></div>
			
			<?php if ($item->website || $item->email || $item->phone): ?>
			<div class="contact">
				<?php if ($item->website): ?>
				<span class="item">
					<span class="icons website"></span>
					<a href="<?php echo strpos($item->website, 'http://') === false ? 'http://' .$item->website : $item->webiste; ?>" target="_blank">
						Website
					</a>
				</span>
				<?php endif; ?>
				<?php if ($item->email): ?>
				<span class="item">
					<span class="email icons"></span>
					<a href="mailto:<?php echo $item->email; ?>">
						Email
					</a>
				</span>
				<?php endif; ?>
				<?php if ($item->phone): ?>
				<span class="item phone">
					<span class="phone icons"></span>
					<?php echo $item->phone; ?>
				</span>
				<?php endif; ?>
				<div class="clr"></div>
			</div>
			<?php endif; ?>
			
			<?php 
			
			echo LocaHelper::renderModulesOnPosition(
						'loca-social', 
						array(	'item' => $item, 
								'item_type' => 'shoppings', 
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
					<div>
						<?php echo $item->description; ?>
						<div class="clr"></div>
					</div>
					
					<p><b>Xếp hạng:</b> Mua sắm ở <?php echo $item->category_title; ?></p>
					
					<?php
					echo LocaHelper::renderModulesOnPosition(
								'loca-rating', 
								array(	'item' => $item, 
										'item_type' => 'restaurants'
								)
							); 
					?>
				</div>

				<div class="clr"></div>
			</div>
		</div>

		<?php Ntrip_CommentHelper::showForm($item->id, 'shoppings', $item->name); ?>

		<div class="clr"></div>
		
		<div class="fb-comments-container">
			<div class="fb-comments" data-href="<?php echo CFG_REQUEST_URI; ?>" data-width="650" data-num-posts="10"></div>
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