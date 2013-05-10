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
?>

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_TYPE = '<?php echo $itemType; ?>';
	var GMAP_LAT = '<?php echo $item->gmap->gmap_lat; ?>';
	var GMAP_LONG = '<?php echo $item->gmap->gmap_long; ?>';
	var GMAP_ADD = '<?php echo $item->address; ?>, Việt Nam';
	var USER_GUEST = '<?php echo $userGuest ? 'y' : 'n'; ?>';
</script>

<div class="social-info">
	<div class="fltlft">
		<a class="like" href="#" id="like-<?php echo $item->id; ?>"> Thích</a> <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>
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
		<div class="error error-msg fltlft" style="display: none; margin-right: 10px;">Bạn chưa đăng nhập!</div>
		<a class="icons add-image <?php if (!$userGuest) echo 'modal'; ?>" id="btn-add-image" login="<?php echo ($userGuest) ? 'no' : 'yes'; ?>" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=upload_image&tmpl=component&id='.$item->id.'&type='.$itemType); ?>" rel="{handler: 'iframe', size: {x: 440, y: 460}, onClose: function() {}}"></a>
		<button class="icons show-image show-image-focus"></button>
		<button class="icons show-map"></button>
	</div>
	
	<div class="clr"></div>
	
	<div class="other-album relative">
		<div class="album absolute" id="show-album">
			<div id="galleria">
				<?php 
				if (!empty($this->otherImages)):
					foreach ($this->otherImages as $img): 
					?>
					<img src="images/hotels/<?php echo $item->id; ?>/<?php echo $img->images; ?>" />
					<?php 
					endforeach; 
				endif; 
				?>
			</div>
		</div>
		
		<div class="map absolute" id="show-map" style="display: none;">
			map here
		</div>
	</div>
</div>