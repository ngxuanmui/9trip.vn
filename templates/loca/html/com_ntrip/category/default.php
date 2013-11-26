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
				
				<?php
				$checkDesc = trim(strip_tags($this->category->description));
				
				if (!empty($checkDesc)):
				?>
				<div class="clr"></div>
				
				<div class="category-description">
					<?php echo $this->category->description; ?>
				</div>
				<?php endif; ?>
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
				<?php
				foreach ($subChild as $key => $child):
					$link = JRoute::_(NtripHelperRoute::getCategoryRoute($child->id));
				?>
				<li <?php if ( ($key + 1) % 3 == 0 ) echo 'class="last-item"' ?>>
					<div class="img album-img">
						<?php
							$params = $child->getParams();
							$image = $params->get('image');

							if ($image):
						?>
							<a href="<?php echo $link; ?>" class="bold">
								<img src="<?php echo $image; ?>" />
							</a>
						<?php endif; ?>
					</div>
					<a href="<?php echo $link; ?>" class="bold">
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
			Khám phá du lịch mới nhất
		</div>
		
		<div class="item-container">
			<ul>
				<?php
				foreach ($items['discovers'] as $discover):
					$link = JRoute::_(NtripHelperRoute::getItemRoute($discover->id, 'discover', $discover->catid));
				?>
				<li>
					<div class="img">
						<a href="<?php echo $link; ?>">
							<img src="<?php echo $discover->thumb; ?>" />
						</a>
					</div>
					<a href="<?php echo $link; ?>">
						<?php echo $discover->name; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	<?php /*
	<div class="margin-bottom5">
		<div class="title-category">
			Khuyến mãi mới nhất
		</div>
		
		<div class="clr"></div>
		
		<div class="item-container">
			<ul>
				<?php
				foreach ($items['promotions'] as $promotion):
					$link = JRoute::_(NtripHelperRoute::getItemRoute($promotion->id, 'promotion', $promotion->catid));
				?>
				<li>
					<div class="img">
						<a href="<?php echo $link; ?>">
							<img src="<?php echo $promotion->images; ?>" />
						</a>
					</div>
					<a href="<?php echo $link; ?>">
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
					<a href="<?php echo JRoute::_(NtripHelperRoute::getItemRoute($question->id, 'question', $question->catid)); ?>">
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
	
	*/ ?>
	<div class="margin-bottom5">
		<div class="title-category">
			Album mới nhất
		</div>
		
		<div class="clr"></div>
		
		<div class="item-container">
			<ul class="album-container">
				<?php
				foreach ($items['albums'] as $key => $album):
					$link = JRoute::_(NtripHelperRoute::getItemRoute($album->id, 'album', $album->catid));
				?>
				<li <?php if ( ($key + 1) % 3 == 0 ) echo 'class="last-item"' ?>>
					<div class="img album-img">
						<a href="<?php echo $link; ?>" title="<?php echo $album->name; ?>" class="bold">
							<img src="<?php echo $album->thumb; ?>" />
						</a>
					</div>
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=album&id=' . $album->id, false); ?>" title="<?php echo $album->name; ?>" class="bold">
						<?php echo $album->name; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<?php
	$checkContent = trim(strip_tags($this->category->content));
	
	if (!empty($checkContent)):
	?>
	<div class="margin-bottom5">
		<div class="item-container" style="border-top: 1px solid #E6E6E6;">
			<?php echo $this->category->content; ?>
		</div>
	</div>
	<?php endif; ?>
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
