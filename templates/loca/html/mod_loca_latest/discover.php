<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="promotion-content">
	<div class="promotion-bar">Khám phá mới nhất</div>
	<?php foreach ($list as $item): ?>
	<div class="promotion-item">
		<img src="<?php echo $item->images; ?>" />
		<div class="title"><?php echo $item->name; ?></div>
		<div class="date">(<?php echo date('d.m.Y', $item->unix_time_created); ?>)</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; ?>
</div>