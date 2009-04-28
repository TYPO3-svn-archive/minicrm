<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Alex Kellner <alexander.kellner@einpraegsam.net>
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

require_once(PATH_tslib . 'class.tslib_pibase.php');
require_once(t3lib_extMgm::extPath('minicrm') . 'lib/class.tx_minicrm_div.php'); // load div class
require_once(t3lib_extMgm::extPath('minicrm') . 'lib/class.tx_minicrm_dynamicmarkers.php'); // load dynamicTS class


/**
 * Plugin 'MiniCRM' for the 'minicrm' extension.
 *
 * @author	Alex Kellner <alexander.kellner@einpraegsam.net>
 * @package	TYPO3
 * @subpackage	tx_minicrm
 */
class tx_minicrm_pi1_invoice extends tslib_pibase {
	public $prefixId      = 'tx_minicrm_pi1'; // Same as class name
	public $scriptRelPath = 'pi1/class.tx_minicrm_list.php'; // Path to this script relative to the extension dir.
	public $extKey        = 'minicrm';	// The extension key.
	protected $mode = 'invoice'; // mode
	protected $content = '';
	protected $tmpl = array();
	
	
	/**
	 * List some entries
	 *
	 * @param	array		$pObj: Parent object
	 * @return	string		List html
	 */
	public function main($pObj) {
		// config
		$this->conf = $pObj->conf; // conf
		$this->cObj = $pObj->cObj; // cObj
		$this->piVars = $pObj->piVars; // piVars
		$this->pi_loadLL();
		$this->div = t3lib_div::makeInstance('tx_minicrm_div'); // Get div methods
		$this->dynTS = t3lib_div::makeInstance('tx_minicrm_dynamicmarkers'); // Get dynamic Typoscript methods
		
		// Show printview or selectorbox with projectlist
		switch ($this->piVars['print'] > 0) {
			case 1: // GET param for print was set
				$this->content .= $this->printView(); // give me the print output
				break;
				
			default: // GET param for print was not set
				$this->content .= $this->projectList(); // add selector with projects
				break;
		}
		
		if (!empty($this->content)) return $this->content; // return HTML if $content is not empty and if there are pictures
	}
	
	
	/**
	 * Generate print output
	 *
	 * @return	void
	 */
	protected function printView() {
		// config
		global $TSFE;
    	$local_cObj = $TSFE->cObj; // cObject
		$this->tmpl[$this->mode]['all'] = $this->cObj->getSubpart($this->cObj->fileResource($this->conf['template.'][$this->mode]), '###MINICRM_'.strtoupper($this->mode).'###'); // Load HTML Template
		$this->tmpl[$this->mode]['item'] = $this->cObj->getSubpart($this->tmpl[$this->mode]['all'], '###ITEM###'); // work on inner loop
		$content = $content_item = $table = ''; $this->markerArray = $this->outerMarkerArray = $this->subpartArray = array(); $overall = 0;
		
			// get address from database
		$row = $this->div->dbGetList('tt_address.*', '', 'tx_minicrm_project.uid = ' . $this->piVars['print'], '', '', 1); // get values from database
		$row[0] = $this->div->changeKeyOfArray($row[0], 'address_'); // add prefix for all keys
		$local_cObj->start($row[0], 'tt_address'); // enable .field in typoscript for tt_address
		foreach ((array) $row[0] as $key => $value) { // one loop for every field in tt_address table
			$this->outerMarkerArray['###'.strtoupper($key).'###'] = $local_cObj->cObjGetSingle($this->conf[$this->mode.'.']['field.'][$key], $this->conf[$this->mode.'.']['field.'][$key.'.']); // fill value with stdWrap
		}
			// get projectdetails from database
		$row = $this->div->dbGetList('tx_minicrm_project.*', '', 'tx_minicrm_project.uid = ' . $this->piVars['print'], '', '', 1); // get values from database
		$row[0] = $this->div->changeKeyOfArray($row[0], 'project_'); // add prefix for all keys
		$local_cObj->start($row[0], 'tx_minicrm_project'); // enable .field in typoscript for tx_minicrm_project
		foreach ((array) $row[0] as $key => $value) { // one loop for every field in tx_minicrm_project table
			$this->outerMarkerArray['###'.strtoupper($key).'###'] = $local_cObj->cObjGetSingle($this->conf[$this->mode.'.']['field.'][$key], $this->conf[$this->mode.'.']['field.'][$key.'.']); // fill value with stdWrap
		}
			// get products from database
		$rowset = $this->div->dbGetList('tx_minicrm_products.*', '', 'tx_minicrm_project.uid = ' . $this->piVars['print'], '', '', ''); // get values from database
		foreach ((array) $rowset as $tmp_key => $tmp_value) { // one loop for every product
			$rowset[$tmp_key] = array_merge((array) $rowset[$tmp_key], array('pricesum' => ($tmp_value['amount'] * $tmp_value['price']))); // add values to array
			$rowset[$tmp_key] = $this->div->changeKeyOfArray($rowset[$tmp_key], 'product_'); // add prefix for all keys
			$local_cObj->start($rowset[$tmp_key], 'tx_minicrm_products'); // enable .field in typoscript for tx_minicrm_products
			foreach ($rowset[$tmp_key] as $key => $value) { // one loop for every field in tx_minicrm_products table
				$this->markerArray['###'.strtoupper($key).'###'] = $local_cObj->cObjGetSingle($this->conf[$this->mode.'.']['field.'][$key], $this->conf[$this->mode.'.']['field.'][$key.'.']); // fill value with stdWrap
			}
			$overall += $rowset[$tmp_key]['product_pricesum'];
			
			$content_item .= $this->cObj->substituteMarkerArrayCached($this->tmpl[$this->mode]['item'], $this->markerArray); // add html code
		}
		$this->subpartArray['###CONTENT###'] = $content_item; // get content of inner loop
			// overallprice with stdWrap
		$local_cObj->start(array('overall' => $overall), 'tx_minicrm_project'); // enable .field in typoscript for overall
		$this->outerMarkerArray['###OVERALL###'] = $local_cObj->cObjGetSingle($this->conf[$this->mode.'.']['field.']['overall'], $this->conf[$this->mode.'.']['field.']['overall.']); // fill value with stdWrap
		
			// give something back
		$content = $this->cObj->substituteMarkerArrayCached($this->tmpl[$this->mode]['all'], $this->outerMarkerArray, $this->subpartArray); // Get html template
		$content = $this->dynTS->main($content, $this); // Fill dynamic locallang or typoscript markers
		$content = preg_replace('|###.*?###|i', '', $content); // Finally clear not filled markers
		return $content;
	}
	
	
	/**
	 * Generate selector with all projects
	 *
	 * @return	string		select html
	 */
	protected function projectList() {
		// config
		$this->tmpl[$this->mode.'select']['all'] = $this->cObj->getSubpart($this->cObj->fileResource($this->conf['template.'][$this->mode]), '###MINICRM_'.strtoupper($this->mode.'select').'###'); // Load HTML Template
		$this->tmpl[$this->mode.'select']['item'] = $this->cObj->getSubpart($this->tmpl[$this->mode.'select']['all'], '###ITEM###'); // get subpart
		$content = $content_item = ''; $markerArray = $subpartArray = $outerMarkerArray = array();
		
		// let's go
			// Inner Loop
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery ( // Get all projects
			'tx_minicrm_project.title, tx_minicrm_project.uid, tx_minicrm_project.invoiceno', // select
			'tx_minicrm_project', // from table
			'1' . $this->cObj->enableFields('tx_minicrm_project'), // where clause
			$groupby = '',
			$orderby = 'tx_minicrm_project.invoicedate DESC',
			$limit = 10000
		);
		if ($res) { // If there is a result
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) { // One loop for every entry
				foreach ((array) $row as $key => $value) { // one loop for every field of $row
					$markerArray['###'.strtoupper($key).'###'] = $value; // generate marker
				}
				
				$content_item .= $this->cObj->substituteMarkerArrayCached($this->tmpl[$this->mode.'select']['item'], $markerArray); // add html code
			}
		}
		$subpartArray['###CONTENT###'] = $content_item; // get content of inner loop
		
			// Out of the loop
		$outerMarkerArray['###TARGET###'] = $this->cObj->typolink('x', array('returnLast' => 'url', 'parameter' => $GLOBALS['TSFE']->id, 'useCacheHash' => 0)); // get URL to the same page
		
			// give something back
		$content = $this->cObj->substituteMarkerArrayCached($this->tmpl[$this->mode.'select']['all'], $outerMarkerArray, $subpartArray); // Get html template
		$content = $this->dynTS->main($content, $this); // Fill dynamic locallang or typoscript markers
		$content = preg_replace('|###.*?###|i', '', $content); // Finally clear not filled markers
		return $content;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/pi1/class.tx_minicrm_invoice.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/pi1/class.tx_minicrm_invoice.php']);
}

?>