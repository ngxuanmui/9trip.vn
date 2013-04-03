<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');

/* // rating

jQuery.post(
				'index.php?option=com_ntrip&task=other.rating',
				{item_id: ITEM_ID, item_type: ITEM_TYPE, rating: 5},
				function(res){
					if (res == 'OK')
						alert('success');
					else 
						alert(res);
				}
); */
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo CFG_GOOGLE_MAP_API ?>&sensor=true"></script>

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_TYPE = 'hotels';
	// var UPLOAD_URL = '<?php echo JRoute::_('index.php?option=com_ntrip&task=other.upload'); ?>';
	
	jQuery(function($){
		$('button.show-image').click(function(){
			$(this).addClass('show-image-focus');
			$('#show-album').css('display', 'block');
			$('#show-map').css('display', 'none');
			$('button.show-map').removeClass('show-map-focus');
		});
		
		$('button.show-map').click(function(){
			$(this).addClass('show-map-focus');
			$('#show-album').css('display', 'none');
			$('#show-map').css('display', 'block');
			$('button.show-image').removeClass('show-image-focus');
		});
		
		// LOAD MAP
		jQuery('#show-map').css({'height':'400', 'width':'628'});
		
		initialize(50.083, 19.917, '22 Thành Công, Ba Đình, Hà Nội, Việt Nam', 'show-map');
	});
	
	function initialize(gmaps_latitude, gmaps_longitude, address_title, map_canvas) 
	{
		var mapOptions = {
			center: new google.maps.LatLng(gmaps_latitude, gmaps_longitude),
			zoom: 16,
			scrollwheel: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById(map_canvas), mapOptions);

		var marker = new google.maps.Marker({
			position: map.getCenter(),
			map: map,
			title: address_title
		  });

		  google.maps.event.addListener(map, 'center_changed', function() {
			// 3 seconds after the center of the map has changed, pan back to the
			// marker.
			/*window.setTimeout(function() {
			  map.panTo(marker.getPosition());
			}, 3000);*/
		  });

		  google.maps.event.addListener(marker, 'click', function() {
			map.setZoom(16);
			map.setCenter(marker.getPosition());
		  });
	}
</script>

<div id="top-adv">
	<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
</div>
<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category list-hotels-content">
			<label><?php echo $item->name; ?></label>
		</div>

		<div class="item-container">
			<div class="address"><?php echo $item->address; ?></div>
			
			<div class="contact">
				<span class="item">
					<span class="icons website"></span>
					<a href="<?php echo strpos($item->website, 'http://') === false ? 'http://' .$item->website : $item->webiste; ?>" target="_blank">
						Hotel website
					</a>
				</span>
				<span class="item">
					<span class="email icons"></span>
					<a href="mailto:<?php echo $item->email; ?>">
						Email
					</a>
				</span>
				<span class="item">
					<span class="phone icons"></span>
					<?php echo $item->phone; ?>
				</span>
				
			</div>
			
			<div class="clr"></div>
			
			<div class="social-info">
				<a class="like" href="#" id="like-<?php echo $item->id; ?>"> Thích</a> <div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>
				
				<div class="social-button fltrgt">
					<a class="icons add-image modal" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=upload_image&tmpl=component&id='.$item->id.'&type=hotels'); ?>" rel="{handler: 'iframe', size: {x: 440, y: 460}, onClose: function() {}}"></a>
					<button class="icons show-image show-image-focus"></button>
					<button class="icons show-map"></button>
				</div>
				
				<div class="clr"></div>
			</div>
			
			<div class="clr"></div>

			<div class="info">
				<div class="other-album">
					<div class="album" id="show-album">
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
					
					<div class="map" id="show-map" style="display: none;">
						map here
					</div>
				</div>

				<div class="content">
					<b>Xếp hạng:</b> 1/35 nhà hàng ở Quảng Ninh <br/>
					<b>Giá: </b><?php echo number_format($item->price_from); ?> - <?php echo number_format($item->price_to); ?> VNĐ/người <br />
					<div class="rating-content">
						<img src="<?php echo JURI::base() . 'templates/loca/'; ?>images/5-stars.gif" />
					</div>
					<?php /*
					<div class="description">
						<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
					</div>
					 */ ?>

					<?php $rank = round($item->user_rank); ?>
					<div id="<?php echo $item->id; ?>" class="rating-content rate_widget" rated="<?php echo $rank; ?>">						
						<?php for ($i = 1; $i <= 5; $i ++): ?>
						<div class="star_<?php echo $i; ?> ratings_stars <?php if ($i <= $rank) echo 'ratings_vote'; ?>"></div>
						<?php endfor; ?>
						<span class="total_votes"> <?php echo $item->count_rating; ?> đánh giá</span>
					</div>
				</div>

				<div class="clr"></div>
			</div>
		</div>

		<?php Ntrip_CommentHelper::showForm($item->id, 'hotels'); ?>

		<div class="clr"></div>
	</div>
</div>

<div id="right-content">
	<a class="register" href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>" style="display: block;">
		<span class="icon-reg"></span>
		<span class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>