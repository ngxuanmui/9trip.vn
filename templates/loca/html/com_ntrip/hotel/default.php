<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');

$userGuest = JFactory::getUser()->guest ? true : false;
?>

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_TYPE = 'hotels';
	var GMAP_LAT = '<?php echo $item->gmap->gmap_lat; ?>';
	var GMAP_LONG = '<?php echo $item->gmap->gmap_long; ?>';
	var GMAP_ADD = '<?php echo $item->address; ?>, Việt Nam';
	var USER_GUEST = '<?php echo $userGuest ? 'y' : 'n'; ?>';
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
						Website
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
				
				<div class="clr"></div>
				
			</div>
			
			
			
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
					<a class="icons add-image <?php if (!$userGuest) echo 'modal'; ?>" id="btn-add-image" login="<?php echo ($userGuest) ? 'no' : 'yes'; ?>" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=upload_image&tmpl=component&id='.$item->id.'&type=hotels'); ?>" rel="{handler: 'iframe', size: {x: 440, y: 460}, onClose: function() {}}"></a>
					<button class="icons show-image show-image-focus"></button>
					<button class="icons show-map"></button>
				</div>
				
				<div class="clr"></div>
			</div>
			
			<div class="clr"></div>

			<div class="info">
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

				<div class="content">
					<p><b>Xếp hạng:</b> Nhà hàng ở Quảng Ninh</p>
					<p><b>Giá: </b><?php echo number_format((int) $item->price_from); ?> - <?php echo number_format((int) $item->price_to); ?> VNĐ/người</p>
					<div class="rating-content">
						<span class="fltlft criteria">Tiêu chí: </span>
						<span class="fltlft full-star-over-yellow">
							<span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span>
						</span>
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