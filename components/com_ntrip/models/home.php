<?php
defined('_JEXEC') or die;

class NtripModelHome extends JModelLegacy
{
	public function getItems()
	{
		jimport('joomla.application.categories');
		
		$categories = JCategories::getInstance('Ntrip', array('extension' => 'com_ntrip', 'table' => '#__hotels'));
		
		$allCategories = $categories->get()->getChildren();
		
		return $allCategories;
	}
}