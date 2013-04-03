<?php
// No direct access.
defined('_JEXEC') or die;
?>

<script type="text/javascript">
<!--
jQuery(function($){

	$('.loca-location-container').hover(
	        function () {
	            //show its submenu
	            $('ul', this).stop().slideDown(200);
	        }, 
	        function () {
	            //hide its submenu
	            $('ul', this).stop().slideUp(200);            
	        }
	    );
});
//-->
</script>

<div class="menu-container">
	<ul id="main-menu">
		<li><a href="<?php echo JURI::base(); ?>">Trang chủ</a></li>
		<li class='loca-location-container relative'>
			<a href="#" id='loca-location'>Địa danh</a>

			<ul class='show-locations absolute'>
				<li>
					<?php echo LocaHelper::renderModulesOnPosition('dia-danh-mien-bac'); ?>
				</li>
				<li>
					<?php echo LocaHelper::renderModulesOnPosition('dia-danh-mien-trung'); ?>
				</li>
				<li>
					<?php echo LocaHelper::renderModulesOnPosition('dia-danh-mien-nam'); ?>
				</li>
			</ul></li>
		<li><a href="#">Khám phá</a></li>
		<li><a href="#">Khuyến mại</a></li>
		<li><a href="#">Hỏi đáp - Tư vấn</a></li>
		<li><a href="#">Cảnh báo</a></li>
		<li><a href="#">Album</a></li>
		<li><a href="#">Diễn đàn</a></li>
	</ul>
</div>