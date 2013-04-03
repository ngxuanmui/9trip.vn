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
	
	
	if ($('#galleria').length > 0)
	{
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
	}
		
	// Rating
	var widget = $('.rate_widget');
//	set_votes(widget);		

	$('.ratings_stars').hover(
		// Handles the mouseover
		function() {
			$(this).prevAll().andSelf().addClass('ratings_over');
			$(this).nextAll().removeClass('ratings_vote');
		},
		// Handles the mouseout
		function() {
			$(this).prevAll().andSelf().removeClass('ratings_over');
			
			var avg = $(this).parent().attr('rated');
			
			jQuery(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
			jQuery(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
			
//			set_votes($(this).parent());
		}
	);

	$('.like').click(
		function() {
			var item_id = $(this).attr('id');
			var tmp = item_id.split('-');
			var t = $(this);
			item_id = tmp[1];
			jQuery.post(
				'index.php?option=com_ntrip&task=other.like',
				{item_id: item_id, item_type: ITEM_TYPE},
				function(data) {
					if (data == 'OK') {
						tmp = $('.number-liker').html();
						tmp = parseInt(tmp);
						var current_liker = tmp + 1;
//						alert('Bạn đã like thành công')
						t.addClass('liked');
						$('.number-liker').html(current_liker);
					}
				}
			);
			
			return false;
		}
	);

	// This actually records the vote
	$('.ratings_stars').bind('click', function() {
		
		jQuery('.total_votes').html('Vui lòng đợi ...');
		
		var star = this;
		var widget = $(this).parent();

		var clicked_data = {
			clicked_on : $(star).attr('class'),
			item_id : ITEM_ID,
			item_type: ITEM_TYPE
		};

		$.post(
			'index.php?option=com_ntrip&task=other.rating',
			clicked_data,
			function(INFO) {
				if (INFO == 'OK') {
					set_votes(widget);
				}
			}
		);
	});
	
	// upload image
	$('#btn-upload-image').click(function(){
		$.post(
			'index.php?option=com_ntrip&task=other.save_image',
			{item_id: 12, item_type: 'hotels', desc: $('#desc-upload-image').val()},
			function(INFO) {
				if (INFO == 'OK') {
					window.parent.SqueezeBox.close();
				}
			}
		);
	});
		
});

function set_votes(widget) {
	var item_id = widget.attr('id');
	jQuery.post(
		'index.php?option=com_ntrip&task=other.get_rating',
		{item_id: item_id, item_type: ITEM_TYPE},
		function(data) {
			var rating_data = data.split('##');
			jQuery('.total_votes').html = '';
			jQuery('.total_votes').html(rating_data[0] + ' đánh giá');
			var avg = rating_data[1];
			jQuery(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
			jQuery(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
		}
	);
}