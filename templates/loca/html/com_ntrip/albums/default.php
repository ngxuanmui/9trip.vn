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
			Album Ảnh
		</div>
		
		<div class="item-container">
			<span class="icons quote fltlft"></span>
			<span class="fltlft album-quote">
				Hãy chia sẻ những khoảng khắc đáng nhớ của các bạn về những chuyến đi, 
				các thành viên Loca.vn sẽ trải nghiệm cùng bạn.
			</span>
			
			<a href="#" class="share-img"></a>
		</div>		
		<div class="clr"></div>
	</div>
	<div class="list-hotels-container">
		<div class="tabs">
			<ul class="tab-categories">
				<li class="active"><a href="#">Album ảnh mới nhất</a></li>
				<li><a href="#">Nhiều người thích nhất</a></li>
			</ul>
			<div class="clr"></div>
		</div>
	
		<div class="items">
			<ul class="list-albums">
				<?php 
				foreach ($this->items as $key => $item):
					
					$item->slug = $item->id . ':' . $item->alias;
					$view = 'album';
					
					$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view, $item->catid));
				?>
				<li <?php if (($key + 1) % 3 == 0) echo 'class="last-item"'; ?>>
					<div class="img">
						<a href="<?php echo $link; ?>" title="<?php echo $item->name; ?>">
							<img src="<?php echo $item->images; ?>" />
						</a>
					</div>

					<h2 class="title-album">
						<a href="<?php echo $link; ?>" title="<?php echo $item->name; ?>">
							<?php echo $item->name; ?>
						</a>
					</h2>
					
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
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>