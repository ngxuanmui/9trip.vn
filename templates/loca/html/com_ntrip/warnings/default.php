<?php
// no direct access
defined('_JEXEC') or die;

$fields = $this->fields;
?>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category">
			Khám phá
		</div>
		
		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft">
				Hãy chia sẻ những trải nghiệm của bạn về chuyến đi của mình, 
				các chia sẻ thực tế của bạn sẽ giúp ích rất nhiều cho các 
				thành viên khác.
			</span>
			
			<a href="#" class="icons loca-button fltlft">Chia sẻ trải nghiệm</a>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<ul>
		<li><a href="">Khám phá</a></li>
		<?php foreach ($fields as $field): ?>
		<li>
			<a href="#">
				<?php echo $field->title; ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	
	<div class="clr"></div>
		
	<div class="items">
				
		<ul class="list-warnings">
			<?php foreach ($this->items as $item): ?>
			<li>
				<h2>
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=warning&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
				</h2>
				
				<div class="warning-info">
					<span class="user">Username Test</span>
					<span class="datetime">Wed, 26/09/2012</span>
					<span class="counter">182 lượt</span>
					<span class="no-reply">0 trả lời</span>
				</div>
				
				<div class="img">
					<img src="<?php echo $item->images; ?>" />
				</div>
				
				<p class="description">
					<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
				</p>
				
				<div class="social-info">
					<span>12 thành viên thích</span>
					
					
					<div class="small-button">
						Chi tiết
					</div>
				</div>
				
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
	</div>
	
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
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