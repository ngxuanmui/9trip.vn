<?php
// no direct access
defined('_JEXEC') or die;
?>

<ul>
	<?php foreach ($list as $item): ?>
	<li>
		<img src="<?php echo $item->images; ?>" />
		
		<h1><?php echo $item->title; ?></h1>
		<div class="desc">
			<?php echo $item->description; ?>
		</div>
	</li>
	<?php endforeach; ?>
</ul>