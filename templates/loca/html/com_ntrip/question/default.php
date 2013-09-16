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
			<div class="info">
				<?php echo $item->content; ?>
				
				<div class="clr"></div>
				
				<div class="article-rating-like">
					<div class="fltlft">
						<?php 
				
						echo LocaHelper::renderModulesOnPosition(
									'loca-rating', 
									array(	'item' => $item, 
											'item_type' => 'questions'
									)
								); 
						?>
					</div>
					
					<div class="social-info fltrgt">
						<?php 
				
						echo LocaHelper::renderModulesOnPosition(
									'loca-like', 
									array(	'item' => $item, 
											'item_type' => 'questions'
									)
								); 
						?>
					</div>
				</div>
				
				<div class="clr"></div>
			</div>
			
			<?php /*?>
			<div class="tags-container">
				<span class="fltlft tags icons"></span>
				<span class="fltlft">Dis proin, elementum ac duis, enim magnis, </span>

				<div class="clr"></div>
			</div>
			*/ ?>
			
			<?php Ntrip_CommentHelper::showForm($item->id, 'questions', $item->name); ?>
			
			<div class="clr"></div>
		
			<div class="fb-comments-container">
				<div class="fb-comments" data-href="<?php echo CFG_REQUEST_URI; ?>" data-width="650" data-num-posts="10"></div>
			</div>
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