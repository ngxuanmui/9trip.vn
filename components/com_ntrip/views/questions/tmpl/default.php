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
			Hỏi đáp
		</div>
		
		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft">
				Hãy chia sẻ những trải nghiệm của bạn về chuyến đi của mình, 
				các chia sẻ thực tế của bạn sẽ giúp ích rất nhiều cho các 
				thành viên khác.
			</span>
			
			<a href="#" class="icons loca-button loca-button-question fltlft">Đặt câu hỏi</a>
		</div>
		
		<div class="clr"></div>
	</div>
		
	<div class="items">
				
		<ul class="list-questions">
			<?php foreach ($this->items as $item): ?>
			<li>
				<h2>
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=question&id=' . $item->id, false); ?>">
						<?php echo $item->content; ?>
					</a>
				</h2>
				
				<div class="question-info">
					Like FB
					Like G+
					1 trả lời
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