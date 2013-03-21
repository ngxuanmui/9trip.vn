<?php
// no direct access
defined('_JEXEC') or die;

$items = $this->items;
$firstAlbum = $this->firstAlbum;
?>

<script type="text/javascript">
	jQuery(function(){
		Galleria.loadTheme('<?php echo JURI::base(); ?>media/loca/galleria/themes/azur/galleria.azur.min.js');
		Galleria.configure({
			imageCrop: 'landscape',
			imageMargin: 60,
			imagePosition: 'top',
			transition: 'fade',
			showCounter: false,
			idleMode: 'hover',
    idleSpeed: 500,
	fullscreenTransition: false,
	trueFullscreen: false
		});
		
		Galleria.run('#galleria');
	});
</script>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	<div class="location-album">
		<h1><?php echo $this->category->title; ?></h1>
		<div class="album">
			<div id="galleria">
				<?php if ($firstAlbum->images): ?>
				<img src="<?php echo $firstAlbum->images; ?>" title="<?php echo $firstAlbum->author; ?>" data-description="<?php echo $firstAlbum->name; ?>" />
				<?php 
				endif; 
				
				if (!empty($firstAlbum->other_images)): 
					foreach ($firstAlbum->other_images as $other_image):
				?>
				<img src="<?php echo JURI::base() . 'images/albums/' . $firstAlbum->id . '/' . $other_image->images; ?>" title="<?php echo $other_image->author ? $other_image->author : 'Anonymous'; ?>" data-description="<?php echo $other_image->description; ?>">
				
				<?php 
					endforeach; 
				endif; 
				?>
			</div>
		</div>
	</div>
	
	<div class="show-custom-field fltlft">
		<?php 
			$modules = JModuleHelper::getModules('custom-field');

			foreach($modules as $module)
			{
				if ($module->showtitle)
					echo '<div class="module-title">' . $module->title . '</div>';

				echo JModuleHelper::renderModule($module);
			}
		?>
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
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=category&id=' . $child->id, false); ?>" class="bold">
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
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $discover->id, false); ?>">
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
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $promotion->id, false); ?>">
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
					<a href="#">
						<?php echo $question->title; ?>
					</a>
					
					<div class="question-info">
						<a href="#"><?php echo $question->author; ?></a> <?php echo $question->created; ?> | <?php echo $question->hits; ?> | <?php #echo $question->answers; ?>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	
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
</div>

<!-- Right content -->
			<div id="right-content">
				<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
					<span class="icon-reg"></span>
					<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
				</a>
				
				<?php 
					$modules = JModuleHelper::getModules('right');

					foreach($modules as $module)
					{
//						if ($module->showtitle)
//							echo '<div class="module-title">' . $module->title . '</div>';

						echo JModuleHelper::renderModule($module);
					}
				?>
				
			</div>
			<div class="clear"></div>
			<!-- End right -->
