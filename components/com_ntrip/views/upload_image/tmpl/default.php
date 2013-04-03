<?php
// no direct access
defined('_JEXEC') or die;
?>

<form id="form-upload-image" class="relative">
	<h1>Thêm ảnh mới</h1>
	
	<div id="dropbox">
		<span class="message">Kéo ảnh thả vào đây để upload</span>
	</div>
	
	<p>Chú thích</p>
	
	<textarea id="desc-upload-image"></textarea>
	
	<p>
		<button type="button" id="btn-upload-image">Upload ảnh</button>
	</p>
</form>

<script type="text/javascript">
	var UPLOAD_URL = '<?php echo JRoute::_('index.php?option=com_ntrip&task=other.upload'); ?>';
</script>

<!-- Including the HTML5 Uploader plugin -->
<script src="<?php echo JURI::base(); ?>media/loca/jquery.filedrop.js"></script>
		
<!-- The main script file -->
<script src="<?php echo JURI::base(); ?>media/loca/upload-image.js"></script>