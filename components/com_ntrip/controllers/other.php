<?php

class NtripControllerOther extends JController
{
	public function rating()
	{
		$itemId		= JRequest::getInt('item_id');
		$itemType	= JRequest::getString('item_type');
		$rating		= JRequest::getInt('rating');
		
		$model = $this->getModel('Other', 'NtripModel');
		
		$saveResult = $model->save($itemId, $itemType, $rating);
		
		if (is_array($saveResult) && $saveResult['error'] == 1)
			echo 'Error: ' . $saveResult['msg'];
		else
			echo 'OK';
		
		exit();
	}
}