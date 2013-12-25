<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>

<div id="left-content">
	<div class="margin-bottom5">
		<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="title-category"><?php echo $this->escape($this->params->get('page_heading')); ?></div>
		<?php endif; ?>

		<div class="clr"></div>
	</div>

	<?php /*?>
	<div class="tabs">
		<?php //echo LocaHelper::renderModulesOnPosition('menu-kham-pha'); ?>
		
		<ul class="menu tab-categories">
			<?php foreach ($fields as $field): ?>
			<li <?php if (JRequest::getInt('custom_field') == $field->id) echo 'class="active"'; ?>>
				<a href="<?php echo JRoute::_('index.php?Itemid=' . JRequest::getInt('Itemid') . '&custom_field=' . $field->id); ?>"><?php echo $field->title; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>

		<div class="clr"></div>
	</div>
	*/ ?>

	<div class="list-hotels-container">


		<div class="items">
			<ul class="list-discovers">
				<?php
					$introcount=(count($this->intro_items));
					$counter=0;
				?>
				<?php if (!empty($this->intro_items)) : ?>
				
					<?php foreach ($this->intro_items as $key => &$item) : ?>
					
				<li>
					<?php
						$this->item = &$item;
						echo $this->loadTemplate('item');
					?>
				</li>
				<?php endforeach; ?>
				
				<?php endif; ?>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>

</div>

<div id="right-content">
	<a class="register"
		href="<?php echo JRoute::_('index.php?option=com_users&view=registration', false); ?>"
		style="display: block;"> <span class="icon-reg"></span> <span
		class="txt-register">ĐĂNG KÝ THÀNH VIÊN</span>
	</a>

	<?php echo LocaHelper::renderModulesOnPosition('right'); ?>

</div>
<div class="clear"></div>
