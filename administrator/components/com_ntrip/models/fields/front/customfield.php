<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Bannerclient Field class for the Joomla Framework.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_ntrip
 * @since		1.6
 */
class JFormFieldFront_CustomField extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Front_CustomField';
	
	/**
	 * Method to get the field options for category
	 * Use the extension attribute in a form to specify the.specific extension for
	 * which categories should be displayed.
	 * Use the show_root attribute to specify whether to show the global category root in the list.
	 *
	 * @return  array    The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Initialise variables.
		$options = array();
		$extension = $this->element['extension'] ? (string) $this->element['extension'] : (string) $this->element['scope'];
		$published = (string) $this->element['published'];
		$name = (string) $this->element['name'];

		// Load the category options for a given extension.
		if (!empty($extension))
		{

			// Filter over published state or not depending upon if it is present.
			if ($published)
			{
				$options = JHtml::_('category.options', $extension, array('filter.published' => explode(',', $published)));
			}
			else
			{
				$options = JHtml::_('category.options', $extension);
			}

			// Verify permissions.  If the action attribute is set, then we scan the options.
			if ((string) $this->element['action'])
			{

				// Get the current user object.
				$user = JFactory::getUser();

				// For new items we want a list of categories you are allowed to create in.
				if (!$this->form->getValue($name))
				{
					foreach ($options as $i => $option) {
						// To take save or create in a category you need to have create rights for that category
						// unless the item is already in that category.
						// Unset the option if the user isn't authorised for it. In this field assets are always categories.
						if ($user->authorise('core.create', $extension . '.category.' . $option->value) != true )
						{
							unset($options[$i]);
						}
					}
				}
				// If you have an existing category id things are more complex.
				else
				{
					$categoryOld = $this->form->getValue($name);
					foreach ($options as $i => $option)
					{
						// If you are only allowed to edit in this category but not edit.state, you should not get any
						// option to change the category.
						if ($user->authorise('core.edit.state', $extension . '.category.' . $categoryOld) != true)
						{
							if ($option->value != $categoryOld)
							{
								unset($options[$i]);
							}
						}
						// However, if you can edit.state you can also move this to another category for which you have
						// create permission and you should also still be able to save in the current category.
						elseif
							(($user->authorise('core.create', $extension . '.category.' . $option->value) != true)
							&& $option->value != $categoryOld)
						{
							unset($options[$i]);
						}
					}
				}
			}

			if (isset($this->element['show_root']))
			{
				array_unshift($options, JHtml::_('select.option', '0', JText::_('JGLOBAL_ROOT')));
			}
		}
		else
		{
			JError::raiseWarning(500, JText::_('JLIB_FORM_ERROR_FIELDS_CATEGORY_ERROR_EXTENSION_EMPTY'));
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
	
	public function getInput() 
	{
		$html = '<div class="fltlft" style="line-height: 23px;">';
		
		$name = (string) $this->element['name'];
		$categoryOld = $this->form->getValue($name);
		
		$options = $this->getOptions();
		
		foreach ($options as $i => $option)
		{
			$checked = ($option->value == $categoryOld) ? 'checked="checked"' : ( ($i == 0) ? 'checked="checked"' : '' );
			$html .= '<input type="radio" name="jform['.$name.']" value="'.$option->value.'" '.$checked.' /> ';
			$html .= '<span class="fltlft" style="margin-right: 5px; line-height: 23px;">' . $option->text . '</span>';
		}
		
		if (empty($options))
		    $html .= '<strong>No type defined</strong>';
		
		$html .= '</div>';
		
		return $html;
	}
}
