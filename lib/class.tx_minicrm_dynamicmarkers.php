<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Alexander Kellner <alexander.kellner@einpraegsam.net>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once(PATH_tslib.'class.tslib_pibase.php');

class tx_minicrm_dynamicmarkers extends tslib_pibase {

	public $extKey = 'minicrm'; // Extension key
	public $prefixId = 'tx_minicrm_pi1'; // Same as class name
	public $scriptRelPath = 'pi1/class.tx_minicrm_pi1.php'; // Path to any script in pi1 for locallang
    protected $locallangmarker_prefix = array('MINICRM_LL_','minicrm_ll_'); // prefix for automatic locallangmarker
    protected $typoscriptmarker_prefix = array('MINICRM_TS_','minicrm_ts_'); // prefix for automatic typoscriptmarker
    
	
	/**
	 * Replacing all typoscript and all locallangmarkers in a string
	 *
	 * @param	array		$pObj: Parent object
	 * @return	string		given content with replaced markers
	 */
	public function main($content, $pObj) {
		// config
		$this->conf = $pObj->conf; // conf
		$this->cObj = $pObj->cObj; // cObj
		$this->piVars = $pObj->piVars; // piVars
		$this->content = $content;
		$this->pi_loadLL();
		
		// let's go
		// 1. replace locallang markers
		$this->content = preg_replace_callback ( // Automaticly fill locallangmarkers with fitting value of locallang.xml
			'#\#\#\#'.$this->locallangmarker_prefix[0].'(.*)\#\#\##Uis', // regulare expression
			array($this, 'dynamicLocalLangMarker'), // open function
			$this->content // current content
		);
		
		// 2. replace typoscript markers
		$this->content = preg_replace_callback ( // Automaticly fill locallangmarkers with fitting value of locallang.xml
			'#\#\#\#'.$this->typoscriptmarker_prefix[0].'(.*)\#\#\##Uis', // regulare expression
			array($this, 'dynamicTyposcriptMarker'), // open function
			$this->content // current content
		);
		
		if (!empty($this->content)) return $this->content;
	}
    
    
    /**
	 * Get automaticly a marker from locallang.xml (###LOCALLANG_BLABLA### from locallang.xml: locallangmarker_blabla)
	 *
	 * @param	array		$pObj: Parent object
	 * @return	string		given content with replaced markers
	 */
    protected function dynamicLocalLangMarker($array) {
		if (!empty($array[1])) $string = $this->pi_getLL(strtolower($this->locallangmarker_prefix[1].$array[1]), '<i>'.strtolower($array[1]).'</i>'); // search for a fitting entry in locallang.xml or typoscript
        
		if (!empty($string)) return $string;
    }
    
    
    /**
	 * Get automaticly a marker from typoscript 
	 *
	 * @param	array		$pObj: Parent object
	 * @return	string		given content with replaced markers
	 */
    protected function dynamicTyposcriptMarker($array) {
		if ($this->conf['dynamicTyposcript.'][strtolower($array[1])]) { // If there is a fitting entry in typoscript
			$string = $this->cObj->cObjGetSingle($this->conf[$this->typoscriptmarker_prefix[1].'.'][strtolower($array[1])], $this->conf[$this->typoscriptmarker_prefix[1].'.'][strtolower($array[1]).'.']); // fill string with typoscript value
		}
        
		if (!empty($string)) return $string;
    }
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/lib/class.tx_minicrm_dynamicmarkers.php']) {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/lib/class.tx_minicrm_dynamicmarkers.php']);
}

?>