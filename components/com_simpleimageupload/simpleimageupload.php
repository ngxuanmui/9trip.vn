<?php
/**
 * @version SVN: $Id$
 * @package    SimpleImageUpload
 * @subpackage com_simpleimageupload
 * @author     Mathias Hortig {@link http://tuts4you.de/}
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by ManifestUpdate
$controller = JController::getInstance('SimpleImageUpload');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
