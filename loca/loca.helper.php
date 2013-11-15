<?php

class LocaHelper 
{
//	public static function thumbnail($image_path, $thumb_path, $image_name, $thumb_width)
//	{
//		$src_img = imagecreatefromjpeg("$image_path/$image_name");
//		$origw = imagesx($src_img);
//		$origh = imagesy($src_img);
//		$new_w = $thumb_width;
//		$diff = $origw / $new_w;
//		$new_h = $new_w;
//		$dst_img = imagecreate($new_w, $new_h);
//		imagecopyresized ($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, imagesx($src_img), imagesy($src_img));
//
//		imagejpeg($dst_img, "$thumb_path/$image_name", 100);
//		
//		return true;
//	}
	
	public static function mbCutWord ($string, $max_length)
	{
	    if (strlen($string) > $max_length)
	    {
	        $string = mb_substr($string, 0, $max_length);
	        $pos = strrpos($string, " ");
	        if($pos === false)
	        {
	        	return substr($string, 0, $max_length)."...";
	        }
	        return substr($string, 0, $pos)."...";
	    }else{
	    	return $string;
	    }
	}
	
	static function getCategories($extension = 'com_ntrip')
	{
		jimport( 'joomla.application.categories' );
	
		$options = array();
	
		$options['extension'] = $extension;
	
		$catObjs = JCategories::getInstance('Ntrip', $options);
	
		$categories = $catObjs->get('root')->getChildren();
	
		return $categories;
	}
	
	public static function thumbnail($image_path, $thumb_path, $image_name, $thumbnail_width = 0, $thumbnail_height = 0)
	{
		require_once(JPATH_ROOT . '/loca/phpthumb/phpthumb.class.php');
		
		// create phpThumb object
		$phpThumb = new phpThumb();

		// this is very important when using a single object to process multiple images
		$phpThumb->resetObject();

		// set data source 
		$phpThumb->setSourceFilename($image_path . DS . $image_name); 
		
		// set parameters (see "URL Parameters" in phpthumb.readme.txt)
		if ($thumbnail_width)
			$phpThumb->setParameter('w', $thumbnail_width);
		
		if ($thumbnail_height)
			$phpThumb->setParameter('h', $thumbnail_height);
		
		// set parameters
		$phpThumb->setParameter('config_output_format', 'jpeg');
		$phpThumb->setParameter('config_imagemagick_path', '/usr/local/bin/convert');
		
		// generate & output thumbnail
		$output_filename = str_replace('/', DS, $thumb_path) . DS . 't-' . $thumbnail_width . 'x' . $thumbnail_height . '-' . $image_name; # .'_'.$thumbnail_width.'.'.$phpThumb->config_output_format;
		
		$capture_raw_data = false;
		
		if ($phpThumb->GenerateThumbnail()) { 
//			$output_size_x = ImageSX($phpThumb->gdimg_output);
//			$output_size_y = ImageSY($phpThumb->gdimg_output);
//			if ($output_filename || $capture_raw_data) {
////				if ($capture_raw_data && $phpThumb->RenderOutput()) {
////					// RenderOutput renders the thumbnail data to $phpThumb->outputImageData, not to a file or the browser
////					mysql_query("INSERT INTO `table` (`thumbnail`) VALUES ('".mysql_escape_string($phpThumb->outputImageData)."') WHERE (`id` = '".$id."')");
////				} elseif ($phpThumb->RenderToFile($output_filename)) {
////					// do something on success
////					echo 'Successfully rendered:<br><img src="'.$output_filename.'">';
////				} else {
////					// do something with debug/error messages
////					echo 'Failed (size='.$thumbnail_width.'):<pre>'.implode("\n\n", $phpThumb->debugmessages).'</pre>';
////				}
//				$phpThumb->purgeTempFiles();
//			} else {
				$phpThumb->RenderToFile($output_filename);
//			}
		} else {
			// do something with debug/error messages
//			echo 'Failed (size='.$thumbnail_width.').<br>';
//			echo '<div style="background-color:#FFEEDD; font-weight: bold; padding: 10px;">'.$phpThumb->fatalerror.'</div>';
//			echo '<form><textarea rows="10" cols="60" wrap="off">'.htmlentities(implode("\n* ", $phpThumb->debugmessages)).'</textarea></form><hr>';
		}
		
		return $output_filename;
	}

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
	
	public static function renderModulesOnPosition($position, $tmpParams = array()) {
		
		jimport('joomla.application.module.helper');
		$modules = JModuleHelper::getModules($position);
		
		return self::renderModules($modules, $tmpParams);
	}
	
	public static function renderModules($modules, $tmpParams = array()) {
		jimport('joomla.application.module.helper');
		$html = '';
		if ($modules && count($modules)) {
			foreach ($modules as $mod) {
				$html .= self::renderModule($mod, $tmpParams);
			}
		}
		return $html;
	}
	
	public static function renderModule($module, $tmpParams = array()) 
	{
		jimport('joomla.application.module.helper');
		
		if (is_object($module) && $module->id) {
			
			$tempP = json_decode($module->params, true);
			
			if (is_array($tempP))
				$tempR = array_merge($tempP, $tmpParams);
			else
				$tempR = $tmpParams;
			
			$module->params = json_encode($tempR);
			
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
	
	public static function convertAlias( $str )
	{
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
	
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
	
		$str = str_replace(
				array('"', "'", '#', '!', '@', '$', '%', '^', '&', '*'),
				'',
				$str
		);
	
		return $str;
	}
}