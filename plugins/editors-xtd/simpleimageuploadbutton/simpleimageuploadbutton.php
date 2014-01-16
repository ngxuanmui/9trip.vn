<?php
/**
 * @version		1.0
 * @package		pkg_simpleimageuploadplugin
 * @copyright		Copyright 2012 http://tuts4you.de/ All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Editor SimpleImageUploadPlugin
 *
 * @package pkg_simpleimageuploadplugin
 */
class plgButtonSimpleImageUploadButton extends JPlugin
{

	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * Display the button
	 *
	 *
	 */
	public function onDisplay($name)
	{
		$link = 'index.php?option=com_simpleimageupload&view=upload&tmpl=component&e_name=' .$name;
		JHtml::_('behavior.modal');
		$button = new JObject;
		$button->set('modal', true);
		$button->set('link', $link);
		$button->set('text', JText::_('PLG_SIMPLEIMAGEUPLOAD_BUTTON'));
		$button->set('name', 'image');
		$button->set('options', "{handler: 'iframe', size: {x: 350, y: 400}}");
		return $button;
	}
}