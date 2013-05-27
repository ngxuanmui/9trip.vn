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
		
		<div class="item-container">
			<div class="item-detail">
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
			</div>
			
			<?php Ntrip_CommentHelper::showForm($item->id, 'discovers', $item->name); ?>
		</div>
		
		<div class="clr"></div>
		
		<?php if (!empty($this->otherItems)): ?>	
		<div class="margin-bottom5 other-item-container">
			<div class="title-category">
				Bài viết liên quan
			</div>
			
			<div class="other-items">
				<ul class="discover-other-items">
					<?php foreach ($this->otherItems as $other): ?>
					<li class="fltleft">
						<div class="img">
							<img src="<?php echo $other->images; ?>" />
						</div>				
						
						<?php 
						$other->slug = $other->id . ':' . $other->alias;
						$view = 'discover';
						?>

						<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($other->slug, $view) , false); ?>">
							<?php echo $other->name; ?>
						</a>
						
					</li>
					<?php endforeach; ?>
				</ul>
			</div>		
			<div class="clr"></div>
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