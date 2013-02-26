jQuery.noConflict();

jQuery(function($){
	$('#jform_catid').change(function(){
		changeLoc($(this).val());
	});
	
	if (typeof ITEM_TYPE != 'undefined')
		changeLoc($('#jform_catid').val());
});

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