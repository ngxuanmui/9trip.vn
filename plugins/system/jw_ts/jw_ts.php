<?php
/**
 * @version		2.7
 * @package		Tabs & Sliders (plugin)
 * @author    JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');
if(version_compare(JVERSION, '1.6.0', 'ge')) {
	jimport('joomla.html.parameter');
}

class plgSystemJw_ts extends JPlugin {

	// JoomlaWorks reference parameters
	var $plg_name								= "jw_ts";
	var $plg_copyrights_start		= "\n\n<!-- \"Tabs & Sliders\" Plugin start -->\n";
	var $plg_copyrights_end			= "\n<!-- \"Tabs & Sliders\" Plugin (v2.7) end -->\n\n";

	function __construct(&$subject, $params ){
		parent::__construct( $subject, $params );
	}

	// The main function
	public function onAfterDispatch()
	{
		$row = new stdClass();
		
		// Adjust the component buffer.
		$doc = JFactory::getDocument();
		$buf = $doc->getBuffer('component');
		
		// API
		$mainframe= &JFactory::getApplication();
		$document = &JFactory::getDocument();

		// Assign paths
		$sitePath = JPATH_SITE;
		$siteUrl  = JURI::root(true);

		if(version_compare(JVERSION,'1.6.0','ge')) {
			$pluginLivePath = JURI::root(true).'/plugins/system/'.$this->plg_name.'/'.$this->plg_name;
		} else {
			$pluginLivePath = JURI::root(true).'/plugins/system/'.$this->plg_name;
		}

		// Simple performance checks to determine whether plugin should process further
		if(!preg_match("#{tab=.+?}|{slide=.+?}|{slider=.+?}#s", $buf)) return;

		// Check if plugin is enabled
// 		if(JPluginHelper::isEnabled('content',$this->plg_name)==false) return;

		if (JFactory::getApplication()->isAdmin())
			return false;

		// Load the plugin language file the proper way
// 		JPlugin::loadLanguage('plg_content_'.$this->plg_name, JPATH_ADMINISTRATOR);

		// Includes
		require_once(dirname(__FILE__).DS.$this->plg_name.DS.'includes'.DS.'helper.php');

		// ----------------------------------- Get plugin parameters -----------------------------------

		$plugin =& JPluginHelper::getPlugin('system',$this->plg_name);
		$pluginParams = new JParameter( $plugin->params );

		// Parameters
		$template = $pluginParams->get('template','Default');
		$tabContentHeight = $pluginParams->get('tabContentHeight',0);

		// ----------------------------------- Render the output -----------------------------------

		// Variable cleanups for K2
		if(JRequest::getCmd('format')=='raw'){
			$this->plg_copyrights_start = '';
			$this->plg_copyrights_end = '';
		}

		// Get the current template layout folder
		$pluginTemplateFolder = JWTSHelper::getTemplatePath($this->plg_name,$template);

		// Append head includes only when the document is in HTML mode
		if(JRequest::getCmd('format')=='html' || JRequest::getCmd('format')==''){

			// Select the right template layout folder
			$pluginTemplateFolderURL = $pluginTemplateFolder->http;

			// JS
			if(version_compare(JVERSION,'1.6.0','ge')) {
				JHtml::_('behavior.framework',true);
			} else {
				JHTML::_('behavior.mootools');
			}
			$document->addScript($pluginLivePath.'/includes/js/behaviour.min.js');

			// CSS
			$document->addStyleSheet($pluginTemplateFolderURL.'/css/template.css');

			if($tabContentHeight){
				$document->addStyleDeclaration('.jwts_tabberlive .jwts_tabbertab {height:'.$tabContentHeight.'px!important;overflow:auto!important;}');
			}

		}

		// --- Tabs ---
		if(JRequest::getCmd('format')!='pdf' || !JRequest::getCmd('print')){
			$b=1;
			unset($tabs);
			if(preg_match_all("/{tab=.+?}{tab=.+?}|{tab=.+?}|{\/tabs}/", $buf, $matches, PREG_PATTERN_ORDER) > 0) {
				foreach($matches[0] as $match) {
					if($b==1 && $match!="{/tabs}") {
						$tabs[] = 1;
						$b=2;
					} elseif($match=="{/tabs}"){
						$tabs[]=3;
						$b=1;
					} elseif(preg_match("/{tab=.+?}{tab=.+?}/", $match)){
						$tabs[]=2;
						$tabs[]=1;
						$b=2;
					} else {
						$tabs[]=2;
					}
				}
			}
			@reset($tabs);
			$tabscount = 0;
			if(preg_match_all("/{tab=.+?}|{\/tabs}/", $buf, $matches, PREG_PATTERN_ORDER) > 0) {
				$tabid=1;
				foreach($matches[0] as $match) {
					if($tabs[$tabscount]==1) {
						$match = str_replace("{tab=", "", $match);
						$match = str_replace("}", "", $match);
						$buf = str_replace("{tab=".$match."}", $this->plg_copyrights_start.'<div class="jwts_tabber" id="jwts_tab'.$tabid.'"><div class="jwts_tabbertab" title="'.$match.'"><h2 class="jwts_heading"><a href="#" title="'.$match.'">'.$match.'</a></h2>', $buf);
						$tabid++;
					} elseif($tabs[$tabscount]==2) {
						$match = str_replace("{tab=", "", $match);
						$match = str_replace("}", "", $match);
						$buf = str_replace("{tab=".$match."}", '</div><div class="jwts_tabbertab" title="'.$match.'"><h2 class="jwts_heading"><a href="#" title="'.$match.'">'.$match.'</a></h2>', $buf);
					} elseif($tabs[$tabscount]==3) {
						$buf = str_replace("{/tabs}", '</div></div><div class="jwts_clr"></div>'.$this->plg_copyrights_end, $buf);
					}
					$tabscount++;
				}
			}
		} else {
			if(preg_match_all("/{tab=.+?}/", $buf, $matches, PREG_PATTERN_ORDER) > 0) {
				foreach($matches[0] as $match) {
					$match = str_replace("{tab=", "", $match);
					$match = str_replace("}", "", $match);
					$buf = str_replace("{tab=".$match."}", '<h3>'.$match.'</h3>', $buf);
					$buf = str_replace("{/tabs}", '', $buf);
				}
			}
		}



		// --- Sliders ---
		$pluginTemplateFolderSystem = $pluginTemplateFolder->folder;

		// Fetch the template
		ob_start();
		include($pluginTemplateFolderSystem.DS.'sliders.php');
		$getSlidersTemplate = $this->plg_copyrights_start.ob_get_contents().$this->plg_copyrights_end;
		ob_end_clean();
		
// 		preg_match_all("#{/slider}(.+?){slider=#s", $buf, $matches, PREG_PATTERN_ORDER);
		
// 		var_dump($matches); die;

		// Cleanup inbetween markup
		if(preg_match_all("#{/slide}(.+?){slide=#s", $buf, $matches, PREG_PATTERN_ORDER) > 0) {
			foreach($matches[1] as $match) {
				if(strlen($match)<9){
					$buf = str_replace($match,'',$buf);
				}
			}
		}
		if(preg_match_all("#{/slider}(.+?){slider=#s", $buf, $matches, PREG_PATTERN_ORDER) > 0) {
			foreach($matches[1] as $match) {
				if(strlen($match)<9){
					$buf = str_replace($match,'',$buf);
				}
			}
		}

		// Do the replacement
		$oldRegex = "#{slide=(.+?)}(.+?){/slide}#s";
		$newRegex = "#{slider=(.+?)}(.+?){/slider}#s";

		if((JRequest::getCmd('format')=='html' || JRequest::getCmd('format')=='') && !JRequest::getCmd('print')){
			if(preg_match("#{slide=.+?}#s", $buf)){
				$buf = preg_replace($oldRegex, str_replace(array("{SLIDER_TITLE}","{SLIDER_CONTENT}"),array("$1","$2"),$getSlidersTemplate), $buf);
			}
			if(preg_match("#{slider=.+?}#s", $buf)){
				$buf = preg_replace($newRegex, str_replace(array("{SLIDER_TITLE}","{SLIDER_CONTENT}"),array("$1","$2"),$getSlidersTemplate), $buf);
			}
		} else {
			if(preg_match("#{slide=.+?}#s", $buf)){
				$buf = preg_replace($oldRegex,"<h3>$1</h3>$2",$buf);
			}
			if(preg_match("#{slider=.+?}#s", $buf)){
				$buf = preg_replace($newRegex,"<h3>$1</h3>$2",$buf);
			}
		}
		
		$doc->setBuffer($buf, 'component');

	}	// End function

} // End class
