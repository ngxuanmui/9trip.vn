<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="left-module-content">
	<div class="promotion-bar">Cảnh báo mới nhất</div>
	<?php foreach ($list as $item): ?>
	<div class="promotion-item">
		<img src="<?php echo $item->images; ?>" />
		<div class="title">
			<?php
			$item->slug = $item->id . ':' . $item->alias;
			$view = 'warning';
				
			$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view, $item->catid));
			
			?>
			<a href="<?php echo $link; ?>">
				<?php echo $item->name; ?>
			</a>
		</div>
		<div class="date">(<?php echo date('d.m.Y', $item->unix_time_created); ?>)</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; ?>
</div>