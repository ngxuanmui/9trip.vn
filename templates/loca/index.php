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

// $doc->addScript('//maps.google.com/maps/api/js?sensor=true');
$doc->addScript(JURI::base() . 'media/loca/jquery-1.7.2.min.js');
$doc->addScript(JURI::base() . 'media/loca/main.js');
$doc->addScript(JURI::base() . 'media/loca/galleria/galleria-1.2.9.min.js');
$doc->addScript(JURI::base() . 'media/loca/jquery.validate.js');

// load modal by default
JHtml::_('behavior.modal');

$this->setGenerator('Loca.vn');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<jdoc:include type="head" />

<meta name="google-site-verification" content="sRu5Wonzf9Y8Pb6gfABlq0DvJrySoN2ead2I_AxpEdE" />

<!--[if IE 7]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript">
	var BASE_URL = '<?php echo JURI::base(); ?>';
</script>
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=492429447479171";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
	<div id="main-container">
		
		<jdoc:include type="modules" name="header-user" />
		
		<jdoc:include type="modules" name="loca-main-menu" />
		
				
		
		<div class="component">
				
			<div class="main-content">
				
				<div id="top-adv">
					<div class="banner">
						<jdoc:include type="modules" name="loca-top-banner" />
					</div>
				</div>
				
				<div class="clear"></div>
				
				<div id="breadcrumbs">
				 	<jdoc:include type="modules" name="position-2" />
				 </div>

				<div class="clear"></div>
				 
				<jdoc:include type="message" />
				 
				<jdoc:include type="component" />
			</div>
		</div>
		
		<!-- footer -->
		<div id="footer">
			<div class="main-footer">
				<jdoc:include type="modules" name="bottom-links" />
				<div class="clear"></div>
			</div>
		</div>

		<!-- bottom -->
		<div id="bottom">
			<div class="separate-bottom"></div>
			<div id="copyright-info">
				<div class="copyright-text">
					&copy; <?php echo date('Y'); ?> - Loca.vn <br />
					Thông tin liên hệ <br />
					Mobile: 0915.019.790 – Mr.Nam<br />
					Email: <a href="mailto:namtroi@gmail.com">namtroi@gmail.com</a>
				</div>
				<div class="bottom-logo">
					<a
						href="http://www.dmca.com/Protection/Status.aspx?ID=fb933b64-9581-43aa-b455-16a03df750da"
						title="DMCA"> <img
						src="http://images.dmca.com/Badges/DMCA_logo-green150w.png?ID=fb933b64-9581-43aa-b455-16a03df750da"
						alt="DMCA.com" />
					</a>
				</div>
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
	
	<a href="<?php echo JRoute::_(NtripHelperRoute::getOtherRoute('feedback', true)); ?>" class="feedback-btn modal" rel="{handler: 'iframe', size: {x: 420, y: 290}, onClose: function() {}}"></a>
	
	<jdoc:include type="modules" name="debug" />
</body>
</html>
