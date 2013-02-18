<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.5
 */
class NtripViewOther extends JViewLegacy
{
	protected $locations;
	protected $item;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->locations	= $this->get('Locations');
		$this->item			= $this->get('Item');
		parent::display($tpl);
	}
}
