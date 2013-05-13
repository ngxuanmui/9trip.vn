<?php
/**
 * @package                Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright        Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license                GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');

$doc = JFactory::getDocument();

$doc->addStyleSheet($this->baseurl.'/templates/system/css/system.css');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/grid.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/styles.css', $type = 'text/css', $media = 'screen,projection');

$doc->addScript(JURI::base() . 'media/loca/jquery-1.7.2.min.js');
$doc->addScript(JURI::base() . 'media/loca/main.js');
$doc->addScript(JURI::base() . 'media/loca/galleria/galleria-1.2.9.min.js');
$doc->addScript(JURI::base() . 'media/loca/jquery.validate.js');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<jdoc:include type="head" />

<!--[if IE 7]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript">
	var BASE_URL = '<?php echo JURI::base(); ?>';
</script>
</head>

<body>
	
	<div id="main-container">
		
		<jdoc:include type="modules" name="header-user" />
		
		<jdoc:include type="modules" name="loca-main-menu" />
		
		<div class="banner">
			<jdoc:include type="modules" name="banner" />
		</div>
		
		<div class="component">
			<div class="main-content">
				<jdoc:include type="message" />
				<jdoc:include type="component" />
			</div>			
		</div>
		
		<!-- footer -->
		<div id="footer">
			<div class="main-footer">
				<div class="tab">
					<div class="title">Chuẩn bị</div>
					<div class="list-content">
						<a href="">Chuẩn bị trước chuyến đi</a>
						<a href="">Chăm sóc sức khỏe</a>
						<a href="">Du lịch an toàn</a>
						<a href="">Thiết bị hỗ trợ</a>
						<a href="">Phương tiện di chuyển</a>
						<a href="">An toàn thực phẩm</a>
					</div>
				</div>
				<div class="tab">
					<div class="title">Trải nghiệm</div>
					<div class="list-content">
						<a href="">Chuẩn bị trước chuyến đi</a>
						<a href="">Chăm sóc sức khỏe</a>
						<a href="">Du lịch an toàn</a>
						<a href="">Thiết bị hỗ trợ</a>
						<a href="">Phương tiện di chuyển</a>
						<a href="">An toàn thực phẩm</a>
					</div>
				</div>
				<div class="tab" style="padding-right: 0;">
					<div class="title">Chia sẻ</div>
					<div class="list-content">
						<a href="">Chuẩn bị trước chuyến đi</a>
						<a href="">Chăm sóc sức khỏe</a>
						<a href="">Du lịch an toàn</a>
						<a href="">Thiết bị hỗ trợ</a>
						<a href="">Phương tiện di chuyển</a>
						<a href="">An toàn thực phẩm</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<!-- bottom -->
		<div id="bottom">
			<div class="display-all">Hiển thị toàn bộ</div>
			<div class="separate-bottom"></div>
			<div class="menu-bottom-containter">
				<ul id="menu-bottom">
					<li><a href="#">Trang chủ</a></li>
					<li><a href="#">Địa danh</a></li>
					<li><a href="#">Khám phá</a></li>
					<li><a href="#">Khuyến mại</a></li>
					<li><a href="#">Hỏi đáp - tư vấn</a></li>
					<li><a href="#">Cảnh báo</a></li>
					<li><a href="#">Album ảnh</a></li>
					<li><a href="#">Diễn đàn</a></li>
				</ul>
			</div>
			<div id="copyright-info">
				<div class="copyright-text">
					&copy; Copyright 2013 Loca Co.,Ltd <br />
					Địa chỉ liên hệ: Đại Kim - Hoàng Mai - Hà Nội <br />
					Số điện thoại: 09123456789 / Fax: 043 216 363 <br />
					Email: local-travel@gmail.com
				</div>
				<div class="bottom-logo"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-12118548-3']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	
	</script>

	<jdoc:include type="modules" name="debug" />
</body>
</html>
