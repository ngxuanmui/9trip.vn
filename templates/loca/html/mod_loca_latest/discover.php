<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="left-module-content">
	<div class="promotion-bar">Khám phá mới nhất</div>
	<?php foreach ($list as $key => $item): ?>
	<div class="promotion-item <?php if ($key == 0) echo 'discover-featured'; ?>">
		<img src="<?php echo $item->thumb; ?>" />
		<div class="title">
			<?php
			$item->slug = $item->id . ':' . $item->alias;
			$view = 'discover';
				
			//$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view, $item->catid));
			$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view, $item->catid, $item->type));
			
			?>
			<a href="<?php echo $link; ?>">
				<?php echo $item->name; ?>
			</a>
		</div>
		<?php //if ($key > 0): ?>
		<div class="date">(<?php echo date('d.m.Y', $item->unix_time_created); ?>)</div>
		<?php //endif; ?>
		<div class="clear"></div>
	</div>
	<?php endforeach; ?>
</div>