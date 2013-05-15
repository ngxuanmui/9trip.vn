<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

JHtml::_('behavior.modal');

$userGuest = JFactory::getUser()->guest ? true : false;
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo CFG_GOOGLE_MAP_API ?>&sensor=true"></script>

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_TYPE = 'restaurants';
	var GMAP_LAT = '50.083';
	var GMAP_LONG = '19.917';
	var GMAP_ADD = '22 Thành Công, Ba Đình, Hà Nội, Việt Nam';
	
	// var UPLOAD_URL = '<?php echo JRoute::_('index.php?option=com_ntrip&task=other.upload'); ?>';
	
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
				
				<div class="clr"></div>
				
			</div>
			
			<?php 
			
			echo LocaHelper::renderModulesOnPosition(
						'loca-social', 
						array(	'item' => $item, 
								'item_type' => 'restaurants', 
								'gmap' => array(	'address' => $item->address,
													'lat' => $item->gmap_lat, 
													'long' => $item->gmap_long
											)
						)
					); 
			?>
			
			<div class="clr"></div>

			<div class="info">
				<div class="content">
					<p><b>Xếp hạng:</b> Nhà hàng ở Quảng Ninh</p>
					<p><b>Giá: </b><?php echo number_format((int) $item->price_from); ?> - <?php echo number_format((int) $item->price_to); ?> VNĐ/người</p>
					
					<?php 
			
					echo LocaHelper::renderModulesOnPosition(
								'loca-rating', 
								array(	'item' => $item, 
										'item_type' => 'restaurants'
								)
							); 
					?>
				</div>

				<div class="clr"></div>
			</div>
		</div>

		<?php Ntrip_CommentHelper::showForm($item->id, 'restaurants'); ?>

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