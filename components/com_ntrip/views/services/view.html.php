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
class NtripViewServices extends JViewLegacy
{
	protected $items;
	protected $fields;
	protected $pagination;
	protected $category;

	function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->fields = $this->get('CustomField');
		$this->pagination = $this->get('Pagination');
		$this->category = $this->get('Category');
		
		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		
	}
}
