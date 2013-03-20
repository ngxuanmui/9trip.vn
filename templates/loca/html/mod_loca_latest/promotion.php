<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="promotion-content">
	<div class="promotion-bar">Khuyến mại mới nhất</div>
	<?php foreach ($list as $item): ?>
	<div class="promotion-item">
		<div class="title">
			<a href="#">
				<?php echo $item->name; ?>
			</a>
		</div>
		<div class="description">
			<a href="#"><?php echo $item->website; ?></a> - <?php echo JHtml::_('string.truncate', strip_tags($item->description), 50); ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>