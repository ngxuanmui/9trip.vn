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

<script type="text/javascript">
	var ITEM_ID = <?php echo (int) $item->id; ?>;
	var ITEM_TYPE = '<?php echo $itemType; ?>';
</script>

<?php if ($userGuest): ?>
<a class="like modal user-not-login" href="<?php echo JRoute::_('index.php?option=com_users&view=loca_login&tmpl=component'); ?>" rel="{handler: 'iframe', size: {x: 340, y: 260}, onClose: function() {}}"> Thích</a>
<?php else: ?>
<a class="like user-like <?php if ($checkUserLike) echo 'liked';?>" href="#" id="like-<?php echo $item->id; ?>"> Thích</a>
<?php endif; ?>

<div class="number-liker icons"><?php echo (int) $item->user_like; ?></div>