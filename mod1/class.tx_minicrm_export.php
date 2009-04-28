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


class tx_minicrm_export {

	protected $mode = 'export';
	protected $tempfile = '/typo3temp/tx_minicrm/';
	protected $csvSplitSign = ',';
	
	/**
	 * Main Function for export
	 *
	 * @param	array	$pObj				$this from index.php
	 * @param	array	$row				values to export
	 * @param	array	$title				title for export
	 * @return	string	$this->content		Result HTML Code
	 */
	public function main(&$pObj, $row = array(), $title = '') {
		// config
		$filecontent = $content = '';
		$this->pObj = &$pObj;
		$this->TSconfig = t3lib_BEfunc::getModTSconfig(0, 'miniCRM'); // get tsconfig from backend
		$this->div = t3lib_div::makeInstance('tx_minicrm_div'); // get div class
		$this->func = htmlentities($_GET['SET']['function']); // what kind of view should be used
		$this->func = htmlentities($_GET['SET']['function_custom']); // what kind of custom view should be used
		$this->export = htmlentities($_GET['export']); // export variable
		
		// 1. Prepare $row and $title
		if (is_array($row) && count($row) > 0) { // if $row is already existing
			$title = array(0 => t3lib_div::trimExplode(',', $title, 1)); // split titles at ,
			if (strlen($title) > 0) $row = array_merge((array) $title, (array) $row); // if title exists, add it to row array
		} else { // $row don't exists - get it from customview settings now
			if (strlen($this->TSconfig['properties']['customView.'][$this->func]['select']) > 0) { // if select was set in TSconfig
				$title = array(0 => t3lib_div::trimExplode(',', $this->TSconfig['properties']['customView.'][$this->func]['tabletitles'], 1)); // split title at ,
				$row = $this->div->dbGetList($this->TSconfig['properties']['customView.'][$this->func]['select'], '', $this->TSconfig['properties']['customView.'][$this->func]['where'], $this->TSconfig['properties']['customView.'][$this->func]['groupby'], $this->TSconfig['properties']['customView.'][$this->func]['orderby'], $this->TSconfig['properties']['customView.'][$this->func]['limit']); // get values from db
				if (strlen($this->TSconfig['properties']['customView.'][$this->func]['tabletitles']) > 0) $row = array_merge((array) $title, (array) $row); // if title exists, add it to row array
			} else { // select was not set in TSconfig
				$content .= $this->div->wrapMessage($this->pObj->LANG->getLL('custom_noSelect'), 'error'); // error message
			}
		}
		
		// 2. Export function from $row
		if (is_array($row) && count($row) > 0) { // $row is filled successfull
			if ($this->export == 'csv') { // if csv export
				foreach ((array) $row as $key => $value) { // one loop for every set
					$filecontent .= t3lib_div::csvValues($value, $this->csvSplitSign)."\n"; // write string with csv content
				}
				$filename = 'minicrm_'.t3lib_div::md5int($filecontent).'.csv'; // generate filename with hashcode
			} else { // xls export
				$filecontent .= $this->div->array2html($row, $this->pObj, '', 0, 0, 1); // give me a html table
				$filename = 'minicrm_'.t3lib_div::md5int($filecontent).'.xls'; // generate filename with hashcode
			}
			if (strlen(trim($filecontent)) > 0) { // if there is content in the variable
				if (!$msg = t3lib_div::writeFileToTypo3tempDir(t3lib_div::getIndpEnv('TYPO3_DOCUMENT_ROOT').$this->tempfile.$filename, $filecontent)) { // generate csv file AND check if was successful
					$content .= $this->div->wrapMessage($this->pObj->LANG->getLL('fileGenerated'), 'success'); // ok message
					$content .= '<p style="padding: 5px;"><u><b><a href="'.t3lib_div::getIndpEnv('TYPO3_SITE_URL').$this->tempfile.$filename.'" target="_blank">'.$this->pObj->LANG->getLL('fileDownload').'</a></u></b></p>';
				} else { // if error happens
					$content .= $this->div->wrapMessage($msg, 'error'); // error message
				}
			} else { // no content for file
				$content .= $this->div->wrapMessage($this->pObj->LANG->getLL('noContent'), 'error'); // error message
			}
		} else $content .= $this->div->wrapMessage($this->pObj->LANG->getLL('noContent'), 'error'); // error message
		return $content;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/class.tx_minicrm_export.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/class.tx_minicrm_export.php']);
}

?>