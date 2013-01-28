<?php
// No direct access.
defined('_JEXEC') or die;
?>

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
			
			<ul class="tour-container slider-<?php echo $item->id; ?>">				
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
			
			<div class="pagination paging-slider-<?php echo $item->id; ?>" rel="<?php echo $item->id; ?>">
				<ul class="">
					<li class="pager-prev">Trang trước</li>
					<?php foreach ($subCat as $key => $sub): ?>
					<li class="pager-item <?php if ($key == 0) echo 'active'; ?>" rel="<?php echo $key; ?>"><?php echo $key + 1; ?></li>
					<?php endforeach; ?>
					<li class="pager-next">Trang sau</li>
				</ul>
			</div>
			
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


<script src="<?php echo JURI::base() . '/media/loca/jquery.bxslider/jquery.bxslider.js'; ?>"></script>

<script type="text/javascript">
	jQuery(function($){
		<?php foreach ($this->items as $item): ?>
		var slider_<?php echo $item->id; ?> = $('.slider-<?php echo $item->id; ?>').bxSlider({
			auto: false,
			infiniteLoop: false,
			autoControls: false,
			controls: false,
			pager: false
		});
		
		$('.paging-slider-<?php echo $item->id; ?> .pager-item').click(function(){
			$('.paging-slider-<?php echo $item->id; ?> .pager-item').removeClass('active');
			$(this).addClass('active');
			var slide = slider_<?php echo $item->id; ?>;
			slide.goToSlide($(this).attr('rel'));
		});
		
		$('.paging-slider-<?php echo $item->id; ?> .pager-prev').click(function(){
			var slide = slider_<?php echo $item->id; ?>;
			var currentSlide = parseInt(slide.getCurrentSlide());
			var prevSlide = currentSlide - 1;
			
			if (prevSlide < 0)
				return false;
			
			$('.paging-slider-<?php echo $item->id; ?> .pager-item').removeClass('active');			
			$('.paging-slider-<?php echo $item->id; ?> .pager-item[rel='+prevSlide+']').addClass('active');
			slide.goToSlide(prevSlide);
		});
		
		$('.paging-slider-<?php echo $item->id; ?> .pager-next').click(function(){
			
			var slide = slider_<?php echo $item->id; ?>;
			var currentSlide = parseInt(slide.getCurrentSlide());
			var nextSlide = currentSlide + 1;
			
			if (nextSlide > slide.getSlideCount() - 1)
				return false;
			
			$('.paging-slider-<?php echo $item->id; ?> .pager-item').removeClass('active');			
			$('.paging-slider-<?php echo $item->id; ?> .pager-item[rel='+nextSlide+']').addClass('active');
			slide.goToSlide(nextSlide);
		});
		<?php endforeach; ?>
	});
</script>