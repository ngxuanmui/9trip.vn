<?php
// no direct access
defined('_JEXEC') or die;

$fields = $this->fields;
?>

<div id="left-content">
	<div class="margin-bottom-1">
		<div class="title-category">
			<?php 
			jimport('joomla.application.categories');
		
			$cat = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip.custom_field_discover', 'table' => ''));
			
			$category = $cat->get(JRequest::getInt('custom_field'));
			
			echo ($category->title);
			?>
		</div>

		<?php /*<div class="item-container">
			<span class="icons quote fltlft"></span> <span
				class="fltlft album-quote"> Hãy chia sẻ những trải nghiệm của bạn về
				chuyến đi của mình, các chia sẻ thực tế của bạn sẽ giúp ích rất
				nhiều cho các thành viên khác. </span>
				
			<a href="#"
				class="block icons loca-button fltlft"><span class="txt-btn">Chia sẻ
					trải nghiệm</span></a>
				 *
				
		</div> */ ?>

		<div class="clr"></div>
	</div>

	<?php /*?>
	<div class="tabs">
		<?php //echo LocaHelper::renderModulesOnPosition('menu-kham-pha'); ?>
		
		<ul class="menu tab-categories">
			<?php foreach ($fields as $field): ?>
			<li <?php if (JRequest::getInt('custom_field') == $field->id) echo 'class="active"'; ?>>
				<a href="<?php echo JRoute::_('index.php?Itemid=' . JRequest::getInt('Itemid') . '&custom_field=' . $field->id); ?>"><?php echo $field->title; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>

		<div class="clr"></div>
	</div>
	*/ ?>

	<div class="list-hotels-container">


		<div class="items">
			<ul class="list-discovers">
				<?php
				foreach ($this->items as $item):
					
					$item->slug = $item->id . ':' . $item->alias;
					$view = 'discover';
					
					$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view, $item->catid, $item->type));
				?>
				<li class="<?php if ($item->featured == 1) echo 'relative'; ?>">
					<h2>
						<a href="<?php echo $link; ?>">
							<?php
							echo $item->name;
							?>
						</a>
					</h2>

					<div class="discover-info">
						<span class="user"><?php echo $item->author; ?></span> <span
							class="datetime"><?php echo date("D, d/m/Y", strtotime('item->created')); ?></span>
						<?php /*?>
						<span class="counter"><?php echo $item->hits; ?> lượt</span> <span
							class="no-reply">0 trả lời</span> */ ?>
					</div>

					<div class="img">
						<a href="<?php echo $link; ?>"> <img
							src="<?php echo $item->images; ?>" />
						</a>
					</div>

					<div class="description"><?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?></div>
					<div class="clr" style="padding-top: 10px;"></div>
					
					<?php
					/*
					 *
					 * <div class="social-info fltlft">
						<span>12 thành viên thích</span>
					</div>
					 */
					?>
							
					<a href="<?php echo $link ; ?>" class="block icons loca-button fltright"> <span
						class="txt-btn">Chi tiết &raquo;</span>
				</a>
					<div class="clr"></div>
					<div class="saparate-line"></div>
					
					<?php if ($item->featured == 1): ?>
					<div class="absolute icon-featured"></div>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>

</div>

<div id="right-content">
	<a class="register"
		href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>"
		style="display: block;"> <span class="icon-reg"></span> <span
		class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>