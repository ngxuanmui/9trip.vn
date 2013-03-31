<?php

class NtripControllerOther extends JController
{
	public function rating()
	{
		$itemId		= JRequest::getInt('item_id');
		$itemType	= JRequest::getString('item_type');
		preg_match('/star_([1-5]{1})/', $_POST['clicked_on'], $match);
		$rating = $match[1];
		
		$model = $this->getModel('Other', 'NtripModel');
		
		$saveResult = $model->save($itemId, $itemType, $rating);
		
		if (is_array($saveResult) && $saveResult['error'] == 1)
			echo 'Error: ' . $saveResult['msg'];
		else
			echo 'OK';
		
		exit();
	}

	function get_rating() {
		$itemID = JRequest::getInt('item_id');
		$itemType = JRequest::getString('item_type');

		$model = $this->getModel('Other', 'NtripModel');
		$votes_data =  $model->getRating($itemID, $itemType);
		if ($votes_data && $votes_data['total']) {
			echo "{$votes_data['total']}##{$votes_data['avg_star']}";
		} else {
			echo '234##4';
		}
		exit();
	}
}