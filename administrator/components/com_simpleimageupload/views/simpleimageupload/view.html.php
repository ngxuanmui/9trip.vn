<?php

/**
 * @version    1.0
 * @package    SimpleImageUpload
 * @subpackage Views
 * @author     Mathias Hortig {@link http://tuts4you.de/}
 * @license    GNU/GPL
 */
//-- No direct access
defined('_JEXEC') or die('=;)');

//-- Import the Joomla! view library
jimport('joomla.application.component.view');

/**
 *
 *
 * @package ManifestUpdate
 */
class SimpleImageUploadViewSimpleImageUpload extends JView {

    /**
     * HTML View class for the ManifestUpdate Component
     *
     * @param $tpl
     */
    public function display($tpl = null) {
	JToolBarHelper::preferences('com_simpleimageupload');
	
	JToolBarHelper::title(JText::_('Simple Upload'), 'install.png');
	
	JHtml::_('behavior.modal');
        parent::display($tpl);
	echo JHtml::_('behavior.keepalive');
    }
}
