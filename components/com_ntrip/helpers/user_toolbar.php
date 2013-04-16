<?php

class Ntrip_User_Toolbar
{
	public static function buttonEdit($controller = '')
	{
		$html = array();
		
		$html[] = '<div class="user-toolbar">';
		$html[] = '<button id="btn-apply" class="button" rel="'.$controller.'.apply">Cập nhật</button>';
		$html[] = '<button id="btn-save" class="button" rel="'.$controller.'.save">Lưu thông tin</button>';
		
		$id = JRequest::getInt('id');
		
		$txtButton = ($id) ? 'Hủy thay đổi' : 'Hủy bỏ';
		
		$html[] = '<button id="btn-cancel" class="button cancel" rel="'.$controller.'.cancel">'.$txtButton.'</button>';
		
		$html[] = '</div>';
		
		$button = implode("\n", $html);
		
		return $button;
	}
	
	public static function buttonList($controller = '')
	{
		$html = array();
		
		$html[] = '<div class="user-toolbar">';
		$html[] = '<button id="btn-add" class="button" style="margin-right: 10px;" rel="'.$controller.'.add">Thêm mới</button>';		
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