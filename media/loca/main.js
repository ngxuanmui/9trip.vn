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
		if (typeof ITEM_ID !== 'undefined' && typeof ITEM_TYPE !== 'undefined')
			$.post(
				'index.php?option=com_ntrip&task=other.save_image',
				{item_id: ITEM_ID, item_type: ITEM_TYPE, desc: $('#desc-upload-image').val()},
				function(INFO) {
					if (INFO == 'OK') {
						window.parent.SqueezeBox.close();
					}
				}
			);
	});
	
	// check button upload 
	$('#btn-add-image').click(function(){
		if ($(this).attr('login') !== 'yes')
		{
			show_error();
			return false;
		}
	});
	
	function show_error()
	{
		var error = $('.error-msg');
		error.fadeIn('slow');
		setTimeout(function(){ error.fadeToggle('slow'); }, 3000);
	}
	
	$('button.show-image').click(function(){
		$(this).addClass('show-image-focus');
		$('#show-album').css('display', 'block');
		$('#show-map').css('display', 'none');
		$('button.show-map').removeClass('show-map-focus');
	});

	$('button.show-map').click(function(){
		$(this).addClass('show-map-focus');
		$('#show-album').css('display', 'none');
		$('#show-map').css('display', 'block');
		$('button.show-image').removeClass('show-image-focus');
	});

	// LOAD MAP
	jQuery('#show-map').css({'height':'400', 'width':'628'});

	if (typeof GMAP_LAT !== 'undefined')
	{
		initialize(GMAP_LAT, GMAP_LONG, GMAP_ADD, 'show-map');
	}
		
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

function initialize(gmaps_latitude, gmaps_longitude, address_title, map_canvas) 
{
	var mapOptions = {
		center: new google.maps.LatLng(gmaps_latitude, gmaps_longitude),
		zoom: 16,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById(map_canvas), mapOptions);

	var marker = new google.maps.Marker({
		position: map.getCenter(),
		map: map,
		title: address_title
	  });

	  google.maps.event.addListener(map, 'center_changed', function() {
		// 3 seconds after the center of the map has changed, pan back to the
		// marker.
		/*window.setTimeout(function() {
		  map.panTo(marker.getPosition());
		}, 3000);*/
	  });

	  google.maps.event.addListener(marker, 'click', function() {
		map.setZoom(16);
		map.setCenter(marker.getPosition());
	  });
}