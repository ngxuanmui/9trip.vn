<?php

class NtripControllerOther extends JController
{
	function changeLocation()
	{
		$tmp = $this->getView('Other', 'html');
		
		$model = $this->getModel('Other', 'NtripModel');
		
		$type = JRequest::getString('type');
		$arrMultiLocation = LocaHelper::getLocationMultiType();
		
//		$locations = $model->getLocations();
//		
//		$tmp->assignRef('locations', $locations);
		
		$tmp->setModel($model, true);
		
		if (in_array($type, $arrMultiLocation))
			$tmp->display('multilocation');
		else
			$tmp->display('location');
		
		exit();
	}
}