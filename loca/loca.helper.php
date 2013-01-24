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
}