<?php
/**
 * @version    1.0
 * @package    SimpleImageUpload
 * @subpackage Base
 * @author     Mathias Hortig {@link http://tuts4you.de/}
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

// import Joomla controller library
jimport('joomla.application.component.controller');


class SimpleImageUploadController extends JController
{
	public function display()
	{
		$vName = JRequest::getCmd('view', 'simpleimageupload');
		$vLayout = JRequest::getCmd('layout', 'default');
		$mName = 'manager';

		$document = JFactory::getDocument();
		$vType		= $document->getType();

		// Get/Create the view
		$view = $this->getView($vName, $vType);

		// Get/Create the model
		if ($model = $this->getModel($mName)) {
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}

		// Set the layout
		$view->setLayout($vLayout);

		// Display the view
		$view->display();

		return $this;
	}
}