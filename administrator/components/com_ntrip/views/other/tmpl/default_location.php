<?php
$locs = $this->locations;

foreach ($locs as $key => $loc):
	$checked = ($loc->id == $this->item->type) ? 'checked="checked"' : ($key == 0 ? 'checked="checked"' : null);
?>
<input type="radio" name="jform[type]" value="<?php echo $loc->id; ?>" <?php echo $checked; ?> />
<span style="float: left; margin-right: 5px;"><?php echo $loc->title; ?></span>
<?php
endforeach; 

if (empty($locs))
	echo 'No custom field defined';
?>


