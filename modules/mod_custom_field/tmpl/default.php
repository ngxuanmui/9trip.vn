<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<p class="custom-field-title">Nhà cung cấp dịch vụ - Khám phá - Du ngoạn</p>

<ul class="custom-field">
	<li>
		<h1>Khách sạn</h1>
		<ul>
			<?php foreach ($list['hotels'] as $hotelCustomField): ?>
			<li><?php echo $hotelCustomField->title; ?> (*)</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>Dịch vụ</h1>
		<ul>
			<?php foreach ($list['services'] as $tourCustomField): ?>
			<li><?php echo $tourCustomField->title; ?> (*)</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li>
		<h1>Nhà hàng</h1>
		<ul>
			<?php foreach ($list['restaurants'] as $resCustomField): ?>
			<li><?php echo $resCustomField->title; ?> (*)</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>Mua sắm</h1>
		<ul>
			<?php foreach ($list['shoppings'] as $tourCustomField): ?>
			<li><?php echo $tourCustomField->title; ?> (*)</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li>
		<h1>Tham quan</h1>
		<ul>
			<?php foreach ($list['tours'] as $tourCustomField): ?>
			<li><?php echo $tourCustomField->title; ?> (*)</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
		<h1>Giải trí</h1>
		<ul>
			<?php foreach ($list['relaxes'] as $tourCustomField): ?>
			<li><?php echo $tourCustomField->title; ?> (*)</li>
			<?php endforeach; ?>
		</ul>
	</li>
</ul>