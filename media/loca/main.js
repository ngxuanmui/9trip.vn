jQuery.noConflict();

jQuery(function($){
	$('.user-toolbar button').click(function(){
		
		var task = $(this).attr('rel');
		var form = $('form[name="userForm"]');
		
		// set task
		$('input[type="hidden"][name="task"]').val(task);
		
		var tmp = task.split('.');
		
		if (tmp[1] == 'cancel' || tmp[1] == 'add')
		{
			// remove validate
			$(form).validate().cancelSubmit = true;
			$(form).submit();
			
			return false;
		}
		
		validate = form.validate({ errorPlacement: function(error, element) {} });
		
		// submit form
		if (validate)
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
				{content: comment.val(), item_id: ITEM_ID_COMMENT, item_type: ITEM_TYPE_COMMENT, parent_id: $('#comment-parent-id').val()},
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
				trueFullscreen: false,
				_showFullscreen: false
			});

		Galleria.run('#galleria');
	}

	$('.user-like').click(
		function() {
			
			liked = $(this).hasClass('liked');
		
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
						if (liked)
						{
							var current_liker = tmp - 1;
//							alert('Bạn đã like thành công')
							t.removeClass('liked');
						}
						else
						{
							var current_liker = tmp + 1;
//							alert('Bạn đã like thành công')
							t.addClass('liked');
						}
						$('.number-liker').html(current_liker);
					}
				}
			);
			
			return false;
		}
	);
	
	// Rating
	var widget = $('.rate_widget');
//	set_votes(widget);		

	$('.user-rating').hover(
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

	// This actually records the vote
	$('.user-rating').bind('click', function() {
		
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
					$('.ratings_stars').unbind('hover').unbind('click');
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
						//window.parent.SqueezeBox.close();
						window.parent.location.reload();
					}
				}
			);
	});
	
	// check button upload 
	$('#btn-add-image').click(function(){
		if (USER_GUEST === 'y' )
		{
			show_error();
			return false;
		}
	});
	
	function show_error()
	{
		var error = $('.error-msg');
		if (!error.is(":visible"))
		{
			error.fadeIn('slow').html('Bạn chưa đăng nhập!');
			setTimeout(function(){ error.html('').fadeToggle('slow'); }, 3000);
		}
	}
	
	$('button.show-image').click(function(){
		$(this).addClass('show-image-focus');
		
//		$('#show-album').css('display', 'block');
//		$('#show-map').css('display', 'none');

		$('#show-album').css('visibility', 'visible');
		$('#show-map').css('visibility', 'hidden');
		$('#show-map-direction').css('visibility', 'hidden');
		
		$('div.galleria-thumbnails-container').css('display', 'block');
		
		$('button.show-map').removeClass('show-map-focus');
		$('button.show-map-direction').removeClass('show-map-direction-focus');
	});

	$('button.show-map').click(function(){
		$(this).addClass('show-map-focus');
		
		$('#show-album').css('visibility', 'hidden');
		$('#show-map').css('visibility', 'visible');
		$('#show-map-direction').css('visibility', 'hidden');
		
		$('div.galleria-thumbnails-container').css('display', 'none');
		
		$('button.show-image').removeClass('show-image-focus');
		$('button.show-map-direction').removeClass('show-map-direction-focus');
	});
	
	// gmap direction
	
	// assign val for #from
	getCurrentLocation(event, 'from');
		
	// set val for #to
	$('#to').val(GMAP_ADD);
	
	
	$('button.show-map-direction').click(function(event){
		$(this).addClass('show-map-direction-focus');
		
		$('#show-album').css('visibility', 'hidden');
		$('#show-map').css('visibility', 'hidden');
		$('#show-map-direction').css('visibility', 'visible');
		
		$('div.galleria-thumbnails-container').css('display', 'none');
		
		$('button.show-image').removeClass('show-image-focus');
		$('button.show-map').removeClass('show-map-focus');
		
		// calculate map
		calculateRoute($("#from").val(), $("#to").val());
		
	});

	// LOAD MAP
	jQuery('#show-map').css({'height':'400', 'width':'628'});

	if (typeof GMAP_LAT !== 'undefined')
	{
		if (typeof zoomOption === 'undefined')
			zoomOption = 17
		
		initialize(GMAP_LAT, GMAP_LONG, GMAP_ADD, 'show-map', zoomOption);
	}
	
	/* form */
	$('#jform_catid').change(function(){
		changeLoc($(this).val());
	});
	
	if (typeof ITEM_TYPE != 'undefined' && typeof EXTENSION != 'undefined')
		changeLoc($('#jform_catid').val());

	// If the browser supports the Geolocation API
    if (typeof navigator.geolocation == "undefined") {
      $("#error").text("Your browser doesn't support the Geolocation API");
      return;
    }
    
	function getCurrentLocation(event, addressId) {
		event.preventDefault();
		navigator.geolocation.getCurrentPosition(function(position) {
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				"location" : new google.maps.LatLng(
						position.coords.latitude,
						position.coords.longitude)
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK)
					$("#" + addressId)
							.val(results[0].formatted_address);
				else
					$("#error").append(
							"Unable to retrieve your address<br />");
			});
		}, function(positionError) {
			$("#error").append(
					"Error: " + positionError.message + "<br />");
		}, {
			enableHighAccuracy : true,
			timeout : 10 * 1000
		// 10 seconds
		});
	};
		
});

function calculateRoute(from, to) {
    // Center initialized to Naples, Italy
    var myOptions = {
      zoom: 12,
      scrollwheel: false,
      //center: new google.maps.LatLng(40.84, 14.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // Draw the map
    var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);
    var directionsService = new google.maps.DirectionsService();
    var directionsRequest = {
      origin: from,
      destination: to,
      travelMode: google.maps.DirectionsTravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC
    };
    directionsService.route(
      directionsRequest,
      function(response, status)
      {
        if (status == google.maps.DirectionsStatus.OK)
        {
          new google.maps.DirectionsRenderer({
            map: mapObject,
            directions: response
          });
        }
        else
          jQuery("#error").append("Unable to retrieve your route<br />");
      }
    );
  }

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

function initialize(gmaps_latitude, gmaps_longitude, address_title, map_canvas, zoomOption) 
{
	var mapOptions = {
		center: new google.maps.LatLng(gmaps_latitude, gmaps_longitude),
		zoom: zoomOption,
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

function changeLoc($loc)
{
	jQuery('#custom-type').html('Wating ...');
	jQuery.post(
			'index.php?option=com_ntrip&task=other.changeLocation',
			{ 'location' : $loc, 'tmpl' : 'component', 'type' : ITEM_TYPE, 'item_id' : ITEM_ID, 'extension' : EXTENSION },
			function(data)
			{
				jQuery('#custom-type').html(data);
			}
		);
}