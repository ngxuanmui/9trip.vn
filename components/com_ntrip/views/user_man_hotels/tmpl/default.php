<?php
defined('_JEXEC') or die;

$items = $this->items;

//var_dump($items);
?>

<div class="profile-menu">
	<?php echo LocaHelper::renderModulesOnPosition('profile-menu') ?>
</div>

<form method="post" action="<?php echo ''; ?>">
	<table>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Location</th>
			<th>State</th>
		</tr>
		<?php foreach ($items as $key => $item): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td>
				<a href="<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.edit&id='. $item->id . '&Itemid=' . JRequest::getInt('Itemid'), false); ?>">
					<?php echo $item->name; ?>
				</a>
			</td>
			<td><?php echo $item->category_title; ?></td>
			<td><?php echo ($item->state == 1) ? 'Yes' : 'No'; ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="10">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
		
		<tr>
			<td colspan="10">
				<button type="button" onclick="javascript:location.href='<?php echo JRoute::_('index.php?option=com_ntrip&task=user_man_hotel.add', false); ?>'">Add new</button>
			</td>
		</tr>
	</table>
</form>