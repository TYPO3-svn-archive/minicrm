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


/**
 * Plugin 'MiniCRM' for the 'minicrm' extension.
 *
 * @author	Alex Kellner <alexander.kellner@einpraegsam.net>
 * @package	TYPO3
 * @subpackage	tx_minicrm
 */
class tx_minicrm_pi1_list extends tslib_pibase {
	public $prefixId      = 'tx_minicrm_pi1'; // Same as class name
	public $scriptRelPath = 'pi1/class.tx_minicrm_list.php'; // Path to this script relative to the extension dir.
	public $extKey        = 'minicrm';	// The extension key.
	
	protected $mode1 = 'list'; // mode
	public $mode2 = ''; // set mode from outside
	public $select = '
		tx_minicrm_account.uid _auid, 
		tx_minicrm_account.title, 
		tx_minicrm_notes.quality, 
		tt_address.www, 
		tt_address.email, 
		tx_minicrm_project.title projecttitle, 
		count(distinct(tx_minicrm_project.uid)), 
		if (sum(tx_minicrm_products.amount * tx_minicrm_products.price) > 0, sum(tx_minicrm_products.amount * tx_minicrm_products.price), 0)
	'; // change selection
	public $groupby = 'tx_minicrm_account.uid';
	public $orderby = 'tx_minicrm_account.title ASC';
	
	protected $content = '';
	protected $conten_titem = '';
	protected $markerArray = array();
	protected $subpartArray = array();
	protected $outerMarkerArray = array();
	protected $template = array();
	
	
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
		$this->tmpl[$this->mode1]['all'] = $this->cObj->getSubpart($this->cObj->fileResource($this->conf['template.'][$this->mode1]), '###MINICRM_'.strtoupper($this->mode1).'###'); // Load HTML Template
		$this->tmpl[$this->mode1]['item'] = $this->cObj->getSubpart($this->tmpl[$this->mode1]['all'], '###ITEM###'); // work on subpart 2
		
		// let's go
		$rowpack = $this->div->dbGetList($this->select, '', 1, $this->groupby, $this->orderby); // get values from db
		#foreach ((array) $rowpack as $row) { // one loop for every dataset
			#t3lib_div::debug($row);
			$this->markerArray['###NOTE###'] = 'ATTENTION: This view is in a very early alpha status!';
			$this->markerArray['###ALL###'] = $this->div->array2html($rowpack, $tmp = array(), '', 0);
			
			$this->content_item .= $this->cObj->substituteMarkerArrayCached($this->tmpl[$this->mode1]['item'], $this->markerArray);
		#}
		$this->subpartArray['###CONTENT###'] = $this->content_item; // get content of inner loop
		
		$this->content = $this->cObj->substituteMarkerArrayCached($this->tmpl[$this->mode1]['all'], $this->outerMarkerArray, $this->subpartArray); // Get html template
		#$this->content = $this->dynamicMarkers->main($this->conf, $this->cObj, $this->content); // Fill dynamic locallang or typoscript markers
		$this->content = preg_replace('|###.*?###|i', '', $this->content); // Finally clear not filled markers
		if (!empty($this->content)) return $this->content; // return HTML if $content is not empty and if there are pictures
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/pi1/class.tx_minicrm_list.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/pi1/class.tx_minicrm_list.php']);
}

?>