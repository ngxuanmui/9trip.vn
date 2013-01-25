<?php
// no direct access
defined('_JEXEC') or die;
?>

<!-- Khám phá noi bat-->
<div class="promotion-content">
	<div class="promotion-bar">Khám phá mới nhất</div>
	<?php foreach ($list as $key => $item): ?>
	<div class="promotion-item <?php echo ($key == 0) ? 'featured' : ''; ?>">
		<img src="<?php echo $item->images; ?>" />
		<div class="title"><?php echo $item->title; ?></div>
		<div class="date">(<?php echo date('d.m.Y', $item->unix_time_created); ?>)</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>