<?php

class UploadFile 
{
    function handle()
    {
	$otherImagesDir = JPATH_ROOT . DS . 'images' . DS . 'hotels' . DS . 'other_images' . DS . $id . DS;
			
	@mkdir($otherImagesDir, 0777, true);

	$uploadOptions = array('upload_dir' => $otherImagesDir);

	$uploadHandler = new UploadHandler($uploadOptions, false);

	$files = $uploadHandler->post(false);

	var_dump($files); die;
    }
}