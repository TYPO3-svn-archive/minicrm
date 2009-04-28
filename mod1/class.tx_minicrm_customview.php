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


class tx_minicrm_customview {

	protected $mode = 'custom';
	
	
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
		$this->func = htmlentities($_GET['SET']['function_custom']); // what kind of custom view should be used
		$this->export = htmlentities($_GET['export']); // export variable
		
		// Let's go
		$this->MOD_MENU['function_custom'][0] = $this->pObj->LANG->getLL('text_option'); // Please choose
		foreach ((array) $this->TSconfig['properties']['customView.'] as $key => $value) { // one loop for every view in TSconfig
			$this->MOD_MENU['function_custom'][$key] = $value['title']; // Write current title to select box
		}
		
		$this->content .= t3lib_BEfunc::getFuncMenu($this->pObj->id, 'SET[function_custom]', $this->func, $this->MOD_MENU['function_custom']); // add selection
		if ($this->func && !$this->export) $this->content .= $this->div->BEIcons('&SET[function_custom]='.$this->func, $pObj); // add exporticon  // show export icon only if a custom function was chosen and if we're not on the export page
		$this->content .= $this->moduleContent(); // add content
		
		return $this->content;
	}
	
	
	/**
	 * Implements showing function
	 *
	 * @return	string	$this->content		HTML selector box
	 */
	protected function moduleContent() {
		if (count($this->TSconfig['properties']['customView.']) > 0) { // if there are settings in the TSconfig
			if (!$this->func) { // selector "please choose" is selected
				$content = ''; // no content
			} else { // use special function
				if (empty($this->export)) { // not export
					$content = $this->showList($this->func); // open showlist function and give me the list
				} else { // export
					$this->export = t3lib_div::makeInstance('tx_minicrm_export'); // get export class
					$content = $this->export->main($this->pObj); // open export function
				}
			}
			
		} else { // no settings in the TSconfig - show note
			$content = $this->div->wrapMessage($this->pObj->LANG->getLL('noTSconfig'), 'note'); // note
		}
		
		return '<hr />'.$content; // return content
	}
	
	
	/**
	 * Shows list
	 *
	 * @param	string	$key				Key for TSconfig
	 * @return	string	$content			Code for viewing
	 */
	protected function showList($key) {
		// config
		$content = '';
		
		// Let's go
		$content .= '<p><b>' . (strlen($this->TSconfig['properties']['customView.'][$key]['title']) > 0 ? $this->TSconfig['properties']['customView.'][$key]['title'] : $this->pObj->LANG->getLL('custom_noTitle')) . '</b></p>'; // write title
		$content .= '<p>&nbsp;</p>';
		
		if (strlen($this->TSconfig['properties']['customView.'][$key]['select']) > 0) { // if select was set in TSconfig
			
			$row = $this->div->dbGetList($this->TSconfig['properties']['customView.'][$key]['select'], '', $this->TSconfig['properties']['customView.'][$key]['where'], $this->TSconfig['properties']['customView.'][$key]['groupby'], $this->TSconfig['properties']['customView.'][$key]['orderby'], $this->TSconfig['properties']['customView.'][$key]['limit']); // get values from db
			if (count($row) > 0) { // if there is a result	
				$content .= $this->div->array2html($row, $this->pObj, $this->TSconfig['properties']['customView.'][$key]['tabletitles']); // array2hmtl
			} else { // no result, show note
				$content .= $this->div->wrapMessage($this->pObj->LANG->getLL('noEntriesFound'), 'note'); // error
			}
		
		} else { // no select in TSconfig founc
			$content .= $this->div->wrapMessage($this->pObj->LANG->getLL('custom_noSelect'), 'error'); // error
		}
		
		return $content;
	}	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/class.tx_minicrm_customview.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/class.tx_minicrm_customview.php']);
}

?>