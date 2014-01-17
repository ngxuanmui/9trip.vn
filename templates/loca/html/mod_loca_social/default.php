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

$arrShowLink3D = array('hotel', 'restaurant', 'service', 'relax', 'tour', 'shopping');
?>

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_ID_COMMENT = <?php echo $item->id; ?>;
	var ITEM_TYPE = '<?php echo $itemType; ?>';
	var ITEM_TYPE_COMMENT = '<?php echo $itemType; ?>';
	var GMAP_LAT = '<?php echo $gmapInfo->lat; ?>';
	var GMAP_LONG = '<?php echo $gmapInfo->long; ?>';
	var GMAP_ADD = '<?php echo $gmapInfo->address; ?>, Việt Nam';
	var USER_GUEST = '<?php echo $userGuest ? 'y' : 'n'; ?>';
</script>

<div class="clr"></div>

<div class="xitem-container social-info">
	<div class="fltlft">
		<?php /*?>
		<div class="fltlft">
			<?php if ($userGuest): ?>
			<a class="like modal user-not-login" href="<?php echo JRoute::_('index.php?option=com_users&view=loca_login&tmpl=component'); ?>" rel="{handler: 'iframe', size: {x: 340, y: 260}, onClose: function() {}}"> Thích</a>
			<?php else: ?>
			<a class="like user-like <?php if ($checkUserLike) echo 'liked';?>" href="#" id="like-<?php echo $item->id; ?>"> Thích</a>
			<?php endif; ?>
			
			 <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>
		</div>
		*/ ?>
		 
		<div class="fltlft" style="margin-right: 5px; height: 20px; width: 75px; display: block; border: 0px solid;">
			<div class="fb-like" data-href="<?php echo CFG_REQUEST_URI; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
		</div>
		
		<div class="fltlft" style="margin-right: 25px; height: 20px; width: 75px; display: block; border: 0px solid;">
			<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-type="button_count"></div>
		</div>
		<div class="fltlft">
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
	</div>
	
	
	<div class="social-button fltrgt">
		<?php /* if ($userGuest): ?>
		<a class="icons add-image modal user-not-login" href="<?php echo JRoute::_('index.php?option=com_users&view=loca_login&tmpl=component'); ?>" rel="{handler: 'iframe', size: {x: 340, y: 160}, onClose: function() {}}"></a>
		<?php else: ?>
		<a class="icons add-image modal" id="btn-add-image" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=upload_image&tmpl=component&id='.$item->id.'&type='.$itemType); ?>" rel="{handler: 'iframe', size: {x: 440, y: 460}, onClose: function() {}}"></a>
		<?php endif;*/ ?>
		<button class="icons show-image show-image-focus" <?php if ($noGallery): ?>style="display: none;"<?php endif; ?>></button>
		<button class="icons show-map <?php if ($noGallery): ?>show-map-focus<?php endif; ?>"></button>
		<?php if (JRequest::getString('view', '') != 'category'): ?>
		<button class="icons show-map-direction"></button>
		<?php endif; ?>
		<?php if (in_array(JRequest::getString('view', ''), $arrShowLink3D)): ?>
		<button class="link-3d" type="button">Show 3D</button>
		<?php endif; ?>
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
		
		<div class="map absolute" id="show-map-direction" style="visibility: hidden;">
			<div class="map" id="map"></div>
			<input type="text" id="from" name="from" size="0" style="display: none;" />
			<input type="text" id="to" name="to" size="0" style="display: none;" />
    		<p id="error"></p>
		</div>
		
		<div class="link-3d absolute" id="show-link-3d" style="width: 627px; height: 400px; display: none;">
			<iframe src="http://3dnet.vn/3d/i-resort/vuon-cay-khuon-vien.html" style="border: none; width: 100%; height: 100%;"></iframe>
		</div>
		
	</div>
	
	<div class="clr"></div>
</div>
