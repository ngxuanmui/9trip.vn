<?php
// no direct access
defined('_JEXEC') or die;

$items = $this->items;
?>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	<div class="location-album">
		<h1><?php echo $this->category->title; ?></h1>
		<div class="album">
			<img src="<?php echo JURI::base() . '/templates/loca/images/sample/location-album.png'; ?>" />
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
			<ul>
				
				<li>
					kkk
				</li>
				
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
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $album->id, false); ?>">
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
