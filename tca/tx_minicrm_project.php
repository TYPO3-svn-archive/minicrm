<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_minicrm_project'] = array (
	'ctrl' => $TCA['tx_minicrm_project']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title,invoiceno,invoicedate,payed,status,products'
	),
	'feInterface' => $TCA['tx_minicrm_project']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, trim'
			)
		),
		'invoiceno' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.invoiceno',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'trim'
			)
		),
		'invoicedate' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.invoicedate',		
			'config' => Array (
				'type' => 'input',	
				'size' => '10',	
				'eval' => 'date',
			)
		),
		'startdate' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.startdate',		
			'config' => Array (
				'type' => 'input',	
				'size' => '10',	
				'eval' => 'date',
			)
		),
		'description' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.description',		
			'config' => Array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
			)
		),
		'payed' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.payed',		
			'config' => Array (
				'type' => 'check',
			)
		),
		'status' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.status',		
			'config' => Array (
				'type' => 'select',	
				'foreign_table' => 'tx_minicrm_status',	
				'foreign_table_where' => 'AND tx_minicrm_status.pid=###CURRENT_PID### ORDER BY tx_minicrm_status.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1
			)
		),
		'upload' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.upload',		
			'config' => array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'gif,png,jpeg,jpg,zip,doc,xls,pdf,bmp,eps,docx,xlsx,ttf,psd',	
				'max_size' => 50000,	
				'uploadfolder' => 'uploads/tx_minicrm/projects/',
				'show_thumbs' => 1,	
				'size' => 5,	
				'minitems' => 0,
				'maxitems' => 100,
			)
		),
		'mails' => Array (
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.mails',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => 'tx_minicrm_mails',
				'foreign_field' => 'parentid',
				'foreign_table_field' => 'parenttable',
				'maxitems' => 1000,
			),
		),
		'products' => Array (
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project.products',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => 'tx_minicrm_products',
				'foreign_field' => 'parentid',
				'foreign_table_field' => 'parenttable',
				'maxitems' => 100,
			),
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, --palette--;Invoice;2, --palette--;Status;3, upload, mails, products')
	),
	'palettes' => array (
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'invoiceno;;;;3-3-3, startdate, invoicedate'),
		'3' => array('showitem' => 'description, payed, status')
	)
);

?>