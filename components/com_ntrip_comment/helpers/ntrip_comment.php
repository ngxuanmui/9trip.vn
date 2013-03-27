<?php

class Ntrip_CommentHelper 
{
	public function __construct()
	{
		
	}

	public static function showForm($itemId, $itemType)
	{
		JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_ntrip_comment/models', 'Ntrip_CommentModel');
		
		$model = JModel::getInstance('Comment', 'Ntrip_CommentModel');
		$listComments = $model->getListComments($itemId, $itemType);
		
//		var_dump($listComments); die;
		
		include_once JPATH_ROOT . DS . 'components/com_ntrip_comment/views/forms/comment.php';
	}
}