<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_minicrm_account'] = array (
	'ctrl' => $TCA['tx_minicrm_account']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title,notes,payment,segment,address,contact,project'
	),
	'feInterface' => $TCA['tx_minicrm_account']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim, required, uniqueInPid',
			)
		),
		'accounttype' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account.accounttype',		
			'config' => Array (
				'type' => 'select',	
				'foreign_table' => 'tx_minicrm_accounttype',	
				'foreign_table_where' => 'AND tx_minicrm_accounttype.pid=###CURRENT_PID### ORDER BY tx_minicrm_accounttype.sorting',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'notes' => Array (
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account.notes',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => 'tx_minicrm_notes',
				'foreign_field' => 'parentid',
				'foreign_table_field' => 'parenttable',
				'maxitems' => 1,
			),
		),
		'address' => Array (
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account.address',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => 'tt_address',
				'foreign_field' => 'tx_minicrm_parentid',
				'foreign_table_field' => 'tx_minicrm_parenttable',
				'maxitems' => 1,
			),
		),
		'contact' => Array (
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account.contact',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => 'fe_users',
				'foreign_field' => 'tx_minicrm_parentid',
				'foreign_table_field' => 'tx_minicrm_parenttable',
				'maxitems' => 100,
			),
		),
		'project' => Array (
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account.project',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => 'tx_minicrm_project',
				'foreign_field' => 'parentid',
				'foreign_table_field' => 'parenttable',
				'maxitems' => 1000,
			),
		),
	),
	'types' => array (
		'0' => array('showitem' => '--palette--;Account;2, notes;;;;3-3-3, address, contact, project')
	),
	'palettes' => array (
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'title;;;;2-2-2, accounttype, hidden;;;;1-1-1')
	)
);

?>