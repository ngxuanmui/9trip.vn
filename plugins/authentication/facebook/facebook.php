<?php

/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Facebook Authentication Plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	Authentication.facebook
 * @since 1.5
 */
class plgAuthenticationFacebook extends JPlugin {
	/**
	 * This method should handle any authentication and report back to the subject
	 *
	 * @access	public
	 * @param   array	$credentials Array holding the user credentials
	 * @param	array   $options	Array of extra options
	 * @param	object	$response	Authentication response object
	 * @return	boolean
	 * @since 1.5
	 */
	function onUserAuthenticate($credentials, $options, & $response) {
		$message = '';
		$success = 0;
		
		// check if we have curl or not
		$fbMe	= null;
		
		if (function_exists('curl_init')) {
			// check if we have a username and password
			if (strlen($credentials['username'])) {
				$facebook = new Facebook(array(
					'appId'  => CFG_FACEBOOK_API_ID,
				  	'secret' => CFG_FACEBOOK_API_SECRET,
				));
				
				$userFB = $facebook->getUser();
				if ($userFB) {
					try {
				    	// Proceed knowing you have a logged in user who's authenticated.
				    	$fbMe = $facebook->api('/me');
				  	} catch (FacebookApiException $e) {
				    	$userFB = null;
				  	}
				}
			}
		} else {
			$message = 'curl isn\'t insalled';
		}
		
		$response->type = 'Facebook';
		
		if ($fbMe) {
			$response->status		= JAuthentication::STATUS_SUCCESS;
			$response->error_message = '';
			
			$response->email	= $credentials['username'];
			// reset the username to what we ended up using
			$response->username = $credentials['username'];
			$response->fullname = $fbMe['name'];
		} else {
			$response->status		= JAuthentication::STATUS_FAILURE;
			$response->error_message	= JText::sprintf('JGLOBAL_AUTH_FAILED', $message);
		}
	}
}
