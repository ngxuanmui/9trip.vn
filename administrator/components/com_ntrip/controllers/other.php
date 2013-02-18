<?php

class NtripControllerOther extends JController
{
	function changeLocation()
	{
		$tmp = $this->getView('Other', 'html');
		
		$model = $this->getModel('Other', 'NtripModel');
		
//		$locations = $model->getLocations();
//		
//		$tmp->assignRef('locations', $locations);
		
		$tmp->setModel($model, true);
		
		$tmp->display('location');
		
		exit();
	}
}