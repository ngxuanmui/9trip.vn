<?php
// No direct access.
defined('_JEXEC') or die;
?>

<?php foreach ($this->items as $item): ?>
<h1><?php echo $item->title; ?></h1>
<ul>
	<?php foreach ($item->getChildren() as $sub): ?>
	<li>
		<?php echo $sub->title; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endforeach; ?>