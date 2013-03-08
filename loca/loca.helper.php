<?php

class LocaHelper 
{
	/**
	 * Function to get coordinates for gmap
	 * 
	 * @param String $address	Gmap address
	 * @param String $region	Region
	 * @param Boolean $useCurl	Use CURL or Use file_get_contents
	 * 
	 * @return Array
	 */
	public function getGmapCoordinates($address, $useCurl = true, $region = 'VN')
	{
		$c = array();
		
		$address = str_replace(" ", "+", $address);
		$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region";
		
		if (!$useCurl)
		{
			$json = file_get_contents($url);			
		}
		else
		{
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			
			$json = curl_exec($ch);
			
			curl_close($ch);
		}
		
		$json = json_decode($json);
		
		if (!empty($json->{'results'}[0]))
		{
			$c['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
			$c['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		}
		else
		{
			$c['lat'] = '';
			$c['long'] = '';
		}
		
		return $c;
	}
	
	public static function renderModulesOnPosition($position) {
		jimport('joomla.application.module.helper');
		$modules = JModuleHelper::getModules($position);
		
		return self::renderModules($modules);
	}
	
	public static function renderModules($modules) {
		jimport('joomla.application.module.helper');
		$html = '';
		if ($modules && count($modules)) {
			foreach ($modules as $mod) {
				$html .= self::renderModule($mod);
			}
		}
		return $html;
	}
	
	public static function renderModule($module) 
	{
		jimport('joomla.application.module.helper');
		
		if (is_object($module) && $module->id) {
			$html[] = '<div class="widget-blocks widget-block">';
			$html[] = '	<div class="content">';
			
			if ($module->title && $module->showtitle == 1) {
				$html[] = '<h3>'.$module->title.'</h3>';
			}
			$html[] = JModuleHelper::renderModule($module);
			$html[] = '	</div>';
			$html[] = '</div>';
			
			return implode($html);
		}
		
		return '';
	}
	
	/**
	 * Function to get extension (customfield) related to location (category) 
	 */
	public static function getExtensionLocation()
	{
		$arrExt = array('com_ntrip.custom_field_hotel', 'com_ntrip.custom_field_restaurant');
		
		return $arrExt;
	}
	
	public static function getLocationMultiType()
	{
//		$arr = array('hotels');
		
		$arr = array();
		
		return $arr;
	}
}