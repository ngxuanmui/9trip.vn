<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ntrip
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_ntrip.category');
$saveOrder	= $listOrder=='ordering';
$params		= (isset($this->state->params)) ? $this->state->params : new JObject();
?>

<div class="profile-menu">
	<?php echo LocaHelper::renderModulesOnPosition('profile-menu') ?>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_ntrip&view=restaurants'); ?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th>
					<?php echo JHtml::_('grid.sort',  'COM_NTRIP_HEADING_NAME', 'a.name', $listDirn, $listOrder); ?>
				</th>
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
				</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort', 'COM_NTRIP_HEADING_LOCATION', 'category_title', $listDirn, $listOrder); ?>
				</th>
				<th width="5%">
					<?php echo JText::_('COM_NTRIP_HEADING_COMMENT'); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="13">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item): ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
						<a href="<?php echo JRoute::_('index.php?option=com_ntrip&task=restaurant.edit&id='.(int) $item->id); ?>">
							<?php echo $this->escape($item->name); ?>
						</a>
						<p class="smallsub">
							<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias));?>
						</p>
				</td>
				<td class="center">
					<?php echo JHtml::_('jgrid.published', $item->state, $i, 'restaurants.', false, 'cb', $item->publish_up, $item->publish_down); ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->category_title); ?>
				</td>
				<td class="center">
					<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=comments&type=restaurant&item_id='.$item->id); ?>">
						<?php echo JText::_('COM_NTRIP_HEADING_COMMENT'); ?>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<?php //Load the batch processing form. ?>
	<?php // echo $this->loadTemplate('batch'); ?>

	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
