<?php
// no direct access
defined('_JEXEC') or die;

$item = $this->item;

$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base() . 'media/loca/lightbox/css/lightbox.css');
?>

<script type="text/javascript">
	var fileLoadingImage = '<?php echo JURI::base(); ?>media/loca/lightbox/images/loading.gif';
	var fileCloseImage = '<?php echo JURI::base(); ?>media/loca/lightbox/images/close.png';
</script>

<script src="<?php echo JURI::base(); ?>media/loca/lightbox/js/lightbox.js"></script>

<div id="top-adv">
	<img src="<?php echo JURI::base() . 'templates/loca/images/top-adv.jpg'; ?>" />
</div>

<div class="clear"></div>

<div id="left-content">
	<div class="margin-bottom5">
		<div class="title-category">
			Album ảnh: <?php echo $item->name; ?>
		</div>
		
		<div class="item-container item-detail">
			
			<?php if (!empty($this->otherImages)): ?>
			<div class="other-images">
				<ul>
					<?php foreach ($this->otherImages as $img): ?>
					<li class="img">
						<a href="<?php echo JURI::base(); ?>images/albums/<?php echo $item->id; ?>/<?php echo $img->images; ?>" rel="lightbox[album]">
							<img src="<?php echo JURI::base(); ?>images/albums/<?php echo $item->id; ?>/thumbnail/<?php echo $img->images; ?>" />
						</a>						
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<div class="clr"></div>
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