<?php

class NtripControllerFeedback extends JControllerLegacy
{
	public function send()
	{
		$post = JRequest::get('post');
		$mailer = JFactory::getMailer();
		
		$config = JFactory::getConfig();
		$sender = array( 
			$config->getValue( 'config.mailfrom' ),
			$config->getValue( 'config.fromname' ) );

		$mailer->setSender($sender);
		
		$recipient = 'namnt@marnet.vn';
		
		$mailer->addRecipient($recipient);
		
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		
		$body  = '<p><strong>Noi dung</strong></p>';
		$body .= '<p>'.$post['input_msg'].'</p>';
		
		$mailer->setSubject('Y kien dong gop cua ' . $post['input_email']);		
		$mailer->setBody($body);
		
		$send = $mailer->Send();
		
		if ( $send !== true ) {
			echo '';
		} else {
			echo 'Email đã được gửi. Cảm ơn bạn đã đóng góp ý kiến';
		}
		
		exit();
	}
}