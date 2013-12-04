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
class SimpleImageUploadViewUpload extends JView {

    /**
     * HTML View class for the ManifestUpdate Component
     *
     * @param $tpl
     */
    public function display($tpl = null) {

	JHtml::_('behavior.framework', true);
	JHtml::_('script', 'media/popup-imagemanager.js', true, true);
	JHtml::_('stylesheet', 'media/popup-imagemanager.css', array(), true);
	$this->session = JFactory::getSession();
        parent::display($tpl);
    }
}
