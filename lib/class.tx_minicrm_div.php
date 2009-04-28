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

if (t3lib_extMgm::isLoaded('wt_doorman', 0)) require_once(t3lib_extMgm::extPath('wt_doorman') . 'class.tx_wtdoorman_security.php'); // load security class

class tx_minicrm_div {

	protected $extKey = 'minicrm'; // Extension key
	protected $prefixId = 'tx_minicrm_pi1'; // Same as class name
	protected $scriptRelPath = 'pi1/class.tx_minicrm_pi1.php'; // Path to any script in pi1 for locallang
	
	
	/**
	 * This is the main db select function, where the relations between the tables was defined (this function should be used for all db queries)
	 *
	 * @param	string	$select		Select part of a db selection
	 * @param	string	$from		From part of a db selection (normally could be empty - that's why I made this function)
	 * @param	string	$where		Where clause (1 per default)
	 * @param	string	$groupby	Group by a field
	 * @param	string	$orderby	Sorting output by a field
	 * @param	string	$limit		Limit for db row (10000 per default)
	 * @return	array	$row		Values from db select
	 */
	public function dbGetList($select, $from = '', $where = '1', $groupby = '', $orderby = '', $limit = '10000') {
		if (isset($select)) { // only if $select was given
			// config
			$row = $add = array();
			if (empty($where)) $where = 1;
			/*
			// This is the main Where Clause with all JOINs
			$from = '
				tx_minicrm_account 
				LEFT JOIN tx_minicrm_notes ON (tx_minicrm_account.uid = tx_minicrm_notes.parentid) 
				LEFT JOIN tx_minicrm_project ON (tx_minicrm_account.uid = tx_minicrm_project.parentid) 
				LEFT JOIN tt_address ON (tx_minicrm_account.uid = tt_address.tx_minicrm_parentid) 
				LEFT JOIN fe_users ON (tx_minicrm_account.uid = fe_users.tx_minicrm_parentid) 
				LEFT JOIN tx_minicrm_payment ON (tx_minicrm_notes.payment = tx_minicrm_payment.uid) 
				LEFT JOIN tx_minicrm_segment ON (tx_minicrm_notes.segment = tx_minicrm_segment.uid) 
				LEFT JOIN tx_minicrm_status ON (tx_minicrm_project.status = tx_minicrm_status.uid) 
				LEFT JOIN tx_minicrm_products ON (tx_minicrm_project.uid = tx_minicrm_products.parentid) 
				LEFT JOIN tx_minicrm_mails ON (tx_minicrm_project.uid = tx_minicrm_mails.parentid) 
				LEFT JOIN tx_minicrm_accounttype ON (tx_minicrm_account.accounttype = tx_minicrm_accounttype.uid) 
			';
			*/
			// Generate from
			if ($from == '') { // create from string if not set from outside
				$from = '
					tx_minicrm_account
					LEFT JOIN tx_minicrm_notes ON (tx_minicrm_account.uid = tx_minicrm_notes.parentid)
					LEFT JOIN tx_minicrm_project ON (tx_minicrm_account.uid = tx_minicrm_project.parentid)
					LEFT JOIN tt_address ON (tx_minicrm_account.uid = tt_address.tx_minicrm_parentid)
					LEFT JOIN tx_minicrm_payment ON (tx_minicrm_notes.payment = tx_minicrm_payment.uid)
					LEFT JOIN tx_minicrm_segment ON (tx_minicrm_notes.segment = tx_minicrm_segment.uid)
					LEFT JOIN tx_minicrm_status ON (tx_minicrm_project.status = tx_minicrm_status.uid)
					LEFT JOIN tx_minicrm_accounttype ON (tx_minicrm_account.accounttype = tx_minicrm_accounttype.uid)
				';
				// Add products Join if needed
				$dont1 = 'x_minicrm_products'; // eval table1
				if (strpos($select, $dont1) ==! false || strpos($where, $dont1) !== false || strpos($groupby, $dont1) !== false || strpos($orderby, $dont1) !== false) { // if there is anywhere a field needed from table $dont1
					$from .= ' ' . 'LEFT JOIN tx_minicrm_products ON (tx_minicrm_project.uid = tx_minicrm_products.parentid)'; // add JOIN
				}
				// Add mails Join if needed
				$dont2 = 'x_minicrm_mails'; // eval table1
				if (strpos($select, $dont2) ==! false || strpos($where, $dont2) !== false || strpos($groupby, $dont2) !== false || strpos($orderby, $dont2) !== false) { // if there is anywhere a field needed from table $dont1
					$from .= ' ' . 'LEFT JOIN tx_minicrm_mails ON (tx_minicrm_project.uid = tx_minicrm_mails.parentid)'; // add JOIN
				}
				// Add fe_users Join if needed
				$dont3 = 'e_users'; // eval table2
				if (strpos($select, $dont3) ==! false || strpos($where, $dont3) !== false || strpos($groupby, $dont3) !== false || strpos($orderby, $dont3) !== false) { // if there is anywhere a field needed from table $dont2
					$from .= ' ' . 'LEFT JOIN fe_users ON (tx_minicrm_account.uid = fe_users.tx_minicrm_parentid)'; // add JOIN
				}
			}
			
			// Generate where
			if (defined ('TYPO3_MODE') && TYPO3_MODE == 'BE') { // if this is needed in BE
				$where .= t3lib_BEfunc::BEenableFields('tx_minicrm_account').t3lib_BEfunc::deleteClause('tx_minicrm_account'); // show only if account exits
				$where .= t3lib_BEfunc::BEenableFields('tx_minicrm_project').t3lib_BEfunc::deleteClause('tx_minicrm_project'); // show only if project exits
			} else { // needed in FE
				global $TSFE;
				$this->cObj = $TSFE->cObj; // cObject
				$where .= $this->cObj->enableFields('tx_minicrm_account'); // show only if account exits
				$where .= $this->cObj->enableFields('tx_minicrm_project'); // show only if project exits
			}
			
			// Add mails Where if needed
			$dont1 = 'tx_minicrm_mails'; // eval table1
			if (strpos($select, $dont1) ==! false || strpos($where, $dont1) !== false || strpos($groupby, $dont1) !== false || strpos($orderby, $dont1) !== false) { // if there is anywhere a field needed from table $dont1
				if (defined ('TYPO3_MODE')) $where .= t3lib_BEfunc::BEenableFields('tx_minicrm_mails').t3lib_BEfunc::deleteClause('tx_minicrm_mails');
				else $where .= $this->cObj->enableFields('tx_minicrm_mails');
			}
			// Add fe_users Where if needed
			$dont2 = 'fe_users'; // eval table2
			if (strpos($select, $dont2) ==! false || strpos($where, $dont2) !== false || strpos($groupby, $dont2) !== false || strpos($orderby, $dont2) !== false) { // if there is anywhere a field needed from table $dont2
				if (defined ('TYPO3_MODE')) $where .= t3lib_BEfunc::BEenableFields('fe_users').t3lib_BEfunc::deleteClause('fe_users');
				else $where .= $this->cObj->enableFields('fe_users');
			}
			
			// let's go
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery ( // DB query
				$select,
				$from,
				$where,
				$groupby,
				$orderby,
				$limit
			);
			$num = $GLOBALS['TYPO3_DB']->sql_num_rows($res); // numbers of all entries
			if ($res) { // If there is a result
				while ($row_intern = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) { // One loop for every entry
					$row[] = $row_intern; // give me the current row
				}
			}
		} else die ('Error in function dbGetList: No values in $select given');
				
		if (count($row) > 0) return $row; // return $row
	}
	
	
	/**
	 * This is a helper function which wraps string with a div and gives the div a background color (status messages)
	 *
	 * @param	string	$string		Given String
	 * @param	string	$status		Could be default, success, error, note 
	 * @return	string	$string		returns wrapped string
	 */
	public function wrapMessage($string, $status = 'default') {
		switch ($status) { // switch after status
			case 'success':
				$style = 'background-color: green; color: white;';
				break;
				
			case 'note':
				$style = 'background-color: orange;';
				break;
				
			case 'error':
				$style = 'background-color: red; color: white;';
				break;
				
			case 'default':
			default:
				$style = ''; // no backgroundcolor
				break;
		}
		
		return '<div style="padding: 5px; border: 1px solid #444;'.$style.'"><strong>'.$string.'</strong></div>'; // return value
	}	
	
	
	/**
	 * changes an 2 dimensional array to a html table
	 *
	 * @param	array	$array		Array like $bla = array(array('name1', 'email1'), array('name2', 'email2'))
	 * @param	array	$pObj		$this from parent class
	 * @param	string	$titles		Titles for
	 * @param	boolean	$allover	Show allover statistic
	 * @param	boolean	$addNumber	If set, first row will be a number
	 * @param	boolean	$plain		If set, This is a table without format and links
	 * @return	string	$html		Returns html table
	 */
	public function array2html($array, &$pObj, $titles = '', $allover = 1, $addNumber = 0, $plain = 0) {
		// settings
		$html = ''; // init variable
		$i = 0; // init rowcounter
		
		// let's go
		$html .= '<table border="1" cellpadding="2" cellspacing="0">'; // open table
		if (strlen($titles) > 0) { // if title is given
			$titlearr = t3lib_div::trimExplode(',', $titles, 1); // split title at ,
			
			$html .= '<tr>'; // open row
			if ($addNumber) $html .= '<th style="font-size: 10px;">#</th>'; // add # if numbers in the first col
			for ($j=0; $j < count($titlearr); $j++) { // one loop for every title
				$html .= '<th style="font-size: 10px;">'.$titlearr[$j].'</th>'; // add every title
			}
			$html .= '</tr>'; // closing row
		}
		foreach ((array) $array as $key => $value) { // one loop for every row
			$ii = 0; // init colcounter
			$html .= '<tr' . ($this->alternate($i) ? ' style="background-color: #ddd;"' : '') . '>'; // open row
			if ($addNumber) $html .= '<td>'.($i+1).'</td>'; // add number in the first col if activated
			foreach ((array) $value as $key2 => $value2) { // one loop for every column
				if ($key2 !== '_auid') { // all fields but not _auid
					$html .= '<td>'; // open cell
					if ($array[$key]['_auid'] > 0 && $ii==0 && !$plain) $html .= '<a href="/typo3/alt_doc.php?returnUrl=db_list.php?id=' . ($pObj->confArr['storePID'] > 0 ? intval($pObj->confArr['storePID']) : '1') . '&table=&edit[tx_minicrm_account]['.$array[$key]['_auid'].']=edit">'; // add link to adit account if $key2['_auid'] was given
					$html .= ($ii==0 ? '<b>'.$value2.'</b>' : (!$plain ? $this->linker($value2) : $value2)); // value in bold or linked or plain
					if ($array[$key]['_auid'] > 0 && $ii==0 && !$plain) $html .= '</a>'; // closing linktag
					$html .= '&nbsp;</td>'; // closing cell with nonbreakingspace to get always a border even if no content
					$ii++; // increase row counter
				}
			}
			$html .= '</tr>'; // closing row
			$i++; // increase row counter
		}
		$html .= '</table>'; // closing table
		
		if ($allover) $html .= '<p>&nbsp;</p>'.$this->wrapMessage(sprintf($pObj->LANG->getLL('Xrows'), $i)); // number of rows
		
		return $html;
	}
	
	
	/**
	 * Function alternate() checks if a number is odd or even
	 *
	 * @param	integer	$int		any number
	 * @return	boolean
	 */
	public function alternate($int = 0) {
		if ($int % 2 != 0) { // odd or even
			return false; // return false
		} else { 
			return true; // return true
		}
	}
	
	
	/**
	 * Function linker() generates link (email and url) from pure text string within an email or url ('test www.test.de test' => 'test <a href="http://www.test.de">www.test.de</a> test')
	 *
	 * @param	string	$lini				any text
	 * @param	string	$rewrite			if you want to rename the url or email to "Homepage" or "Email", use this
	 * @param	string	$additionalParams	any params for link
	 * @return	string	$link
	 */
    public function linker($link, $rewrite = 0, $additinalParams = '') {
        $link = str_replace("http://www.", "www.", $link);
        $link = str_replace("www.", "http://www.", $link);
        if (!$rewrite) { // no rewrite needed
			$link = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i", "<a href=\"$1\" target=\"_blank\"$additinalParams>$1</a>", $link); // URL
        	$link = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i", "<a href=\"mailto:$1\"$additinalParams>$1</a>", $link); // Email
		} else {
			$link = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i", "<a href=\"$1\" target=\"_blank\"$additinalParams>Homepage</a>", $link); // URL
        	$link = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i", "<a href=\"mailto:$1\"$additinalParams>Email</a>", $link); // Email
		}
    
        return $link;
    }
	
	
	/**
	 * Show Icons and generate link to an anker (Export icons, etc...)
	 *
	 * @param	string	$param			any param to hold
	 * @param	object	$pObj			parent object
	 * @return	string	$content		Code for icon
	 */
	public function BEIcons($param, $pObj) {
		$content = '';
		$content .= '<a href="/typo3/alt_doc.php?returnUrl=db_list.php?id=' . ($pObj->confArr['storePID'] > 0 ? intval($pObj->confArr['storePID']) : '1') . '&edit[tx_minicrm_account][' . ($pObj->confArr['storePID'] > 0 ? intval($pObj->confArr['storePID']) : '1') . ']=new"><img src="../files/img/icon_addaccount.gif" style="float: right; margin: -16px 60px 0 0;" title="Add Account" alt="Add Account" /></a>'; // Add New Account
		$content .= '<img src="../files/img/icon_gap.gif" style="float: right; margin: -16px 50px 0 0;" alt="|" />'; // Spacer Icon
		$content .= '<a href="index.php?id=0' . $param . '&export=xls"><img src="../files/img/icon_xls.gif" style="float: right; margin: -16px 25px 0 0;" title="XLS Export" alt="XLS export" /></a>'; // XLS Export
		$content .= '<a href="index.php?id=0' . $param . '&export=csv"><img src="../files/img/icon_csv.gif" style="float: right; margin-top: -16px;" title="CSV Export" alt="CSV export" /></a>'; // CSV Export
		$content .= '<div style="clear: both;"></div>';
		return $content;
	}
	
	
	/**
	 * Overwrite values in $conf with flexform values and give conf array back
	 *
	 * @param	array	$pObj			parent object
	 * @return	void
	 */
	public function flex2conf(&$pObj) {
		if (is_array($pObj->cObj->data['pi_flexform']['data'])) { // if there are flexform values
			foreach ($pObj->cObj->data['pi_flexform']['data'] as $key => $value) { // every flexform category
				if (count($pObj->cObj->data['pi_flexform']['data'][$key]['lDEF']) > 0) { // if there are flexform values
					foreach ($pObj->cObj->data['pi_flexform']['data'][$key]['lDEF'] as $key2 => $value2) { // every flexform option
						if ($pObj->pi_getFFvalue($pObj->cObj->data['pi_flexform'], $key2, $key)) { // if value exists in flexform
							$pObj->conf[$key.'.'][$key2] = $pObj->pi_getFFvalue($pObj->cObj->data['pi_flexform'], $key2, $key); // overwrite $conf
						}
					}
				}
			}
		}
	}
	
	
	/**
	 * Use doorman method to clean piVars against bad guyes
	 *
	 * @param	object	$pObj			parent object
	 * @return	void
	 */
	public function cleanPiVars(&$pObj) {
		if (class_exists('tx_wtdoorman_security')) { // only if doorman class available
			$this->sec = t3lib_div::makeInstance('tx_wtdoorman_security'); // Create new instance for security class
			$this->sec->secParams = array ( // Allowed piVars type (int, text, alphanum, "value")
				'print' => 'int' // show should be integer
			);
			$pObj->piVars = $this->sec->sec($pObj->piVars); // overwrite piVars piVars from doorman class
		} else die ('Extension wt_doorman not found!');
	}
	
	
	/**
	 * change key of a given array (add string before)
	 *
	 * @param	array	$array				any assotiative array
	 * @param	string	$stringBefore		string to add
	 * @return	array	$newarray			array with changed key
	 */
	public function changeKeyOfArray($array, $stringBefore) {
		if (is_array($array) && strlen($stringBefore)) { // if it's an array
			$newarray = array(); // init new array
			foreach ((array) $array as $key => $value) { // one loop for every key
				$newarray[$stringBefore . $key] = $value; // add string to key
			}
			
			return $newarray;
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/lib/class.tx_minicrm_lib.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/lib/class.tx_minicrm_lib.php']);
}

?>