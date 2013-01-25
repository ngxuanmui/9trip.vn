<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="promotion-content">
	<div class="promotion-bar">Khuyến mại mới nhất</div>
	<?php foreach ($list as $item): ?>
	<div class="promotion-item">
		<div class="title"><?php echo $item->title; ?></div>
		<div class="description">
			<?php echo $item->description; ?>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>