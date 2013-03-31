<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

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

<script type="text/javascript">
	var ITEM_ID = <?php echo $item->id; ?>;
	var ITEM_TYPE = 'hotels';
	$(document).ready(function() {
		var widget = $('.rate_widget');
		set_votes(widget);		

		// This actually records the vote
		$('.ratings_stars').bind('click', function() {
			var star = this;
			var widget = $(this).parent();
			var item_id = $(star).parent().attr('id');

			var clicked_data = {
				clicked_on : $(star).attr('class'),
				item_id : $(star).parent().attr('id'),
				item_type: ITEM_TYPE
			};
			
			$.post(
				'index.php?option=com_ntrip&task=other.rating',
				clicked_data,
				function(INFO) {
					if (INFO == 'OK') {
						set_votes(widget);
					}
				}
			);
		});

		$('.ratings_stars').hover(
			// Handles the mouseover
			function() {
				$(this).prevAll().andSelf().addClass('ratings_over');
				$(this).nextAll().removeClass('ratings_vote');
			},
			// Handles the mouseout
			function() {
				$(this).prevAll().andSelf().removeClass('ratings_over');
				set_votes($(this).parent());
			}
		);

		function set_votes(widget) {
			var item_id = widget.attr('id');
			$.post(
				'index.php?option=com_ntrip&task=other.get_rating',
				{item_id: item_id, item_type: ITEM_TYPE},
				function(data) {
					var rating_data = data.split('##');
					$('.total_votes').html = '';
					$('.total_votes').html(rating_data[0] + ' lượt đánh giá');
					var avg = rating_data[1];
					$(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
					$(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
				}
			);
		}
		
	});
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

		<div class="hotel-container">
			<div class="address"><?php echo "Phường Hồng Hà, Thành Phố Hạ Long - Quảng Ninh"; ?></div>
			<div class="contact">
				<span class="website item">Website</span>
				<span class="email item">Email</span>
				<span class="phone item">Phone</span>
			</div>
			<div class="social-info">
				<img src="<?php echo JURI::base() . 'templates/loca/images/social-info.jpg'; ?>" />
			</div>

			<div class="info">
				<div class="other-album">
					<div class="album">
						<div id="galleria">
							<?php if ($firstAlbum->images): ?>
							<img src="<?php echo $firstAlbum->images; ?>" title="<?php echo $firstAlbum->author; ?>" data-description="<?php echo $firstAlbum->name; ?>" />
							<?php 
							endif; 

							if (!empty($firstAlbum->other_images)): 
								foreach ($firstAlbum->other_images as $other_image):
							?>
							<img src="<?php echo JURI::base() . 'images/albums/' . $firstAlbum->id . '/' . $other_image->images; ?>" title="<?php echo $other_image->author ? $other_image->author : 'Anonymous'; ?>" data-description="<?php echo $other_image->description; ?>">

							<?php 
								endforeach; 
							endif; 
							?>
						</div>
					</div>
				</div>

				<div class="content">
					<b>Xếp hạng:</b> 1/35 nhà hàng ở Quảng Ninh <br/>
					<b>Giá: </b>120 - 150 000 VNĐ/người <br />
					<div class="rating-content">
						<img src="<?php echo JURI::base() . 'templates/loca/'; ?>images/5-stars.gif" />
					</div>
					<div class="description">
						<?php echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
					</div>

					<div id="<?php echo $item->id; ?>" class="rating-content rate_widget">
						<div class="star_1 ratings_stars"></div>
						<div class="star_2 ratings_stars"></div>
						<div class="star_3 ratings_stars"></div>
						<div class="star_4 ratings_stars"></div>
						<div class="star_5 ratings_stars"></div>
						<span class="total_votes"> lượt đánh giá</span>
					</div>
				</div>

				<div class="clr"></div>
			</div>

			<div class="other-images">
				<h3>Cơ sở vật chất</h3>

				<ul>
					<?php foreach ($this->otherImages as $img): ?>
					<li class="img">
						<img src="images/restaurants/<?php echo $item->id; ?>/thumbnail/<?php echo $img->images; ?>" />
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="clr"></div>
		</div>

		<?php Ntrip_CommentHelper::showForm($item->id, 'discovers'); ?>

		<?php if (!empty($this->otherItems)): ?>
		<div class="other-items">
			<ul>
				<?php foreach ($this->otherItems as $other): ?>
				<li>
					<div class="img">
						<img src="<?php echo $item->images; ?>" />
					</div>

					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=discover&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

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