<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="promotion-content">
	<div class="promotion-bar">Khuyến mại mới nhất</div>
	<?php foreach ($list as $item): ?>
	<div class="promotion-item">
		<div class="title"><?php echo $item->name; ?></div>
		<div class="description">
			<a href="#"><?php echo $item->name; ?></a> - <?php echo $item->description; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>