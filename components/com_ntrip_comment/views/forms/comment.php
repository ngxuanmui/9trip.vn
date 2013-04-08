<?php
//var_dump($listComments);
?>

<div class="clr"></div>

<div class="comments">
	
	<div class="list-comments">
		
		
		<div class="comment-content">
			<?php foreach ($listComments as $comment): ?>
			<div class="avatar fltlft">
				Avatar
			</div>
			<div class="comment-content-container fltlft">
				<div class="comment-user-info">
					<?php echo $comment->username ? $comment->username : 'Anonymous'; ?>

					<img src="<?php echo JURI::base(); ?>/templates/loca/images/sample/star.png" />

					<span><?php echo $comment->created; ?></span>
				</div>
				
				<p><?php echo $comment->content; ?></p>
				
				<div class="clr"></div>
				
				<div class="comment-like">
					<img src="<?php echo JURI::base(); ?>/templates/loca/images/sample/comment-like.png" />
				</div>
				
				<?php 
				$subComments = $comment->subComments ? $comment->subComments : array();
				if (!empty($subComments)):
					foreach ($subComments as $sub):
				?>
				<div class="list-other-comments">
					<div class="comment-user-info">
						<?php echo $sub->username ? $sub->username : 'Anonymous'; ?>
					</div>
					<div class="avatar fltlft">
						Avatar
					</div>
					<div class="sub-comment-content fltlft">
						<?php echo $sub->content; ?>
					</div>
					<div class="clr"></div>
				</div>
				<?php 
					endforeach;
				endif; 
				?>
					
			</div>
			<div class="clr"></div>
			<?php endforeach; ?>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<?php if (JFactory::getUser()->id): ?>
	<form action="<?php echo JRoute::_('index.php'); ?>" id="loca-frm-comment">
		<div class="post-comment" style="margin: 10px 0;">
			<?php if ($isItemOwner): ?>
			Gửi bình luận: 
			<select name="loca_comment_parent_id" id="comment-parent-id">
				<option value="">Bình luận mới</option>
				<?php 
				foreach ($listComments as $comment): 
					$author = $comment->username ? $comment->username : 'Anonymous';
				?>
				<option value="<?php echo $comment->id; ?>"><?php echo JHtml::_('string.truncate', $comment->content, 50) . '('.$author.')'; ?></option>
				<?php endforeach; ?>
			</select>
			<?php endif; ?>
			<textarea style="height: 100px; width: 100%; margin: 10px 0 0;" id="loca-textarea-comment"></textarea>
			<div class="clr"></div>
		</div>
		<button class="icons button fltrgt" id="loca-btn-post-comment">
			Bình luận
		</button>
		<div class="fltlft error comment-msg" id="comment-msg"></div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
	<?php endif; ?>

	<div class="clr"></div>
</div>