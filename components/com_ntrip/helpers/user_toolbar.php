<?php

class Ntrip_User_Toolbar
{
	public static function buttonEdit($controller = '')
	{
		$html = array();
		
		$html[] = '<div class="user-toolbar">';
		$html[] = '<button id="btn-apply" rel="'.$controller.'.apply">Apply</button>';
		$html[] = '<button id="btn-save" rel="'.$controller.'.save">Save</button>';
		
		$id = JRequest::getInt('id');
		
		$txtButton = ($id) ? 'Close' : 'Cancel';
		
		$html[] = '<button id="btn-cancel" rel="'.$controller.'.cancel">'.$txtButton.'</button>';
		
		$html[] = '</div>';
		
		$button = implode("\n", $html);
		
		return $button;
	}
	
	public static function buttonList($controller = '')
	{
		$html = array();
		
		$html[] = '<div class="user-toolbar">';
		$html[] = '<button id="btn-add" rel="'.$controller.'.add">Add new</button>';		
		$html[] = '</div>';
		
		return implode("\n", $html);
	}
	
	public static function itemsMenu()
	{
		$html = '<ul class="items-menu">
					<li>Khách sạn</li>
					<li>Nhà hàng</li>
					<li>Giải trí</li>
					<li>Tham quan</li>
					<li>Mua sắm</li>
					<li>Dịch vụ</li>
				</ul>';
		
		return $html;
	}
}