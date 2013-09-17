<?php
// No direct access.
defined('_JEXEC') or die;

$homePage = false;

$app = JFactory::getApplication();

$menu = $app->getMenu();

if ($menu->getActive() == $menu->getDefault()) 
	$homePage = true;

$id = JRequest::getInt('id');

$catId = JRequest::getInt('catid', 0);

// var_dump($_GET);

if (!$catId && $_GET['option'] == 'com_ntrip')
	$catId = $id;

if ($_GET['option'] != 'com_ntrip')
{
	$sess = JFactory::getSession();
	$catId = $sess->get('loca-location', null);
}
?>

<?php #if (!$homePage || JRequest::getCmd('view', '') == 'not_found'): ?>
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
<?php #endif; ?>

<div class="menu-container">
	<ul class="main-menu">
		<li id="menu-home-page"><a href="<?php echo JURI::base(); ?>" class='home'></a></li>
		<li class='loca-location-container relative'>
			<a id='loca-location'>
				<?php 
				if ($locaCategory->title != 'ROOT')
					echo $locaCategory->title;
				else
					echo 'Địa danh';					
				?>
				
			</a>

			<ul class='show-locations absolute' <?php /*if ($homePage && JRequest::getCmd('view', '') != 'not_found'):?>style="display: block;"<?php endif; */ ?>>
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
	
	<?php if ($catId > 0): ?>
	<ul class="main-menu">
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('discovers', $catId)); ?>">
				Khám phá du lịch
			</a>
		</li>
		<?php /*
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('questions', $catId)); ?>">
				Tour du lịch
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('warnings', $catId)); ?>">
				Cần lưu ý
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('promotions', $catId)); ?>">
				Khuyến mãi
			</a>
		</li>
		*/ ?>
		<li>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('albums', $catId)); ?>">
				Album ảnh
			</a>
		</li>
	</ul>
	<?php endif; ?>
</div>