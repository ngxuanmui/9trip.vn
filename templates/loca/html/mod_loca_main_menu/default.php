<?php
// No direct access.
defined('_JEXEC') or die;

$homePage = false;

$app = JFactory::getApplication();

$menu = $app->getMenu();

if ($menu->getActive() == $menu->getDefault()) 
	$homePage = true;

$id = JRequest::getInt('id');
?>

<?php if (!$homePage): ?>
<script type="text/javascript">
<!--

jQuery(function($){
	  $('li.loca-location-container').hover(function () {
	     clearTimeout($.data(this, 'timer'));
	     $('ul', this).stop(true, true).slideDown(0);
	  }, function () {
	    $.data(this, 'timer', setTimeout($.proxy(function() {
	      $('ul', this).stop(true, true).slideUp(0);
	    }, this), 200));
	  });
	});
//-->
</script>
<?php endif; ?>

<div class="menu-container">
	<ul class="main-menu">
		<li id="menu-home-page"><a href="<?php echo JURI::base(); ?>">Trang chủ</a></li>
		<li class='loca-location-container relative'>
			<a id='loca-location'>
				<?php 
				if ($locaCategory->title != 'ROOT')
					echo $locaCategory->title;
				else
					echo 'Địa danh';					
				?>
				
			</a>

			<ul class='show-locations absolute' <?php if ($homePage):?>style="display: block;"<?php endif; ?>>
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
	
	<?php 
	//if (!JRequest::getInt('id') || !JRequest::getInt('catid')):
		//echo LocaHelper::renderModulesOnPosition('main-top-menu'); 
	//else:
	?>
	
	<ul class="main-menu">
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('discovers', $id)); ?>">
				Khám phá du lịch
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('questions', $id)); ?>">
				Tour du lịch
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('warnings', $id)); ?>">
				Cần lưu ý
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('promotions', $id)); ?>">
				Khuyến mãi
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('albums', $id)); ?>">
				Album ảnh
			</a>
		</li>
	</ul>
	<?php //endif; ?>
</div>