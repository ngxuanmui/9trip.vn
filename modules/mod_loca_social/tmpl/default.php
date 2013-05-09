<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="item-container">
	<div class="social-info">
		<a class="like" href="#" id="like-<?php echo $item->id; ?>"> Thích</a> <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>

		<div class="social-button fltrgt">
			<div class="error error-msg fltlft" style="display: none; margin-right: 10px;"></div>
			<a class="icons add-image <?php if (!$userGuest) echo 'modal'; ?>" id="btn-add-image" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=upload_image&tmpl=component&id='.$item->id.'&type=albums'); ?>" rel="{handler: 'iframe', size: {x: 440, y: 460}, onClose: function() {}}"></a>
			<button class="icons show-image show-image-focus"></button>
			<button class="icons show-map"></button>
		</div>

		<div class="clr"></div>
	</div>

	<div class="other-album relative">
		<div class="album absolute" id="show-album">
			<div id="galleria">
				<?php
				if (!empty($item->other_images)): 
					foreach ($item->other_images as $other_image):
				?>
				<img src="<?php echo JURI::base() . 'images/albums/' . $item->id . '/' . $other_image->images; ?>" title="<?php echo $other_image->author ? $other_image->author : 'Anonymous'; ?>" data-description="<?php echo $other_image->description; ?>">

				<?php 
					endforeach; 
				endif; 
				?>
			</div>						
		</div>
		<div class="map absolute" id="show-map" style="visibility: hidden;">
			map here
		</div>
	</div>
</div>