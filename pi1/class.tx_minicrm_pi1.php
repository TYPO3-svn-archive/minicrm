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
require_once(t3lib_extMgm::extPath('minicrm') . 'pi1/class.tx_minicrm_pi1_list.php'); // load list class
require_once(t3lib_extMgm::extPath('minicrm') . 'pi1/class.tx_minicrm_pi1_invoice.php'); // load invoice class

/**
 * Plugin 'MiniCRM' for the 'minicrm' extension.
 *
 * @author	Alex Kellner <alexander.kellner@einpraegsam.net>
 * @package	TYPO3
 * @subpackage	tx_minicrm
 */
class tx_minicrm_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_minicrm_pi1'; // Same as class name
	public $scriptRelPath = 'pi1/class.tx_minicrm_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'minicrm'; // The extension key.
	public $pi_checkCHash = true;
	
	/**
	 * Main method of your PlugIn
	 *
	 * @param	string		$content: Could be the content of the PlugIn
	 * @param	array		$conf: The PlugIn Configuration
	 * @return	The content that should be displayed on the website
	 */
	public function main($content, $conf)	{
		// config
		$this->conf = $conf;
		$this->content = $content;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		$this->pi_initPIflexForm();
		$this->div = t3lib_div::makeInstance('tx_minicrm_div'); // Get div methods
		$this->div->flex2conf($this); // Overwrite $this->conf with flexform values
		$this->div->cleanPiVars($this); // Overwrite $this->conf with flexform values
		
		// let's go
		if (strlen($this->conf['main.']['mode']) > 0) { // only if mode was set
			$this->mode = t3lib_div::trimExplode(',', $this->conf['main.']['mode'], 1); // split modes at ,
			
			for ($i=0; $i < count($this->mode); $i++) { // One loop for every selected mode
				
				switch ($this->mode[$i]) { // mode
					case 'account': // if account list is selected
						$this->list = t3lib_div::makeInstance('tx_minicrm_pi1_list'); // Get list method
						$this->list->mode2 = $this->mode[$i]; // write account in mode
						$this->content .= $this->list->main($this); // get list view
						break;
						
					case 'project': // if project list is selected
						$this->content .= 'will be implemented soon!';
						break;
						
					case 'invoice': // if invocice is selected
						$this->invoice = t3lib_div::makeInstance('tx_minicrm_pi1_invoice'); // Get list method
						$this->content .= $this->invoice->main($this); // get list view
						break;
						
				}
				
			}
		} else { // No mode in flexform selected
			$this->content .= 'No mode selected in backend';
		}
		
		return $this->pi_wrapInBaseClass($this->content); // return content
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/pi1/class.tx_minicrm_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/pi1/class.tx_minicrm_pi1.php']);
}

?>