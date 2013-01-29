<?php

class NtripControllerUsers extends JController
{
	public function fbregistration() 
	{
		$facebook = new Facebook(array(
			'appId'  => CFG_FACEBOOK_API_ID,
		  	'secret' => CFG_FACEBOOK_API_SECRET,
		));
		
		$userFB = $facebook->getUser();
		$fbMe	= null;
		
		// CHECK LOGEDIN FB
		if ($userFB) {
			try {
		    	// Proceed knowing you have a logged in user who's authenticated.
		    	$fbMe = $facebook->api('/me');
		  	} catch (FacebookApiException $e) {
		    	$userFB = null;
		  	}
		}
		
		$logoutUrl	= '';
		$loginUrl	= '';
		
		if ($userFB) {
			$logoutUrl	= $facebook->getLogoutUrl();
		} else {
		  	$loginUrl	= $facebook->getLoginUrl(
		  		array(
		  			'scope' => 'email, publish_stream',
		  			'redirect_uri' => JURI::root() . JRoute::_('index.php?option=com_profile&task=customer.fbregistration', false)
		  		)
			);
			// TODO REQUEST LOGIN BEFORE SAVE FB ACCOUNT
			$this->setRedirect('index.php', 'Có lỗi xảy ra trong quá trình nhận chứng thực từ facebook', 'notice');
			return false;
		}
		
		// REGISTER DATA
		if ($fbMe) {
			// FIND IF EXISTED EMAIL
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('COUNT(*)')->from('#__users')->where('email = ' . $db->quote($fbMe['email']));			
			$db->setQuery($query);
			$duplicate = (bool) $db->loadResult();
			
			if (!$duplicate) {
				$user = new JUser;
				
				$data['email']		= $fbMe['email'];
				$data['username']	= $fbMe['email'];
				$data['name'] 		= $fbMe['name'];
				
				// GROUP
				$params	= JComponentHelper::getParams('com_users');
				$system	= $params->get('new_usertype', 2);
				$data['groups'] = array($system);
				
				// Bind the data.
				if (!$user->bind($data)) {
					$this->setError(JText::sprintf('COM_USERS_REGISTRATION_BIND_FAILED', $user->getError()));
					return false;
				}
		
				// Load the users plugin group.
				JPluginHelper::importPlugin('user');
		
				// Store the data.
				if (!$user->save()) {
					$this->setError(JText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $user->getError()));
					return false;
				}
				
				// CREATE PROFILE
				$profile = new stdClass();
				$profile->user_id 	= $user->get('id');
				$profile->name 		= $user->get('name');
				$profile->email 	= $user->get('email');
				$profile->country_code 	= 'vn';
				$profile->service 		= 'FB';
				
				$db->insertObject('#__customer', $profile, 'id');
			}
			
			// LOGIN VIA FB API
			$app = JFactory::getApplication();
	
			// Get the log in credentials.
			$credentials = array();
			$credentials['username'] = $fbMe['email'];
			$credentials['password'] = $fbMe['email'];
			
			// Perform the log in.
			if (true === $app->login($credentials)) {
				// Success
				$this->setRedirect(ProfileHelperRoute::getRouteView('profile'));				
				return true;
			}
		}
		
		$this->setRedirect('index.php');
		return false;
	}
}