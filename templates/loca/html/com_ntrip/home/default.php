<?php
// No direct access.
defined('_JEXEC') or die;
?>


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
				<?php echo $item->title; ?>
			</div>
			
			<div class="tour-container">
				<ul class="slider-<?php echo $item->id; ?>">				
					<?php foreach ($subCat as $sub): ?>
					<li>
						<?php 
						foreach ($sub as $subItem): 
							
						?>
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
							<div class="title">
								<a href="<?php echo JRoute::_(NtripHelperRoute::getCategoryRoute($subItem->id)); ?>">
									<?php echo $subItem->title; ?>
								</a>
							</div>

						</div>
						<?php endforeach; ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="clear"></div>
			
				
			
		</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
	
	<!-- End left -->

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
