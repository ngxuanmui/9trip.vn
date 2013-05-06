<div class="fltlft">
	<?php
	$locs = $this->locations;
	
	foreach ($locs as $key => $loc):
		$checked = ($loc->id == @$this->item->type) ? 'checked="checked"' : ($key == 0 ? 'checked="checked"' : null);
	?>
		<input type="radio" name="jform[type]" value="<?php echo $loc->id; ?>" <?php echo $checked; ?> style="float: left; margin-right: 5px;" />
		<span style="float: left; margin-right: 5px; line-height: 14px;"><?php echo $loc->title; ?></span>		
	<?php
	endforeach; 
	
	if (empty($locs))
		echo 'Chưa có thông tin';
	?>	
</div>



