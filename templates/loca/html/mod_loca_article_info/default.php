<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_loca_article_info
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="loca-article-info">
	<a href="#" class="userinfo"><?php echo $user->name; ?></a> &bull;
	<span class="dateinfo"><?php echo date('d/m/Y', strtotime($item->created)); ?></span> &bull;
	<span class="countinfo"><?php echo $item->hits; ?> lượt</span> 
	<?php /*?>
	&bull;	
	<span class="commentinfo"><?php echo @$item->count_comment; ?> bình luận</span>
	*/ ?>
</div>