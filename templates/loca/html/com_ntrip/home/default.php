<?php
// No direct access.
defined('_JEXEC') or die;
?>

<script src="<?php echo JURI::base() . '/media/loca/jquery.bxslider/jquery.bxslider.js'; ?>"></script>

<script type="text/javascript">
	jQuery(function(){
		$('.slider').bxSlider({
			auto: false,
			autoControls: false
		});
	});
</script>

<div class="main-content">
	<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>
	<!-- Left content -->
	<div id="left-content">
		<?php 
		foreach ($this->items as $item): 
			$children = $item->getChildren();

			$numberOfSlide = ($item->note) ? $item->note : CFG_DEFAULT_NUMBER_OF_SLIDES;

			$subCat = array();

			$i = 0;
			$sub = array();
			//	var_dump($children);

			// rebuild array to display as slider
			foreach ($children as $child)
			{
				$sub[] = $child;

				if ( (( ($i + 1) % $numberOfSlide == 0) && $i > 0) || ($i == count($children) - 1) )
				{
					$subCat[] = $sub;
					$sub = array();
				}

				$i ++;

			}

		//	var_dump($subCat);
		?>
		<div class="margin-bottom5">
			<div class="title-category">
				Các địa danh du lịch <?php echo $item->title; ?>
			</div>
			
			<ul class="tour-container slider">				
				<?php foreach ($subCat as $sub): ?>
				<li>
					<?php foreach ($sub as $subItem): ?>
					<div class="tour-content">
						<div class="img-block">
							<?php
								$params = $subItem->getParams();
								$image = $params->get('image');

								if ($image):
							?>
								<img src="<?php echo $image; ?>" />
							<?php endif; ?>
						</div>
						<div class="title"><?php echo $subItem->title; ?></div>
						<div class="info">
							<?php
							$sib = $subItem->getChildren();
							foreach ($sib as $cat)
								echo '<span>'.$cat->title.'</span> | ';
							?>
						</div>
						
					</div>
					<?php endforeach; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
			
		</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
	
	<!-- End left -->

			<!-- Right content -->
			<div id="right-content">
				<div class="register">
					<span class="icon-reg"></span>
					<span>ĐĂNG KÝ THÀNH VIÊN</span>
				</div>
				
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
	</div>