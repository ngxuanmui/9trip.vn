<?php
// no direct access
defined('_JEXEC') or die;
?>

<div class="left-module-content">
	<div class="promotion-bar">Khuyến mại mới nhất</div>
	<?php foreach ($list as $item): ?>
	<div class="promotion-item">
		<div class="title">
			<?php
			$item->slug = $item->id . ':' . $item->alias;
			$view = 'promotion';
				
			$link = JRoute::_(NtripHelperRoute::getItemRoute($item->slug, $view));
			
			?>
			<a href="<?php echo $link; ?>">
				<?php echo $item->name; ?>
			</a>
		</div>
		<div class="description">
			<a href="#"><?php echo $item->website; ?></a> - <?php echo JHtml::_('string.truncate', strip_tags($item->description), 50); ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>