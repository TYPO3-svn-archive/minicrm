<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_minicrm_accounttype'] = array (
	'ctrl' => $TCA['tx_minicrm_accounttype']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_minicrm_accounttype']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_accounttype.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, trim',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

?>