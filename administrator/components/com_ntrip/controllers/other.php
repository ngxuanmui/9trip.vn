<?php

class NtripControllerOther extends JController
{
	protected $tmp;
	
	public function __construct($config = array()) {
		parent::__construct($config);
		
		$tmp = $this->getView('Other', 'html');
		
		$model = $this->getModel('Other', 'NtripModel');
		
		$tmp->setModel($model, true);
		
		$this->tmp = $tmp;
	}
	function changeLocation()
	{
		$tmp = $this->tmp;
		
		$type = JRequest::getString('type');
		$arrMultiLocation = LocaHelper::getLocationMultiType();
		
//		$locations = $model->getLocations();
//		
//		$tmp->assignRef('locations', $locations);
		
		
		
		if (in_array($type, $arrMultiLocation))
			$tmp->display('multilocation');
		else
			$tmp->display('location');
		
		exit();
	}
	
	public function changeItemTypePromotion()
	{
		$tmp = $this->tmp;
		
		$tmp->display('promotion');
	}
}