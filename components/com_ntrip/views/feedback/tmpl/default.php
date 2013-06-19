<?php

?>

	<div id="feedback" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="width: 420px; display: block;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 class="acenter">Góp ý - Báo lỗi</h3>
		</div>
		<div class="modal-body">
			<div class="login-box-new">
				<script type="text/javascript">
				// <![CDATA[	
				jQuery(document).ready(function($){
				// validate signup form on keyup and submit
					var validator = $("#user-feedback-form").validate({
						rules: {
							input_email: {
								required: true,
								email: true
							},
							input_msg: {
								required: true,
							}
						},
						messages: {
							input_email: {
								required: "Hãy điền e-mail của bạn",
								email: "Sai định dạng email, ví dụ đúng: you@yourdomain.com",
							},
							input_msg: {
								required: "Bạn hãy điền góp ý của bạn",
							}
						},
						errorPlacement: function(error, element) {
							error.appendTo( element.parent());
						},
						// specifying a submitHandler prevents the default submit, good for the demo
						submitHandler: function() {

							var url = "ajax/guest_comment.php";

							var data_post = "input_msg=" + fixedEncodeURIComponent($('#input_msg').val()) + "&input_email=" + escape($('#input_email').val()) + "&urlreturn=" + escape($('#urlreturn').val());
							$.ajax({
							   beforeSend: function(){
								   $('#btn-comment').hide(0, function ()
									{
										$("#guestComment").show();
										//$("#error_comment_msg").hide();
									});
							   },
							   type: 'POST',
							   dataType: 'html',
							   url : url,
							   data: data_post,
							   success: function(msg){
								  if (msg=='error' || msg=='')	
								  {
									  $("#error_comment_msg").fadeIn('fast');
									  $('#input_msg').focus();
									   $('#guestComment').hide(0, function ()
										{
											$("#btn-comment").show();
										});
								  } else {
									  $("#error_comment_msg").fadeOut('fast');
									  $('#input_msg').val('');
									  $('#guestComment').html(msg);
									  $('#guestComment').fadeIn('fast');
									  //location.reload();
									  $("#btn-comment").show();
									  $("#guestComment").show();
								  }
							   }
							});	


							return false;
						},
						success: function(label) {
							label.remove();
						}
					});


				}); // end document.ready


							// ]]>
				</script>
				<form accept-charset="UTF-8" method="post" action="#" class="user-feedback-form" id="user-feedback-form" novalidate="novalidate">
					<div class="form-items">
						<div id="error_comment_msg" style="display:none">
								<div class="alert alert-error">Có lỗi, bạn hãy thử lại nhé.</div>
							  </div>
						<div class="form-item">
							<input type="text" placeholder="E-mail của bạn" id="input_email" name="input_email" value="" size="25" maxlength="60" class="form-text">
						</div>
						<div class="form-item">
							<textarea cols="10" rows="10" placeholder="Nội dung góp ý" id="input_msg" name="input_msg"></textarea>
						</div>
					</div>
					<div class="form-actions acenter clearfix">
						<div id="btn-comment">
						<button class="blue-btn" name="" type="submit">Góp ý <i class="arr-next"></i></button>
						</div>
						<div style="display:none;text-align:right;color:#36C;text-align:center" id="guestComment"><img src="http://www.danhgiaxe.com/images/ajax_loading_black.gif" width="16" height="16" align="absmiddle"> Đang gởi ...</div>

					</div>
				</form>
			</div>
		</div>
	</div>