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
								<img src="<?php echo $image; ?>" width="198" />
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

				<div class="promotion-content">
					<div class="promotion-bar">Khuyến mại mới nhất</div>
					<div class="promotion-item">
						<div class="title">Hotel in Ha Noi</div>
						<div class="description">
							<a href="#">www.agoda.com/hanoi</a> - Đừng bỏ lỡ cơ hội tiết kiệm lên đến 75%. Tiết kiệm - phù hợp - nhanh chóng.
						</div>
					</div>
					<div class="promotion-item">
						<div class="title">Hotel in Ha Noi</div>
						<div class="description">
							<a href="#">www.agoda.com/hanoi</a> - Đừng bỏ lỡ cơ hội tiết kiệm lên đến 75%. Tiết kiệm - phù hợp - nhanh chóng.
						</div>
					</div>
					<div class="promotion-item">
						<div class="title">Hotel in Ha Noi</div>
						<div class="description">
							<a href="#">www.agoda.com/hanoi</a> - Đừng bỏ lỡ cơ hội tiết kiệm lên đến 75%. Tiết kiệm - phù hợp - nhanh chóng.
						</div>
					</div>
					<div class="promotion-item">
						<div class="title">Hotel in Ha Noi</div>
						<div class="description">
							<a href="#">www.agoda.com/hanoi</a> - Đừng bỏ lỡ cơ hội tiết kiệm lên đến 75%. Tiết kiệm - phù hợp - nhanh chóng.
						</div>
					</div>
					<div class="promotion-item">
						<div class="title">Hotel in Ha Noi</div>
						<div class="description">
							<a href="#">www.agoda.com/hanoi</a> - Đừng bỏ lỡ cơ hội tiết kiệm lên đến 75%. Tiết kiệm - phù hợp - nhanh chóng.
						</div>
					</div>
					<div class="promotion-item">
						<div class="title">Hotel in Ha Noi</div>
						<div class="description">
							<a href="#">www.agoda.com/hanoi</a> - Đừng bỏ lỡ cơ hội tiết kiệm lên đến 75%. Tiết kiệm - phù hợp - nhanh chóng.
						</div>
					</div>
				</div>

				<!-- Tin tuc / bai viet noi bat-->
				<div class="promotion-content">
					<div class="promotion-bar">Cảnh báo mới nhất</div>
					<div class="promotion-item">
						<img src="images/img1.jpg" />
						<div class="title">Ăn táo trong quá trình đi du lịch có thể bị ngộ độc</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img1.jpg" />
						<div class="title">Ăn táo trong quá trình đi du lịch có thể bị ngộ độc</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img1.jpg" />
						<div class="title">Ăn táo trong quá trình đi du lịch có thể bị ngộ độc</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img1.jpg" />
						<div class="title">Ăn táo trong quá trình đi du lịch có thể bị ngộ độc</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img1.jpg" />
						<div class="title">Ăn táo trong quá trình đi du lịch có thể bị ngộ độc</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>                            
					<div class="clear"></div>
				</div>

				 <!-- Khám phá noi bat-->
				<div class="promotion-content">
					<div class="promotion-bar">Khám phá mới nhất</div>
					<div class="promotion-item">
						<img src="images/img2.jpg" />
						<div class="title">Giọt nước mắt đóng băng phía sau Mẫu Sơn lung linh</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img2.jpg" />
						<div class="title">Giọt nước mắt đóng băng phía sau Mẫu Sơn lung linh</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img2.jpg" />
						<div class="title">Giọt nước mắt đóng băng phía sau Mẫu Sơn lung linh</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img2.jpg" />
						<div class="title">Giọt nước mắt đóng băng phía sau Mẫu Sơn lung linh</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>
					<div class="promotion-item">
						<img src="images/img2.jpg" />
						<div class="title">Giọt nước mắt đóng băng phía sau Mẫu Sơn lung linh</div>
						<div class="date">(01.01.2013)</div>
						<div class="clear"></div>
					</div>                        
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			<!-- End right -->
	</div>