<?php
// No direct access.
defined('_JEXEC') or die;
?>

<script type="text/javascript">
<!--
jQuery(function($){

	$("ul.loca-location-container li").hover(function(){
	    
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');
    
    }, function(){
    
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
    
    });
});
//-->
</script>

<div class="menu-container">
	<ul class="main-menu">
		<li><a href="<?php echo JURI::base(); ?>">Trang chủ</a></li>
		<li class='loca-location-container relative'>
			<a id='loca-location'>
				<?php 
				if ($locaCategory->title != 'ROOT')
					echo $locaCategory->title;
				else
					echo 'Địa danh';					
				?>
				
			</a>

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
			</ul>
		</li>		
	</ul>
	
	<?php echo LocaHelper::renderModulesOnPosition('main-top-menu'); ?>
	
	<?php /*
	<ul class="main-menu">
		<li><a href="#">Khám phá</a></li>
		<li><a href="#">Khuyến mại</a></li>
		<li><a href="#">Hỏi đáp - Tư vấn</a></li>
		<li><a href="#">Cảnh báo</a></li>
		<li><a href="#">Album</a></li>
		<li><a href="#">Diễn đàn</a></li>
	</ul>
	 */ ?>
</div>