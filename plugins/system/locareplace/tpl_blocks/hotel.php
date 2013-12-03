<?php
$tmp = explode('/', $item->images);

$image_name = end($tmp);

// shift an el (image folder) in $tmp
array_shift($tmp);

// remove last el (file name) in $tmp
array_pop($tmp);

$item->thumb = JURI::root() . 'images/thumbs/' . implode('/', $tmp) . '/' . 't-150x0' . '-' . $image_name;

$link = JRoute::_('index.php?option=com_ntrip&view=hotel&id=' . $item->id . ':' . $item->alias, false);
?>

<div class="clr"></div>

<div class="hotel-block external-block">
	<div class="fltlft">
		<div class="img-container">
			<a class="title" href="<?php echo $link; ?>">
				<img src="<?php echo $item->thumb; ?>" />
			</a>
		</div>
	</div>
	<div class="contact fltlft" style="width: 470px; margin: 5px 0 5px 5px;">
		<a class="title" href="<?php echo $link; ?>">
			<?php echo $item->name; ?>
		</a>
		
		<?php if (!empty($item->address)): ?>
		<span class="item contact-address">
			<span class="icons address"></span>
			<?php echo $item->address; ?>
		</span>
		<?php endif; ?>
		<?php if (!empty($item->website)): ?>
		<span class="item clr contact-website">
			<span class="icons website"></span>
			<a href="<?php echo strpos($item->website, 'http://') === false ? 'http://' .$item->website : $item->website; ?>" target="_blank">
				<?php echo $item->website; ?>
			</a>
		</span>
		<?php endif; ?>
		<?php if (!empty($item->email)): ?>
		<span class="item clr">
			<span class="email icons"></span>
			<a href="mailto:<?php echo $item->email; ?>">
				<?php echo $item->email; ?>
			</a>
		</span>
		<?php endif; ?>
		<?php if (!empty($item->phone)): ?>
		<span class="item clr contact-phone">
			<span class="phone icons"></span>
			<?php echo $item->phone; ?>
		</span>
		<?php endif; ?>
		<div class="clr"></div>
		
	</div>
</div>

<div class="clr"></div>