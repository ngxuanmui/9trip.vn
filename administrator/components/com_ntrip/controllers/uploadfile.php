<?php

class NtripControllerUploadFile extends JController 
{
    function handle()
    {
	// required upload handler helper
	require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'uploadhandler.php';
	
	$userId = JFactory::getUser()->id;
	$sessionId = JFactory::getSession()->getId();
	
	// make dir
	$tmpImagesDir = JPATH_ROOT . DS . 'tmp' . DS . $userId . DS . $sessionId . DS;
	$tmpUrl = JURI::root() . 'tmp/'.$userId.'/'.$sessionId.'/';
			
	@mkdir($tmpImagesDir, 0777, true);

	$uploadOptions = array('upload_dir' => $tmpImagesDir, 'upload_url' => $tmpUrl);

	$uploadHandler = new UploadHandler($uploadOptions, false);

	$files = $uploadHandler->post();

//	var_dump($files); die;
	exit();
    }
}