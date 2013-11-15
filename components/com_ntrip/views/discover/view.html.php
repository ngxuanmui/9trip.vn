<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML View class for the Content component
 *
 * @package		Joomla.Site
 * @subpackage	com_ntrip
 * @since 1.5
 */
class NtripViewDiscover extends JViewLegacy
{
	protected $item;
	protected $otherImages;
	protected $otherItems;

	function display($tpl = null)
	{
		$this->item = $this->get('Item');
		$this->otherImages = $this->get('OtherImages');
		$this->otherItems = $this->get('OtherItems');
		
		$this->_prepareDocument();
		
		// update gmap info
		NtripFrontHelper::updateGmapInfo($this->item->id, 'discovers', $this->item->address);

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$item = $this->item;
		
		NtripFrontHelper::getMetaData($item);
		
		$app	= JFactory::getApplication();
		$pathway = $app->getPathway();
		$pathway->addItem($item->name, '');
		
		$title = $item->name;
		
		// Set title
		$this->document->setTitle($title);
	}
}
