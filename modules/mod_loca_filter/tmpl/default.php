<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$arrSearch = array(
		'common'	=> array('all' => 'Tất cả', 1, 2, 3, 4, 5),
		'price'		=> array(
				'all' => 'Tất cả',
				1 => 'Đến 200N VNĐ',
				2 => 'Trên 200 VNĐ',
				3 => 'Trên 500 VNĐ',
				4 => 'Trên 1TR VNĐ',
				5 => 'TRÊN 2TR VNĐ'
		)
);

$customField 	= explode(',', JRequest::getString('custom_field'));
$rating 		= explode(',', JRequest::getString('rating'));
$price 			= explode(',', JRequest::getString('price'));
$criteria 		= explode(',', JRequest::getString('criteria'));

?>

<div class="left-module-content">
	<div class="promotion-bar">Tìm kiếm</div>
	
	<form action="index.php" method="get">
		<script type="text/javascript">
			jQuery(function($){
				$('.custom_field, .rating, .price, .criteria').click(function(){
					var el_name = $(this).attr('class');
					var el = $('input[name="'+el_name+'"]');
					
					val = '';

					if ($(this).val() == 'all')
					{
						checkAll($(this), true);
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

				checkAll($('.custom_field'), false);
				checkAll($('.rating'), false);
				checkAll($('.price'), false);
				checkAll($('.criteria'), false);

				function checkAll(element, click)
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
							if (click === true)
							{
								other_el.removeAttr('disabled').removeAttr('checked');
								el.val('');
							}
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
				<label class="title">Loại hình</label>
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
				<?php if (isset($show->price) && $show->price === true): ?>
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
				<?php endif; ?>
				<?php if (isset($show->criteria) && $show->criteria === true): ?>
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
				<?php endif; ?>
				<div class="clear"></div>

				<button class="button fltrgt">Xem kết quả</button>
			</div>
			<div class="clear"></div>
		</div>
		
		
	</form>
	
	<div class="clear"></div>
</div>