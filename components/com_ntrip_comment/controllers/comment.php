<?php

class Ntrip_CommentControllerComment extends JControllerLegacy
{
	public function post()
	{
//		if (JFactory::getUser()->guest)
//		{
//			echo 'USER_NOT_LOGIN';
//			exit();
//		}
		
		$itemId		= JRequest::getInt('item_id');
		$itemType	= JRequest::getString('item_type');
		$parentId	= JRequest::getInt('parent_id');
		$content	= JRequest::getString('content');
		
		$model = $this->getModel('Comment', 'Ntrip_CommentModel');
		
		$saveResult = $model->save($itemId, $itemType, $parentId, $content);
		
		if (is_array($saveResult) && $saveResult['error'] == 1)
			echo 'Error: ' . $saveResult['msg'];
		else
			echo 'OK';
		
		exit();
	}
}