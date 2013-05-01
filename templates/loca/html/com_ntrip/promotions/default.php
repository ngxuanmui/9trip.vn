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
		<div class="intro-list-main-item">
			<label>Khuyến mại <?php echo $this->items[0]->category_title; ?> </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft hotel-quote">
				Thông tin khuyến mại
			</span>
			<input type="button" value="Thêm khuyến mại" class="fltrgt" />
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<?php echo NtripFrontHelper::itemsMenu(null); ?>
	
	<div class="clr"></div>

	<div class="list-promotions-container">
		<div class="items">
			<ul class="list-promotions">
				<?php 
				foreach ($this->items as $key => $item): 
					$item->slug = $item->id . ':' . $item->alias;
					$view = 'promotion';
						
					$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view));
				?>
				<li <?php if (($key + 1) % 3 == 0) echo 'class="last"'; ?>>
					<div class="image">
						<img src="<?php echo $item->images; ?>" />
					</div>
					
					<a class='promotion-title' href="<?php echo $link; ?>">
						<h3><?php echo $item->name; ?></h3>
					</a>
						
					<div class="author"><?php echo $item->author; ?>&nbsp;</div>
					
					<div class="promotion-desc">
						<?php echo JHtml::_('string.truncate', strip_tags($item->description), 200); ?>
					</div>
					
					<div class="clr">
						<a class="like" href="#" id="like-<?php echo $item->id; ?>"> Thích</a> <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>


	<div class="item-paging pagination">
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