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



/**
 * Misc class for userFuncs in TS stdWrap
 *
 * @author	Alex Kellner <alexander.kellner@einpraegsam.net>
 * @package	TYPO3
 * @subpackage	tx_minicrm
 */
class user_minicrm_misc {

	/**
	 * PHP function number_format for stdWrap
	 *
	 * @param	string		$content	empty content
	 * @param	array		$conf		ts configuration
	 * @return	string		$number		formated number
	 */
	public function minicrm_number_format($content = '', $conf = array()) {
		global $TSFE;
    	$local_cObj = $TSFE->cObj; // cObject
		$conf = $conf['userFunc.']; // TS configuration
		
		$number = $local_cObj->cObjGetSingle($conf['number'], $conf['number.']); // get number
		return number_format($number, $conf['decimal'], $conf['dec_point'], $conf['thousands_sep']);
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/lib/user_minicrm_misc.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/lib/user_minicrm_misc.php']);
}
?>