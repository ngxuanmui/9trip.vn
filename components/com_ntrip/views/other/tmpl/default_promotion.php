<?php

$type = JRequest::getString('type');
$id = JRequest::getInt('id', 0);

switch ($type): 
	
	default: 
		echo getInput($type, $id, 'jform_hotel_id', 'jform[hotel_item]', $required = false);
		break;
endswitch;

