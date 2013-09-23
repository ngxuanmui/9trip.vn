<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;
?>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category">
			<?php echo $item->name; ?>
		</div>
		
		<div class="item-container item-detail">
			<div class="info">
				<?php echo $item->description; ?>
				
				<div class="clr"></div>
			</div>
		</div>
		
		<?php Ntrip_CommentHelper::showForm($item->id, 'discovers'); ?>
		
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

							<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $item->id . ':' . $item->alias, false); ?>">
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