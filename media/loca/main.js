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
})