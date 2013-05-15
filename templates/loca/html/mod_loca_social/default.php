<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$userGuest = JFactory::getUser()->guest;

$noGallery = (empty($item->other_images)) ? true : false;

$checkUserLike = NtripFrontHelper::checkUserLike($item->id, $itemType);
?>

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_TYPE = '<?php echo $itemType; ?>';
	var GMAP_LAT = '<?php echo $gmapInfo->lat; ?>';
	var GMAP_LONG = '<?php echo $gmapInfo->long; ?>';
	var GMAP_ADD = '<?php echo $gmapInfo->address; ?>, Việt Nam';
	var USER_GUEST = '<?php echo $userGuest ? 'y' : 'n'; ?>';
</script>

<div class="item-container social-info">
	<div class="fltlft">
		<?php if ($userGuest): ?>
		<a class="like modal user-not-login" href="<?php echo JRoute::_('index.php?option=com_users&view=loca_login&tmpl=component'); ?>" rel="{handler: 'iframe', size: {x: 340, y: 260}, onClose: function() {}}"> Thích</a>
		<?php else: ?>
		<a class="like user-like <?php if ($checkUserLike) echo 'liked';?>" href="#" id="like-<?php echo $item->id; ?>"> Thích</a>
		<?php endif; ?>
		
		 <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>
		 
		<!-- gplus +1 button to render. -->
		<div class="fltlft gplus">
			<div class="g-plusone" data-size="medium" data-href="<?php $server = JRequest::get('server'); echo $server['REQUEST_URI']; ?>"></div>
			
			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  window.___gcfg = {lang: 'vi'};
			
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
	</div>
	
	
	<div class="social-button fltrgt">
		<?php if ($userGuest): ?>
		<a class="icons add-image modal user-not-login" href="<?php echo JRoute::_('index.php?option=com_users&view=loca_login&tmpl=component'); ?>" rel="{handler: 'iframe', size: {x: 340, y: 260}, onClose: function() {}}"></a>
		<?php else: ?>
		<a class="icons add-image modal" id="btn-add-image" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=upload_image&tmpl=component&id='.$item->id.'&type='.$itemType); ?>" rel="{handler: 'iframe', size: {x: 440, y: 460}, onClose: function() {}}"></a>
		<?php endif; ?>
		<button class="icons show-image show-image-focus" <?php if ($noGallery): ?>style="display: none;"<?php endif; ?>></button>
		<button class="icons show-map <?php if ($noGallery): ?>show-map-focus<?php endif; ?>"></button>
	</div>
	
	<div class="clr"></div>
	
	<div class="other-album relative">
		<div class="album absolute" id="show-album" <?php if ($noGallery): ?>style="visibility: hidden;"<?php endif; ?>>
			<div id="galleria">
				<?php 
				if (!empty($item->other_images)):
					foreach ($item->other_images as $img): 
					?>
					<img src="<?php echo 'images' . '/' . $itemType . '/' . $item->id . '/' . $img->images; ?>" />
					<?php 
					endforeach; 
				endif; 
				?>
			</div>
		</div>
		
		<div class="map absolute" id="show-map" <?php if (!$noGallery): ?>style="visibility: hidden;"<?php endif; ?>>
			map here
		</div>
	</div>
	
	<div class="clr"></div>
</div>
