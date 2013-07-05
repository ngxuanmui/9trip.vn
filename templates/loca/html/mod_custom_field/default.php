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
		<h1>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('hotels', $id)); ?>">
				Khách sạn
			</a>
		</h1>
		<ul>
			<?php foreach ($list['hotels'] as $hotelCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('hotels', $id, $hotelCustomField->id)); ?>">
					<?php echo $hotelCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('services', $id)); ?>">
				Dịch vụ
			</a>
		</h1>
		<ul>
			<?php foreach ($list['services'] as $serviceCustomField): ?>
			<li>				
				<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('services', $id, $serviceCustomField->id)); ?>">
					<?php echo $serviceCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li>
		<h1>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('restaurants', $id)); ?>">
				Nhà hàng
			</a>
		</h1>
		<ul>
			<?php foreach ($list['restaurants'] as $resCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_(NtripHelperRoute::getMainItemsRoute('restaurants', $id, $resCustomField->id)); ?>">
					<?php echo $resCustomField->title; ?> (*)
				</a>				
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('shoppings')); ?>">
				Mua sắm
			</a>
		</h1>
		<ul>
			<?php foreach ($list['shoppings'] as $shoppingCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('shoppings', $shoppingCustomField->id)); ?>">
					<?php echo $shoppingCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li>
		<h1>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('tours')); ?>">
				Tham quan
			</a>
		</h1>
		<ul>
			<?php foreach ($list['tours'] as $tourCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('tours', $tourCustomField->id)); ?>">
					<?php echo $tourCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>
			<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('relaxes')); ?>">
				Giải trí
			</a>
		</h1>
		<ul>
			<?php foreach ($list['relaxes'] as $relaxCustomField): ?>
			<li>
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('relaxes', $relaxCustomField->id)); ?>">
					<?php echo $relaxCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
</ul>