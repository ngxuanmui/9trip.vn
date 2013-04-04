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
			Trao đổi hỏi đáp du lịch <?php echo $this->items[0]->category_title; ?>
		</div>
		
		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft">
				Hãy chia sẻ những thắc mắc, những lo lắng của mình trước chuyến du lịch, 
				các chuyên gia và thành viên Loca.vn sẽ cùng thảo luận với bạn.
			</span>
			
			<a href="#" class="icons loca-button loca-button-question fltlft">Đặt câu hỏi</a>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<ul class="tab-categories">
		<li>Câu hỏi mới nhất</li>
		<li class="even">Hữu ích nhất</li>
		<li>Trả lời nhiều nhất</li>
	</ul>
	
	<div class="clr"></div>
		
	<div class="items">
				
		<ul class="list-questions">
			<?php foreach ($this->items as $item): ?>
			<li>
				<div class="fltlft question-avatar-image">
						
				</div>
				<div class="question-content fltlft">
					
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=question&id=' . $item->id, false); ?>">
						<h3><?php echo $item->title; ?></h3>
					</a>
					<?php echo JHtml::_('string.truncate', $item->content, 130); ?>
					
					<div class="question-detail-info">
						<span class="user">Đăng bởi: <?php echo $item->author; ?></span>
						<span class="datetime"><?php echo date("D, d/m/Y", strtotime('item->created')); ?></span>
						<span class="counter"><?php echo $item->hits; ?> lượt</span>
						<span class="no-reply">0 trả lời</span>
					</div>
				</div>
				
				<div class="question-info fltrgt">
					<p>Like</p>
					<p>Like FB</p>
					<p>Like G+</p>
				</div>		
				
				<div class="clr"></div>
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