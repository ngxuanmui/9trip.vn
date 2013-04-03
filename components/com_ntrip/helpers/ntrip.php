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
	
	public static function customFieldMenu($fields, $field, $type = 'discovers')
	{
		$html  = '<ul class="tab-categories">';
		
		$idx = 0;
		
		foreach ($fields as $itemMenu)
		{
			$classMenu = ($idx % 2 == 0) ? '' : 'even';
			$classActive = ($field == $itemMenu->id) ? ' active' : '';
			
			$link = JRoute::_('index.php?option=com_ntrip&view='.$type.'&custom_field=' . $itemMenu->id);
			
			if (JRequest::getInt('id', 0))
				$link .= '&id=' . JRequest::getInt ('id', 0);
			
			$link .= '&Itemid=' . JRequest::getInt('Itemid', 0);
			
			$html .= '<li class="' . $classMenu . $classActive . '">
						<a href="'.$link.'">'
							. $itemMenu->title .
						'</a>
					</li>';
			
			$idx ++;
		}
		
		$html .= '</ul>';
		
		return $html;
	}
}