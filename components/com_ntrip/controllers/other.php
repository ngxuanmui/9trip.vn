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

	function get_rating()
	{
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

	public function like()
	{
		$itemID = JRequest::getInt('item_id');
		$itemType = JRequest::getString('item_type');

		$model = $this->getModel('Other', 'NtripModel');
		$saveResult =  $model->saveLike($itemID, $itemType);
		if (is_array($saveResult) && $saveResult['error'] == 1)
			echo 'Error: ' . $saveResult['msg'];
		else
			echo 'OK';

		exit();
	}
	
	public function upload()
	{
		// Set the directory where files will be saved
		$upload_dir = JPATH_ROOT . DS . 'tmp' . DS . time() . DS;
		
		JFolder::create($upload_dir);
		
		$allowed_ext = array('jpg','jpeg','png','gif');

		if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
			exit_status('Error! Wrong HTTP method!');
		}

		if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){

			$pic = $_FILES['pic'];

			if(!in_array($this->get_extension($pic['name']),$allowed_ext)){
				exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
			}

			// Move the uploaded file from the temporary 
			// directory to the uploads folder:

			if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name']))
			{
				$session = JFactory::getSession();
				
//				var_dump($upload_dir, $pic['name']);
				
				$session->set('tmp_upload_dir', $upload_dir);
				$session->set('ses_upload_image', $pic['name']);
				
				$this->exit_status('File was uploaded successfuly!');
			}

		}

		$this->exit_status('Something went wrong with your upload!');
	}
	
	// Helper functions
	function exit_status($str){
		echo json_encode(array('status'=>$str));
		exit;
	}

	function get_extension($file_name){
		$ext = explode('.', $file_name);
		$ext = array_pop($ext);
		return strtolower($ext);
	}
	
	public function save_image()
	{
		$model = $this->getModel('Other', 'NtripModel');
		
		$itemID		= JRequest::getInt('item_id');
		$itemType	= JRequest::getString('item_type');
		$desc		= JRequest::getString('desc');
		
		$session = JFactory::getSession();
		$tmpDir = $session->get('tmp_upload_dir');
		$image = $session->get('ses_upload_image');
		
		$destThumb = JPATH_ROOT . DS . 'images' . DS . $itemType . DS . $itemID . DS . 'thumbnail' . DS;
		$dest = JPATH_ROOT . DS . 'images' . DS . $itemType . DS . $itemID . DS;
		
		JFolder::create($dest, 0777);
		JFolder::create($destThumb, 0777);
		
		// copy file on save
		JFile::copy($tmpDir . $image, $dest.$image);
		
		// copy thumb
		JFile::copy($tmpDir . $image, $destThumb.$image);
		
		// unset session upload image
		$session->set('ses_upload_image', null);
		$session->set('tmp_upload_dir', null);
		
//		var_dump($session->get('ses_upload_image'), $dest, $destThumb, $image);
		
		// save image
		$save = $model->saveImage($itemID, $itemType, $image, $desc);
		
		if ($save)
			echo 'OK';
		
		exit();
	}
	
	function changeLocation()
	{
		$tmp = $this->getView('Other', 'html');
		
		$model = $this->getModel('Other', 'NtripModel');
		
		$tmp->setModel($model, true);
	
		$type = JRequest::getString('type');
		$arrMultiLocation = LocaHelper::getLocationMultiType();	
	
		if (in_array($type, $arrMultiLocation))
			$tmp->display('multilocation');
		else
			$tmp->display('location');
	
			exit();
	}
}