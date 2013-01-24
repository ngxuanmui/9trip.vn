<?php
// No direct access.
defined('_JEXEC') or die;
?>

<script src="<?php echo JURI::base() . '/media/loca/jquery.bxslider/jquery.bxslider.js'; ?>"></script>

<script type="text/javascript">
	jQuery(function(){
		$('.slider').bxSlider({
			auto: true,
			autoControls: false
		});
	});
</script>

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
		
		if ( (($i % $numberOfSlide == 0) && $i > 0) || ($i == count($children) - 1) )
		{
			$subCat[] = $sub;
			$sub = array();
		}
		
		$i ++;
		
	}
	
//	var_dump($subCat);
?>
<h1><?php echo $item->title; ?></h1>
<ul class="slider">
    <?php foreach ($subCat as $sub): ?>
    <li>
		<?php foreach ($sub as $subItem): ?>
		<div>
			<?php
				$params = $subItem->getParams();
				$image = $params->get('image');

				if ($image):
			?>
				<img src="<?php echo $image; ?>" width="100" height="50" />
			<?php endif; ?>
			<?php echo $subItem->title; ?>

			<?php
			$sib = $subItem->getChildren();
			?>
			<ul>
				<?php foreach ($sib as $cat): ?>
				<li>
				<?php echo $cat->title; ?>
				</li>
				<?php endforeach; ?>
			</ul>			
		</div>
		<?php endforeach; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endforeach; ?>

<?php 
	$modules = JModuleHelper::getModules('right');
	
	foreach($modules as $module)
	{
		if ($module->showtitle)
			echo '<div class="module-title">' . $module->title . '</div>';

		echo JModuleHelper::renderModule($module);
	}
?>