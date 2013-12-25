<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

$item = $this->item;

$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));

?>

<h2>
	<a href="<?php echo $link; ?>">
		<?php echo $item->title; ?>
	</a>
</h2>

<?php if (!empty($item->intro_images)): ?>
<div class="img">
	<a href="<?php echo $link; ?>">
		<img src="<?php echo $item->intro_images; ?>" />
	</a>
</div>
<?php endif; ?>

<div class="description">
	<?php echo JHtml::_('string.truncate', strip_tags($item->introtext), 100); ?>
</div>
<div class="clr" style="padding-top: 10px;"></div>

<a href="<?php echo $link; ?>" class="block icons loca-button fltright"> <span
		class="txt-btn">Chi tiết &raquo;</span>
</a>
	
<div class="clr"></div>

<div class="saparate-line"></div>
