<?php
// no direct access
defined('_JEXEC') or die;

$items = $this->items;
$firstAlbum = $this->firstAlbum;

if (empty($firstAlbum))
{
	$firstAlbum = new stdClass();
	
	$firstAlbum->id = 0;
	$firstAlbum->user_like = 0;
}

JHtml::_('behavior.modal');

$userGuest = JFactory::getUser()->guest ? true : false;
?>

<script type="text/javascript">
	var zoomOption = 10;
</script>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	
	<div class="margin-bottom5">
		<div>
			<div class="title-category">
				<?php echo $this->category->title; ?>
			</div>
			
			<div class="item-container">
				<?php 
			
				echo LocaHelper::renderModulesOnPosition(
							'loca-social', 
							array(	'item' => $firstAlbum, 
									'item_type' => 'albums', 
									'gmap' => array(	'address' => $this->category->title, 
														'lat' => @$items['gmap_info']->gmap_lat, 
														'long' => @$items['gmap_info']->gmap_long
												)
							)
						); 
				?>
			</div>
			
		</div>
		
		<div class="clr"></div>
	</div>
	
		
	
	<div class="show-custom-field fltlft">
		<?php echo LocaHelper::renderModulesOnPosition('custom-field'); ?>
	</div>
	
	<div class="clr"></div>
	
	<?php 
	$subChild = $this->category->getChildren();
	if (!empty($subChild)): 
	?>
	<div class="margin-bottom5">
		<div class="title-category">
			Các địa danh du lịch của <?php echo $this->category->title; ?>
		</div>
		
		<div class="clr"></div>
		
		<div class="item-container">
			<ul class="album-container">
				<?php foreach ($subChild as $key => $child): ?>
				<li <?php if ( ($key + 1) % 3 == 0 ) echo 'class="last-item"' ?>>
					<div class="img album-img">
						<?php
							$params = $child->getParams();
							$image = $params->get('image');

							if ($image):
						?>
							<img src="<?php echo $image; ?>" />
						<?php endif; ?>
					</div>
					<a href="<?php echo JRoute::_(NtripHelperRoute::getCategoryRoute($child->id)); ?>" class="bold">
						<?php echo $child->title; ?>
					</a>					
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	<?php endif; ?>
	
	<div class="clr"></div>
	
	<div class="margin-bottom5">
		<div class="title-category">
			Khám phá mới nhất
		</div>
		
		<div class="item-container">
			<ul>
				<?php foreach ($items['discovers'] as $discover): ?>
				<li>
					<div class="img">
						<img src="<?php echo $discover->images; ?>" />
					</div>
					<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($discover->id, 'discover')); ?>">
						<?php echo $discover->name; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<div class="margin-bottom5">
		<div class="title-category">
			Khuyến mãi mới nhất
		</div>
		
		<div class="clr"></div>
		
		<div class="item-container">
			<ul>
				<?php foreach ($items['promotions'] as $promotion): ?>
				<li>
					<div class="img">
						<img src="<?php echo $promotion->images; ?>" />
					</div>
					<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($promotion->id, 'promotion')); ?>">
						<?php echo $promotion->name; ?>
					</a>					
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<div class="margin-bottom5">
		<div class="title-category">
			Hỏi đáp mới nhất
		</div>
		
		<div class="clr"></div>
		
		<div class="item-container">
			<ul class="questions">
				<?php foreach ($items['questions'] as $question): ?>
				<li>
					<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($question->id, 'question')); ?>">
						<?php echo $question->title; ?>
					</a>
					
					<div class="item-info">
						<a href="#"><?php echo $question->author; ?></a> <?php echo $question->created; ?> | <?php echo $question->hits; ?> | <?php #echo $question->answers; ?>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<?php /*
	<div class="margin-bottom5">
		<div class="title-category">
			Album mới nhất
		</div>
		
		<div class="clr"></div>
		
		<div class="item-container">
			<ul class="album-container">
				<?php foreach ($items['albums'] as $key => $album): ?>
				<li <?php if ( ($key + 1) % 3 == 0 ) echo 'class="last-item"' ?>>
					<div class="img album-img">
						<img src="<?php echo $album->images; ?>" />
					</div>
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $album->id, false); ?>" class="bold">
						<?php echo $album->name; ?>
					</a>					
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	*/ ?>
</div>

<!-- Right content -->
<div id="right-content">
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>
<!-- End right -->
