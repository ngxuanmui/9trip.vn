<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom_field
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$id = JRequest::getInt('id');
$linkId = ($id) ? '&id=' . $id : '';
?>

<p class="custom-field-title">Nhà cung cấp dịch vụ - Khám phá - Du ngoạn</p>

<ul class="custom-field">
	<li>
		<h1>Khách sạn</h1>
		<ul>
			<?php foreach ($list['hotels'] as $hotelCustomField): ?>
			<li>
				<?php 
				
				?>
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('hotels', $hotelCustomField->id), false); ?>">
					<?php echo $hotelCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>Dịch vụ</h1>
		<ul>
			<?php foreach ($list['services'] as $serviceCustomField): ?>
			<li>				
				<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=services&custom_field=' . $serviceCustomField->id . $linkId, false); ?>">
					<?php echo $serviceCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li>
		<h1>Nhà hàng</h1>
		<ul>
			<?php foreach ($list['restaurants'] as $resCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=restaurants&custom_field=' . $resCustomField->id . $linkId, false); ?>">
					<?php echo $resCustomField->title; ?> (*)
				</a>				
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>Mua sắm</h1>
		<ul>
			<?php foreach ($list['shoppings'] as $shoppingCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=shoppings&custom_field=' . $shoppingCustomField->id . $linkId, false); ?>">
					<?php echo $shoppingCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li>
		<h1>Tham quan</h1>
		<ul>
			<?php foreach ($list['tours'] as $tourCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=tours&custom_field=' . $tourCustomField->id . $linkId, false); ?>">
					<?php echo $tourCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>Giải trí</h1>
		<ul>
			<?php foreach ($list['relaxes'] as $relaxCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_ntrip&view=relaxes&custom_field=' . $relaxCustomField->id . $linkId, false); ?>">
					<?php echo $relaxCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
</ul>