<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_stats
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$userGuest = JFactory::getUser()->guest;

$rank = round($item->user_rank);

$checkUserRating = NtripFrontHelper::checkUserRating($item->id, $itemType);
$rank = round($item->user_rank); 
?>

<script type="text/javascript">
<!--
if (typeof ITEM_ID === 'undefined')
	var ITEM_ID = <?php echo $item->id ? $item->id : 0; ?>;

if (typeof ITEM_TYPE === 'undefined')
	var ITEM_TYPE = '<?php echo $itemType; ?>';
//-->
</script>
<div id="<?php echo $item->id; ?>" class="rating-content rate_widget" rated="<?php echo $rank; ?>">						
	<?php for ($i = 1; $i <= 5; $i ++): ?>
	<div class="<?php if (!$checkUserRating): ?>user-rating<?php endif;?> star_<?php echo $i; ?> ratings_stars <?php if ($i <= $rank) echo 'ratings_vote'; ?>"></div>
	<?php endfor; ?>
	<span class="total_votes total_votes-detail"> <?php echo $item->count_rating; ?> đánh giá</span>
</div>
