jQuery.noConflict();

jQuery(function($){
	$('.user-toolbar button').click(function(){
		
		var task = $(this).attr('rel');
		var form = $('form[name="userForm"]');
		
		// set task
		$('input[type="hidden"][name="task"]').val(task);
		
		var tmp = task.split('.');
		
		if (tmp[1] == 'cancel')
		{
			// remove validate
			form.stop();
			form.submit();
			
			return false;
		}
		
		// submit form
		if (form.validate())
			form.submit();
		else
			return false;
	});
	
	$('#loca-btn-post-comment').click(function(){
		
		var t = $(this);
		var comment = $('#loca-textarea-comment');
		var msg = $('#comment-msg');
		
		if (t.hasClass('processing'))
			return false;
		
		t.addClass('processing');
		
		if ($.trim(comment.val()) == '')
		{
			t.removeClass('processing');
			msg.removeClass('success').addClass('error').html('Vui lòng nhập vào thông tin bình luận của bạn');
			return false;
		}
		else
		{
			msg.removeClass('error').html('Vui lòng đợi ...');
		}
		
		$.post(
				'index.php?option=com_ntrip_comment&task=comment.post',
				/* ITEM_ID, ITEM_TYPE was defined in form */
				{content: comment.val(), item_id: ITEM_ID, item_type: ITEM_TYPE, parent_id: $('#comment-parent-id').val()},
				function(res)
				{
					t.removeClass('processing');
					
					if (res == 'OK')
					{
						comment.val('');
						msg.removeClass('error').addClass('success').html('Cảm ơn bạn. Bình luận của bạn đã được gửi!');
					}
					else
						msg.removeClass('success').addClass('error').html('Xin lỗi bạn. Có lỗi xảy ra. Vui lòng thử lại sau!');
						
				}
		);
		
		return false;
	});
	
	
	Galleria.loadTheme(BASE_URL + 'media/loca/galleria/themes/azur/galleria.azur.min.js');
	Galleria.configure({
			imageCrop: 'landscape',
			imageMargin: 60,
			imagePosition: 'top',
			transition: 'fade',
			showCounter: false,
			idleMode: 'hover',
			idleSpeed: 500,
			fullscreenTransition: false,
			trueFullscreen: false
		});
		
	Galleria.run('#galleria');
	
})