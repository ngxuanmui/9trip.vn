<?php
// no direct access
defined('_JEXEC') or die;

$items = $this->items;

$fields = $this->fields;

$arrSearch = array(
					'common'	=> array('all' => 'Tất cả', 1, 2, 3, 4, 5),
					'price'		=> array(
											'all' => 'Tất cả', 
											1 => '0 VNĐ - 200N VNĐ', 
											2 => '200 VNĐ - 500N VNĐ', 
											3 => '500 VNĐ - 1TR VNĐ', 
											4 => '1TR VNĐ - 2TR VNĐ', 
											5 => 'TRÊN 2TR VNĐ'
									)
			);

$customField = explode(',', JRequest::getString('custom_field'));
$rating = explode(',', JRequest::getString('rating'));
var_dump($rating);
$price = explode(',', JRequest::getString('price'));
$criteria = explode(',', JRequest::getString('criteria'));
?>

<div id="top-adv">
		<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
	</div>
	<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="intro-list-main-item">
			<label>Khách sạn <?php echo $this->category->title; ?> </label>
			<span class="icons quote fltlft"></span>
			<span class="fltlft hotel-quote">
				Nếu khách sạn của bạn chưa có trên Loca.vn, hãy tạo mới ngay
			</span>
			<a class="button fltlft" href="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.add'); ?>">
				Tạo mới khách sạn
			</a>
			<div class="clear"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	<!-- Kết quả tài trợ -->	
	
	<?php echo NtripFrontHelper::itemsMenu('hotels'); ?>
	
	<div class="clr"></div>
	
	<form action="index.php" method="get">
		<script type="text/javascript">
			jQuery(function($){
				$('.custom_field, .rating, .price, .criteria').click(function(){
					var el_name = $(this).attr('class');
					var el = $('input[name="'+el_name+'"]');
					
					val = '';

					if ($(this).val() == 'all')
					{
						checkAll($(this));
					}
					else
					{
						// duyệt qua toàn bộ checkbox có class $(this).attr(class)
						$('.' + el_name).each(function(idx, element){
							if ($(this).attr('checked'))
								val += $(this).val() + ',';
						});
						
						el.val(val);
					}
				});

				checkAll($('.custom_field'));
				checkAll($('.rating'));
				checkAll($('.price'));
				checkAll($('.criteria'));

				function checkAll(element)
				{
					var el_name = element.attr('class');
					var el = $('input[name="'+el_name+'"]');
					
					if (element.val() == 'all')
					{
						var other_el = $('.' + el_name + '[value!="all"]');
						
						if (element.attr('checked'))
						{
							// disable other checkboxes							
							other_el.attr('disabled', 'disabled').attr('checked', 'checked');
							el.val(element.val());
						}
						else
						{
							other_el.removeAttr('disabled').removeAttr('checked');
							el.val('');
						}
					}
				}

			});
		</script>
		<input type="hidden" name="option" value="<?php echo JRequest::getString('option'); ?>" />
		<input type="hidden" name="view" value="<?php echo JRequest::getString('view'); ?>" />
		<input type="hidden" name="id" value="<?php echo JRequest::getInt('id'); ?>" />
		<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" />
		<input type="hidden" name="custom_field" value="<?php echo JRequest::getString('custom_field'); ?>" />
		<input type="hidden" name="rating" value="<?php echo JRequest::getString('rating'); ?>" />
		<input type="hidden" name="price" value="<?php echo JRequest::getString('price'); ?>" />
		<input type="hidden" name="criteria" value="<?php echo JRequest::getString('criteria'); ?>" />
		
		<div class="search-conditions">
			<div class="style">
				<label class="title">Phong cách</label>
				<div style="float: left; margin-right: 10px;">
					<ul>
						<li class="row-input fltlft custom-field-input">
							<input type="checkbox" class="custom_field" value="all" <?php if (in_array('all', $customField)) echo 'checked="checked"'?> /> Tất cả
						</li>
						<?php
							foreach ($fields as $field):
						?>
						<li class="row-input fltlft custom-field-input">
							<input type="checkbox" class="custom_field" value="<?php echo $field->id; ?>" <?php if (in_array($field->id, $customField)) echo 'checked="checked"'?> /> <?php echo $field->title; ?>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="clr"></div>
			</div>
			<div class="other-conditions">
				<div class="col">
					<label class="title">Đánh giá</label>
					<?php 
					foreach ($arrSearch['common'] as $key => $val): 
						if ($key === 'all'):
					?>
							<div class="row-input"><input class="rating" type="checkbox" value="all" <?php if (in_array('all', $rating)) echo 'checked="checked"'?> /> Tất cả </div>
						<?php else: ?>
							<div class="row-input"><input class="rating" type="checkbox" value="<?php echo $val; ?>" <?php if (in_array($val, $rating)) echo 'checked="checked"'?> /> <div class="star-<?php echo $val; ?>"></div> </div>
					<?php 
						endif;
					endforeach; 
					?>
				</div>
				<div class="col">
					<label class="title">Giá</label>
					<?php 
					foreach ($arrSearch['price'] as $key => $val): 
						if ($key === 'all'):
					?>
							<div class="row-input"><input class="price" type="checkbox" value="all" <?php if (in_array('all', $price)) echo 'checked="checked"'?> /> Tất cả </div>
						<?php else: ?>
							<div class="row-input"><input class="price" type="checkbox" value="<?php echo $key; ?>" <?php if (in_array($key, $price)) echo 'checked="checked"'?> /> <?php echo $val; ?> </div>
					<?php 
						endif;
					endforeach; 
					?>

				</div>
				<div class="col">
					<label class="title">Tiêu chuẩn</label>
					<?php 
					foreach ($arrSearch['common'] as $key => $val): 
						if ($key === 'all'):
					?>
							<div class="row-input"><input class="criteria" type="checkbox" value="all" <?php if (in_array('all', $criteria)) echo 'checked="checked"'?> /> Tất cả </div>
						<?php else: ?>
							<div class="row-input"><input class="criteria" type="checkbox" value="<?php echo $val; ?>" <?php if (in_array($val, $criteria)) echo 'checked="checked"'?> /> <div class="star-yellow<?php echo $val; ?>"></div> </div>
					<?php 
						endif;
					endforeach; 
					?>

				</div>

				<div class="clear"></div>

				<button class="button fltrgt">Xem kết quả</button>
			</div>
			<div class="clear"></div>
		</div>
		
		
	</form>

	<div class="clr"></div>
	<div class="list-main-items-content">
		<ul class="tab-list-main">
			<li class="active">Thích nhiều nhất</li>
			<li>Rẻ nhất</li>
			<li>Mới nhất</li>
			<div class="clr"></div>
		</ul>
		<!-- List nha hang -->
		<div class="list-main-items-content">
			<ul>
				<?php foreach ($this->items as $item): ?>
				<li>
					<a class="title" href="<?php echo JRoute::_('index.php?option=com_ntrip&view=hotel&id=' . $item->id . ':' . $item->alias, false); ?>">
						<?php echo $item->name; ?>
					</a>
					<div class="img-container">
						<img src="<?php echo $item->images; ?>" />
					</div>
					<div class="content">
						<b>Xếp hạng:</b> Khách sạn ở Quảng Ninh <br/>
						<b>Giá: </b><?php echo (int) $item->price_from; ?> - <?php echo (int) $item->price_to; ?> VNĐ/người <br />
						<label class="fltlft label-criteria">Tiêu chí:</label>
						<span class="fltlft full-star-over-yellow"><span class="star-yellow<?php echo str_replace('.', '-', $item->hotel_class); ?>"></span></span>
						<?php // echo JHtml::_('string.truncate', strip_tags($item->description), 100); ?>
						<div class="clear"></div>
						<span class="full-star-over fltlft"><span class="star<?php echo round($item->user_rank); ?>"></span></span>
						<span class="fltlft total_votes"> <?php echo (int) $item->count_rating; ?> lượt đánh giá </span>
						<div class="clear"></div>
						<a class="promotion-link" href="#"></a>
					</div>
					<div class="clr"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
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