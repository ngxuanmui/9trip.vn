<?php

?>
<div class="clr"></div>
<div class="comments">
	<div class="social">
		<img src="<?php echo JURI::base(); ?>/templates/loca/images/sample/article-social-like.png" />
		
		<div class="tags-container">
			<span class="fltlft tags icons"></span>
			<span class="fltlft">Dis proin, elementum ac duis, enim magnis, </span>
			
			<div class="clr"></div>
		</div>
	</div>
	
	<div class="list-comments">
		
		<div class="comment-content">
			<div class="avatar fltlft">
				et placerat turpis
			</div>
			<div class="comment-content-container fltlft">
				<div class="comment-user-info">
					Nguyễn Xuân Mùi

					<img src="<?php echo JURI::base(); ?>/templates/loca/images/sample/star.png" />

					<span>Ngày 12/12/1212</span>
				</div>
				
				<p>Enim ac! Turpis massa a enim porttitor? Pulvinar montes, dis sed lundium</p>
				
				<div class="clr"></div>
				
				<div class="comment-like">
					<img src="<?php echo JURI::base(); ?>/templates/loca/images/sample/comment-like.png" />
				</div>
				
				<div class="clr"></div>
				
				<div class="list-other-comments">
					<div class="comment-user-info">
						
					</div>
					<div class="avatar fltlft">
						et placerat turpis
					</div>
					<div class="sub-comment-content fltlft">
						<p>Augue montes amet adipiscing adipiscing enim hac, nec sit vel phasellus ultrices amet, etiam? Egestas a?</p>
						
					</div>
				</div>
					
			</div>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<form action="<?php echo JRoute::_('index.php'); ?>" id="loca-frm-comment">
		<div class="post-comment" style="margin: 10px 0;">
			Post in 
			<select>
				<option value="">New comment</option>
				<option value="1">Reply for first comment</option>
			</select>
			<textarea style="height: 100px; width: 100%; margin: 10px 0 0;" id="loca-textarea-comment"></textarea>
			<div class="clr"></div>
		</div>
		<a href="#" class="icons loca-button-smaller fltlft" id="loca-btn-post-comment">Bình luận</a>
		<?php echo JHtml::_('form.token'); ?>
	</form>

	<div class="clr"></div>
</div>