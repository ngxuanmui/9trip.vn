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
			Trao đổi hỏi đáp du lịch <?php echo $this->category->title; ?>
		</div>
		
		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft album-quote">
				Hãy chia sẻ những thắc mắc, những lo lắng của mình trước chuyến du lịch, các chuyên gia và thành viên Loca.vn sẽ cùng thảo luận với bạn.
			</span>
			<a href="#" class="block icons loca-button fltlft"><span class="txt-btn">Đặt câu hỏi</span></a>
		</div>
		
		<div class="clr"></div>
	</div>

	<div class="list-hotels-container">
		<div class="tabs">
			<ul class="tab-categories">
				<li class="active">Câu hỏi mới nhất</li>
				<li class="even">Hữu ích nhất</li>
				<li>Trả lời nhiều nhất</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="items">
			<ul class="list-questions">
				<?php foreach ($this->items as $item): ?>
				<li>
					<div class="fltlft question-avatar-image">
						<img src="<?php echo NtripFrontHelper::getAvatar($item->created_by); ?>" />
					</div>
					<div class="question-content fltlft">

						<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($item->id, 'question', $item->catid)); ?>">
							<h3><?php echo $item->title; ?></h3>
						</a>
						<?php echo JHtml::_('string.truncate', $item->content, 130); ?>

						<div class="question-detail-info">
							<span class="user">Đăng bởi: <label class="author"><?php echo $item->author; ?></label></span> |
							<span class="datetime"><?php echo date("D, d/m/Y", strtotime('item->created')); ?></span> |
							<span class="counter"><?php echo $item->hits; ?> lượt</span> | 
							<span class="no-reply">0 trả lời</span>
						</div>
					</div>

					<div class="question-info fltrgt">						
						<div class="clr">
							<?php 
			
							echo LocaHelper::renderModulesOnPosition(
										'loca-like', 
										array(	'item' => $item, 
												'item_type' => 'questions'
										)
									); 
							?>
						</div>
						<div class="clr">Like FB</div>
						<div class="clr">Like G+</div>
					</div>
					<div class="clr saparate-line"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
	</div>	
	<div class="clr"></div>		
	
	
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