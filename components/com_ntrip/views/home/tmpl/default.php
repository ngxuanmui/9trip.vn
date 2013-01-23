<?php
// No direct access.
defined('_JEXEC') or die;
?>

<?php foreach ($this->items as $item): ?>
<h1><?php echo $item->title; ?></h1>
<ul>
    <?php foreach ($item->getChildren() as $sub): ?>
    <li>
	<?php
	    $params = $sub->getParams();
	    $image = $params->get('image');
	    
	    if ($image):
	?>
	<img src="<?php echo $image; ?>" />
	<?php endif; ?>
	<?php echo $sub->title; ?>
	
	<?php
	$sib = $sub->getChildren();
	
	  
	?>
	<ul>
	    <?php foreach ($sib as $cat): ?>
	    <li>
		<?php echo $cat->title; ?>
	    </li>
	    <?php endforeach; ?>
	</ul>
    </li>
    <?php endforeach; ?>
</ul>
<?php endforeach; ?>