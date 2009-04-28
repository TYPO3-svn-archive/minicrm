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


	// DEFAULT initialization of a module [BEGIN]
unset($MCONF);
require_once('conf.php');
require_once($BACK_PATH.'init.php');
require_once($BACK_PATH.'template.php');

$LANG->includeLLFile('EXT:minicrm/mod1/locallang.xml');
require_once(PATH_t3lib.'class.t3lib_scbase.php');
$BE_USER->modAccess($MCONF,1);	// This checks permissions and exits if the users has no permission for entry.
	// DEFAULT initialization of a module [END]

// include further files
require_once('class.tx_minicrm_customview.php'); // include customview function
require_once('class.tx_minicrm_list.php'); // include list function



/**
 * Module 'MiniCRM' for the 'minicrm' extension.
 *
 * @author	Alex Kellner <alexander.kellner@einpraegsam.net>
 * @package	TYPO3
 * @subpackage	tx_minicrm
 */
class tx_minicrm_module1 extends t3lib_SCbase {
	var $pageinfo;

	/**
	 * Initializes the Module
	 * @return	void
	 */
	function init()	{
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
		$this->extKey = 'minicrm'; // extKey
		$this->confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]); // Get backandconfig

		parent::init();
	}

	/**
	 * Adds items to the ->MOD_MENU array. Used for the function menu selector.
	 *
	 * @return	void
	 */
	function menuConfig() {
		// Menuconfiguration
		global $LANG;
		$this->MOD_MENU = Array (
			'function' => Array (
				'1' => $LANG->getLL('account_view'),
				'2' => $LANG->getLL('project_view'),
				'3' => $LANG->getLL('sales_view'),
				'4' => $LANG->getLL('custom_view'),
			)
		);
		// adding hook for Menu manipulation
		if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->extKey]['be_menu']) {
		   foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->extKey]['be_menu'] as $_funcRef) {
			  if ($_funcRef) {
				 $this->MOD_MENU = t3lib_div::callUserFunction($_funcRef, $this->MOD_MENU, $this);
			  }
		   }
		}
		parent::menuConfig();
	}

	/**
	 * Main function of the module. Write the content to $this->content
	 * If you chose "web" as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
	 *
	 * @return	[type]		...
	 */
	function main()	{
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

		// Access check!
		// The page will show only if there is a valid page and if this page may be viewed by the user
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;

		if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id))	{

				// Draw the header.
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->backPath = $BACK_PATH;
			$this->doc->form = '<form action="" method="POST">';

				// JavaScript
			$this->doc->JScode = '
				<script language="javascript" type="text/javascript">
					script_ended = 0;
					function jumpToUrl(URL)	{
						document.location = URL;
					}
				</script>
			';
			$this->doc->postCode='
				<script language="javascript" type="text/javascript">
					script_ended = 1;
					if (top.fsMod) top.fsMod.recentIds["web"] = 0;
				</script>
			';

			$headerSection = $this->doc->getHeader('pages', $this->pageinfo, $this->pageinfo['_thePath']).'<br />'.$LANG->sL('LLL:EXT:lang/locallang_core.xml:labels.path').': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'],50);

			$this->content.=$this->doc->startPage($LANG->getLL('title'));
			$this->content.=$this->doc->header($LANG->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->section('', $this->doc->funcMenu($headerSection, t3lib_BEfunc::getFuncMenu($this->id, 'SET[function]', $this->MOD_SETTINGS['function'], $this->MOD_MENU['function'])));
			$this->content.=$this->doc->divider(5);


			// Render content:
			$this->moduleContent();


			// ShortCut
			if ($BE_USER->mayMakeShortcut())	{
				$this->content .= $this->doc->spacer(20).$this->doc->section('', $this->doc->makeShortcutIcon('id', implode(',', array_keys($this->MOD_MENU)), $this->MCONF['name']));
			}

			$this->content .= $this->doc->spacer(10);
		} else {
				// If no access or if ID == zero

			$this->doc = t3lib_div::makeInstance('mediumDoc');
			$this->doc->backPath = $BACK_PATH;

			$this->content.=$this->doc->startPage($LANG->getLL('title'));
			$this->content.=$this->doc->header($LANG->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->spacer(10);
		}
	}

	/**
	 * Prints out the module HTML
	 *
	 * @return	void
	 */
	function printContent()	{

		$this->content.=$this->doc->endPage();
		return $this->content;
	}

	/**
	 * Generates the module content
	 *
	 * @return	void
	 */
	function moduleContent() {
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
		$this->LANG = $LANG;
		
		switch((string)$this->MOD_SETTINGS['function'])	{
			case 1: // Account list
				$this->list = t3lib_div::makeInstance('tx_minicrm_list'); // get list class
				$this->list->mode = 'account'; // change mode
				$this->list->select = '
					tx_minicrm_account.uid _auid, 
					tx_minicrm_account.title, 
					tx_minicrm_notes.quality, 
					tt_address.www, 
					tt_address.email, 
					tx_minicrm_project.title projecttitle, 
					count(distinct(tx_minicrm_project.uid)), 
					if (sum(tx_minicrm_products.amount * tx_minicrm_products.price) > 0, sum(tx_minicrm_products.amount * tx_minicrm_products.price), 0)
				'; // change selection
				$this->list->groupby = 'tx_minicrm_account.uid';
				$this->list->orderby = 'tx_minicrm_account.title ASC';
				$this->list->title = $this->LANG->getLL('viewAccount_title').', '.$this->LANG->getLL('viewAccount_quality').', '.$this->LANG->getLL('viewAccount_domain').', '.$this->LANG->getLL('viewAccount_email').', '.$this->LANG->getLL('viewAccount_projecttitle').', '.$this->LANG->getLL('viewAccount_projectnumbers').', '.$this->LANG->getLL('viewAccount_overallsum'); // title
				
				$content = $this->list->main($this); // get main function for list
				$this->content .= $this->doc->section($LANG->getLL('account_view').':', $content, 0, 1);
			break;
			
			case 2: // Project list
				$this->list = t3lib_div::makeInstance('tx_minicrm_list'); // get list class
				$this->list->mode = 'project'; // change mode
				$this->list->select = '
					tx_minicrm_account.uid _auid,
					tx_minicrm_project.uid, 
					tx_minicrm_project.title, 
					FROM_UNIXTIME(tx_minicrm_project.invoicedate, "%d.%m.%Y"),
					tx_minicrm_account.title at, 
					tx_minicrm_project.invoiceno, 
					if (sum(tx_minicrm_products.amount * tx_minicrm_products.price) > 0, sum(tx_minicrm_products.amount * tx_minicrm_products.price), 0), 
					tx_minicrm_project.payed, 
					tx_minicrm_status.title st
				'; // change selection
				$this->list->where = 'tx_minicrm_project.crdate < '.time().' AND tx_minicrm_project.crdate > '.time() - 31536000;
				$this->list->groupby = 'tx_minicrm_project.uid';
				$this->list->orderby = 'tx_minicrm_project.invoiceno DESC';
				$this->list->title = $this->LANG->getLL('viewProject_puid').', '.$this->LANG->getLL('viewProject_ptitle').', '.$this->LANG->getLL('viewProject_date').', '.$this->LANG->getLL('viewProject_atitle').', '.$this->LANG->getLL('viewProject_ino').', '.$this->LANG->getLL('viewProject_psum').', '.$this->LANG->getLL('viewProject_payed').', '.$this->LANG->getLL('viewProject_status'); // title
				
				$content = $this->list->main($this); // get main function for list
				$this->content .= $this->doc->section($LANG->getLL('project_view').':', $content, 0, 1);
			break;
			
			case 3: // Sales statistic
				$this->list = t3lib_div::makeInstance('tx_minicrm_list'); // get list class
				$this->list->mode = 'sales'; // change mode
				$this->list->select = '
					tx_minicrm_account.uid _auid,
					FROM_UNIXTIME(tx_minicrm_project.invoicedate, "%d.%m.%Y"),
					if (sum(tx_minicrm_products.amount * tx_minicrm_products.price) > 0, sum(tx_minicrm_products.amount * tx_minicrm_products.price), 0),
					tx_minicrm_project.invoiceno,
					tx_minicrm_project.title,
					tx_minicrm_account.title at
				'; // change selection
				$this->list->groupby = 'tx_minicrm_project.uid';
				$this->list->orderby = 'tx_minicrm_project.invoicedate DESC';
				$this->list->title = $this->LANG->getLL('viewSales_Date').', '.$this->LANG->getLL('viewSales_psum').', '.$this->LANG->getLL('viewSales_ino').', '.$this->LANG->getLL('viewSales_ptitle').', '.$this->LANG->getLL('viewSales_atitle'); // title
				
				$content = $this->list->main($this); // get main function for list
				$this->content .= $this->doc->section($LANG->getLL('sales_view').':', $content, 0, 1);
			break;
			
			case 4:	// Custom view
				$this->customview = t3lib_div::makeInstance('tx_minicrm_customview'); // get customview class
				$content = $this->customview->main($this); // get main function for customview
				$this->content .= $this->doc->section($LANG->getLL('custom_view').':', $content, 0, 1);
			break;
			
			default: // Add hook for additional views
				if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->extKey]['be_view']) { // if hook exists
				   foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->extKey]['be_view'] as $_funcRef) {
					  if ($_funcRef) {
						 $this->content .= t3lib_div::callUserFunction($_funcRef, $this->content, $this);
					  }
				   }
				} else { // no hook definition
					$this->content .= 'No hook definition for '.$this->MOD_SETTINGS['function'].' in file EXT:minicrm/mod1/index.php'; // errormsg
				}
			break;
		}
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/index.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/minicrm/mod1/index.php']);
}




// Make instance:
$SOBE = t3lib_div::makeInstance('tx_minicrm_module1');
$SOBE->init();

// Include files?
foreach ($SOBE->include_once as $INC_FILE) include_once($INC_FILE);

$SOBE->main();
echo $SOBE->printContent();

?>