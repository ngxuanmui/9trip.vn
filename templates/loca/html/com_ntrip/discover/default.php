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
		<div class="title-category">
			<?php echo $item->name; ?>
		</div>
		
		<div class="item-container item-detail">
			<?php
			echo LocaHelper::renderModulesOnPosition(
						'loca-article-info', 
						array(	'item' => $item,
								'item_type' => 'discovers'
						)
					); 
			?>
				
			<div class="clr"></div>
			
			<div class="info">
				<?php echo $item->description; ?>
				
				<div class="clr"></div>
				
				<div class="article-social">
					<div class="fltlft">
						<?php
						echo LocaHelper::renderModulesOnPosition(
									'loca-rating', 
									array(	'item' => $item, 
											'item_type' => 'discovers'
									)
								); 
						?>
					</div>
					
					<div class="fltrgt">
						
					</div>
					<div class="clr"></div>
				</div>
					
			</div>
			<?php /*?>
			<div class="tags-container">
				<span class="fltlft tags icons"></span>
				<span class="fltlft">Dis proin, elementum ac duis, enim magnis, </span>

				<div class="clr"></div>
			</div>
			*/ ?>
			
			<?php Ntrip_CommentHelper::showForm($item->id, 'discovers'); ?>
		</div>
		
		
		
		<?php if (!empty($this->otherItems)): ?>	
		<div class="margin-bottom5">
			<div class="title-category">
				Bài viết liên quan
			</div>
		
			<div class="item-container item-detail">
					
				<div class="other-items">
					<ul class="discover-other-items">
						<?php foreach ($this->otherItems as $other): ?>
						<li class="fltleft">
							<div class="img">
								<img src="<?php echo $item->images; ?>" />
							</div>				
							
							<?php 
							$item->slug = $item->id . ':' . $item->alias;
							$view = 'discover';
							?>

							<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view) , false); ?>">
								<?php echo $item->name; ?>
							</a>
							
						</li>
						<?php endforeach; ?>
					</ul>
				</div>		
				<div class="clr"></div>
			</div>
		</div>
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