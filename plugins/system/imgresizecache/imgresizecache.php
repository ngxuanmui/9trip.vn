<?php
/**
 * @copyright   Copyright (C) 2013 S2 Software di Stefano Storti. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/plugins/system/imgresizecache/resize.php';

class plgSystemImgresizecache extends JPlugin
{
	protected $_resizer;
	protected $_arrViews = array('discover');
	
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
		
		// New image resizer
		$this->_resizer = new ImgResizeCache();
	}
	
	/**
	 * @param string The context of the content being passed to the plugin.
	 * @param object The article object. Note $article->text is also available
	 * @param object The article params
	 * @param integer The 'page' number
	 */
	public function onAfterRender()
	{
		if ($this->app->isAdmin())
			return true;
		
		$buffer = JResponse::getBody();
		
		$img_size = $this->params->get('img_size', '');
		$size_definitions = $this->params->get('size_definitions', '');
		
		// images in article text
		if (!empty($buffer) && ($img_size || $size_definitions))
		{
			$opts = $this->_parseOpts($img_size);
			$arrOpts = $this->_parseSizeDefinitions($size_definitions);
			if (!empty($buffer))
				$buffer = $this->_prepareText($buffer, $opts, $arrOpts);
		}
		
		JResponse::setBody($buffer);

		return true;
	}
	
	protected function _parseOpts($str)
	{
		// eg. w=700, h=200, crop=TRUE to array('w' => 700, 'h' => 200, 'crop' => TRUE)
		$opts = array();
		
		$params = explode(',', $str);
		foreach ($params as $param)
		{
			$split = explode('=', $param);
			
			if (!empty($split[0]) && !empty($split[1]))
			{
				$opts[trim($split[0])] = trim($split[1]);
				
				// string to boolean
				if (strcmp($opts[trim($split[0])], 'TRUE') == 0) $opts[trim($split[0])] = TRUE;
				if (strcmp($opts[trim($split[0])], 'FALSE') == 0) $opts[trim($split[0])] = FALSE;
			}
		}
		
		return $opts;
	}
	
	protected function _parseSizeDefinitions($str)
	{
		// eg. img-article: w=700; img-article-cropped: w=700, h=200, crop=TRUE; to array('img-article' => <opts>, 'img-article-cropped' => <opts>)
		$arrOpts = array();
		
		$defs = explode(';', $str);
		foreach ($defs as $def)
		{
			$split = explode(':', $def);
			
			if (!empty($split[0]) && !empty($split[1]))
			{
				$arrOpts[trim($split[0])] = $this->_parseOpts(trim($split[1]));
			}
		}
		
		return $arrOpts;
	}
	
	protected function _prepareText($text, $opts, $arrOpts)
	{
		// loop all img tags
		preg_match_all('/<img [^>]*src\s*=\s*"(.*?)"[^>]*\/>/i', $text, $matches);
		for ($i = 0; $i < count($matches[0]); $i++)
		{
			$img = $matches[0][$i];
			$src = $matches[1][$i];
			
			$new_src = FALSE;
			// has extra defined class?
			$class = $this->_getDefinedClass($img, $arrOpts);
			if ($class)	// extra size definitions
			{
				$new_src = $this->_resizer->resize($src, $arrOpts[$class]);
			}
			elseif ($opts)	// default size in article text
			{
				$new_src = $this->_resizer->resize($src, $opts);
			}
			
			// has new src to replace?
			if ($new_src)
			{
				$new_img =  preg_replace('/ src\s*=\s*"(.*?)"/i', ' src="'.$new_src.'"', $img);
				
				// replace with new width and height
				list($new_width, $new_height) = @getimagesize($new_src);
				$new_img = $this->_replaceOrAddImgAttribute($new_img, 'width', $new_width);
				$new_img = $this->_replaceOrAddImgAttribute($new_img, 'height', $new_height);
				
				$text = str_replace($img, $new_img, $text);
			}
		}
		
		return $text;
	}
	
	protected function _getDefinedClass($img, $arrOpts)
	{
		if (!$arrOpts)
			return FALSE;
		
		preg_match_all('/ class\s*=\s*"(.*?)"[^>]*\/>/i', $img, $matches);
		for ($i = 0; $i < count($matches[0]); $i++)
		{
			$classes = explode(' ', $matches[1][$i]);
			foreach ($classes as $class)
			{
				$class = trim($class);
				if (array_key_exists($class, $arrOpts))
				{
					return $class;
				}
			}
		}
		
		return FALSE;
	}
	
	protected function _replaceOrAddImgAttribute($img, $attr, $new_val)
	{
		if (preg_match('/ '.$attr.'\s*=\s*"(.*?)"[^>]*\/>/i', $img) > 0)
		{
			$new_img = preg_replace('/ '.$attr.'\s*=\s*"(.*?)"/i', ' '.$attr.'="'.$new_val.'"', $img);
		}
		else
		{
			$new_img = preg_replace('/<img /i', '<img '.$attr.'="'.$new_val.'" ', $img);
		}
		
		return $new_img;
	}
	
	protected function _overrideK2Images($item, $opts)
	{
		$item->_image = '';
		
		// original image path
		$src = 'media/k2/items/src/'.md5("Image".$item->id).'.jpg';
		if (!file_exists($src))
			return;
		
		$resized = $this->_resizer->resize($src, $opts);
		
		$item->imageXSmall = $resized;
		$item->imageSmall = $resized;
		$item->imageMedium = $resized;
		$item->imageLarge = $resized;
		$item->imageXLarge = $resized;
		$item->imageGeneric = $resized;
		
		$item->_image = $src;	// keep original to be used in custom layouts
	}
}
