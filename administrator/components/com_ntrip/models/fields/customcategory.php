<?php
/**
 * @version		$Id: customcategory.php 16825 2010-05-05 12:10:37Z louis $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Custom Category Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	com_banana_magazine
 * @since		1.6
 */
class JFormFieldCustomCategory extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'CustomCategory';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		//$arr = array('13', '12', '10', '8');
		$db = JFactory::getDbo();
		
		$form = $this->form;
		
		$moduleValue = $form->getValue('params');
		
		$itemId = JRequest::getVar('id', 0);
		
		$getValue = $this->element['get_value'] ? $this->element['get_value'] : '#__category_location, locations, category_id';
		
		$getValue = explode(',', $getValue);
		
		$query = "SELECT ".$getValue[1]." FROM ".$getValue[0]." WHERE ".$getValue[2]." = '$itemId'";
		$db->setQuery($query);
		
		$arr = $db->loadResultArray();
		
//		$tmp = $db->loadObject();
//		
//		$field = trim($getValue[1]);
//		
//		$arr = array();
		
//		if (!empty($tmp->$field))
//			$arr = json_decode($tmp->$field);
		
		$options = $this->getCategoryOptions();
		
		//echo'<pre>'; print_r($result);
		
		$str  = "";
		$str .= "<div id='jform_list_custom_category' name='jform[list_custom_category]' style='float:left; width: 290px; height:150px; overflow: auto; padding: 5px 10px 5px 5px; border: 1px solid #CCC;'>\n";
		
//		$str .= "<input type='hidden' name='input_custom_category_textbox' id='input_custom_category_textbox' class='required' />";
		
		if($moduleValue && isset($moduleValue->catid))
			$arr = $moduleValue->catid;
		
		foreach($options as $key => $option)
		{
			$optionRoot = false;
			
			if( isset($options[$key + 1]) && ($options[$key + 1]->level > $option->level) )
				$optionRoot = true;
				
			$paddingLeft = ($option->level - 1) * 20; //20 is 20px
			
			if(!$optionRoot)
			{
				
				$option->textDisplay = $option->text; # str_replace('- ', '<span class="gi">|&mdash;</span>', $option->text);
				$checked = (!empty($arr) && in_array($option->value, $arr) ) ? "checked" : null;
				
				$str .= "<div style='float:left; padding-left: ".$paddingLeft."px; line-height:22px; width: ".(280 - $paddingLeft)."px;'>
							<input class='category-checkbox' id='".$this->id."_".$option->value."' name='".$this->name."[]' $checked type='checkbox' value='".$option->value."' text='".$option->text."'> ".$option->textDisplay.
						"</div>\n";
			}
			else 
			{
				$option->textDisplay = $option->text; # str_replace('- ', '<span class="gi">|&mdash;</span>', $option->text);
				$str .= "<div style='float:left; padding-left: ".$paddingLeft."px; font-weight:bold; line-height:22px; width: 200px;'>
							[x] $option->textDisplay
						</div>\n";
			}
			
		}
		
		$str .= "</div>";
		
		return $str;
	}
	
	/**
	 * @return	string
	 * @since	1.6
	 */
	function getCategoryOptions()
	{
		// Initialise variables.
		$options	= array();
		$extension	= $this->element['extension'] ? (string) $this->element['extension'] : (string) $this->element['scope'];
		$published	= 1; #(string) $this->element['published'];

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('a.id, a.title, a.level, a.parent_id');
		$query->from('#__categories AS a');
		$query->where('a.parent_id > 0');
		$query->where('a.published = 1');

		// Filter on extension.
		$query->where('extension = '.$db->quote($extension));

		// Filter on the published state
		if (isset($config['filter.published'])) {
			if (is_numeric($config['filter.published'])) {
				$query->where('a.published = '.(int) $config['filter.published']);
			} else if (is_array($config['filter.published'])) {
				JArrayHelper::toInteger($config['filter.published']);
				$query->where('a.published IN ('.implode(',', $config['filter.published']).')');
			}
		}

		$query->order('a.lft');

		$db->setQuery($query);
		$items = $db->loadObjectList();
		
		// Get the current user object.
		$user = JFactory::getUser();
	
		
		// Assemble the list options.
		//self::$items[$hash] = array();

		foreach ($items as &$item) {
			$repeat = ( $item->level - 1 >= 0 ) ? $item->level - 1 : 0;
			//$item->title = str_repeat('- ', $repeat).$item->title;
			
			$option = new stdClass();
			$option->value = $item->id;
			$option->text = $item->title;
			$option->level = $item->level;
			$option->parent_id = $item->parent_id;
			// $options[] = JHtml::_('select.option', $item->id, $item->title);		
			$options[] = $option;	
		}
		
		# mainHelper::bug($options); die;

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
