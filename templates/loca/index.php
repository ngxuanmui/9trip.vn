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

$doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />

<!--[if IE 7]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
<![endif]-->

</head>

<body>
	
	<div id="main-container">
		<div id="main-header">
			<div class="logo"></div>
			<div class="right">
				<div>
					<a href="#">Đăng nhập bằng Facebook</a> | 
					<a href="#">Đăng nhập</a> |
					<a href="#">Đăng ký</a>
				</div>
				<div>
					<input type="text" size="50" name="search" value="" placeholder="Nhập thông tin cần tìm" />
				</div>
			</div>
	    </div>
		<div class="menu-container">
			<ul id="main-menu">
				<li><a href="#">Trang chủ</a></li>
				<li><a href="#">Địa danh</a></li>
				<li><a href="#">Khám phá</a></li>
				<li><a href="#">Khuyến mại</a></li>
				<li><a href="#">Hỏi đáp - Tư vấn</a></li>
				<li><a href="#">Cảnh báo</a></li>
				<li><a href="#">Album</a></li>
				<li><a href="#">Diễn đàn</a></li>
			</ul>
		</div>
		
		<div class="banner">
			<jdoc:include type="modules" name="banner" />
		</div>
		
		<jdoc:include type="message" />
		
		<div class="component">
			<jdoc:include type="component" />
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
	</div>
	
	<jdoc:include type="modules" name="debug" />
</body>
</html>
