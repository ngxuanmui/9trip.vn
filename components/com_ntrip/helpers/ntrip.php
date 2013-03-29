<?php

class NtripFrontHelper 
{
	public static function itemsMenu($itemType)
	{
		$arr = array(
						'hotels'		=> 'Khách sạn'	, 
						'restaurants'	=> 'Nhà hàng'	, 
						'relaxes'		=> 'Giải trí'	, 
						'tours'			=> 'Tham quan'	, 
						'shoppings'		=> 'Mua sắm'	, 
						'services'		=> 'Dịch vụ'
				);
		
		$html  = '<ul class="tab-categories">';
		
		$idx = 0;
		
		foreach ($arr as $itemKey => $itemMenu)
		{
			$classMenu = ($idx % 2 == 0) ? '' : 'even';
			$classActive = ($itemType == $itemKey) ? ' active' : '';
				
			$html .= '<li class="' . $classMenu . $classActive . '">'.$itemMenu.'</li>';
			
			$idx ++;
		}
		
		$html .= '</ul>';
		
		return $html;
	}
}