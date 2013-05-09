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
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('hotels', $hotelCustomField->id)); ?>">
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
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('services', $serviceCustomField->id)); ?>">
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
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('restaurants', $resCustomField->id)); ?>">
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
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('shoppings', $shoppingCustomField->id)); ?>">
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
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('tours', $tourCustomField->id)); ?>">
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
				<a href="<?php echo JRoute::_(NtripHelperRoute::getItemsRoute('relaxes', $relaxCustomField->id)); ?>">
					<?php echo $relaxCustomField->title; ?> (*)
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
</ul>