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

require_once(t3lib_extMgm::extPath('minicrm').'lib/class.tx_minicrm_div.php'); // load div class
require_once(t3lib_extMgm::extPath('minicrm').'mod1/class.tx_minicrm_export.php'); // load export class


class tx_minicrm_list {

	public $mode = ''; // default mode
	
	public $select = ''; // default db selection
	public $from = ''; // default from clause
	public $where = '1'; // default where clause
	public $groupby = ''; // default groupby
	public $orderby = ''; // default sorting
	public $limit = 10000; // default limit
	public $title = '';
	
	
	/**
	 * Main Function for customview - shows selector
	 *
	 * @param	array	$pObj				$this from index.php
	 * @return	string	$this->content		Code for viewing
	 */
	public function main(&$pObj) {
		// config
		$this->pObj = &$pObj;
		$this->content = ''; $this->MOD_MENU = array();
		$this->div = t3lib_div::makeInstance('tx_minicrm_div'); // get div class
		$this->TSconfig = t3lib_BEfunc::getModTSconfig(0, 'miniCRM'); // get tsconfig from backend
		$this->func = htmlentities($_GET['SET']['function']); // what kind of custom view should be used
		$this->export = htmlentities($_GET['export']); // export variable
		
		// Let's go
		$row = $this->div->dbGetList($this->select, $this->from, $this->where, $this->groupby, $this->orderby, $this->limit); // get values from db
		
		if (!$this->export) {  // if we're not on the export page
			$this->content .= $this->div->BEIcons('&SET[function]='.$this->func, $pObj); // add exporticon
			$this->content .= '<p>&nbsp;</p>'; // add empty line
			$this->content .= $this->div->array2html($row, $this->pObj, $this->title, 1, 1); // generate html table from array
		} else { // export function
			$this->export = t3lib_div::makeInstance('tx_minicrm_export'); // get export class
			$this->content .= $this->export->main($this->pObj, $row, $this->title); // open export function
		}
		
		return $this->content;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/class.tx_minicrm_list.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/class.tx_minicrm_list.php']);
}

?>