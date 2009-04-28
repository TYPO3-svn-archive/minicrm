<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_minicrm_mails'] = array (
	'ctrl' => $TCA['tx_minicrm_mails']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title,kind,date,text'
	),
	'feInterface' => $TCA['tx_minicrm_mails']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, trim',
			)
		),
		'kind' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.kind',		
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.kind.I.0', '0'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.kind.I.1', '1'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.kind.I.2', '2'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.kind.I.3', '3'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.kind.I.4', '4'),
				),
				'size' => 1,	
				'maxitems' => 1,
			)
		),
		'way' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.way',		
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.way.I.0', '0'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.way.I.1', '1'),
				),
				'size' => 1,	
				'maxitems' => 1,
			)
		),
		'date' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.date',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required,datetime',
			)
		),
		'text' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.text',		
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => Array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon' => 'wizard_rte2.gif',
						'script' => 'wizard_rte.php',
					),
				),
			)
		),	
		'upload' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails.upload',		
			'config' => array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'gif,png,jpeg,jpg,zip,doc,xls,pdf,bmp,eps,docx,xlsx,ttf,psd',	
				'max_size' => 50000,	
				'uploadfolder' => 'uploads/tx_minicrm/mails/',
				'show_thumbs' => 1,	
				'size' => 3,	
				'minitems' => 0,
				'maxitems' => 10,
			)
		),
		'parentid' => Array(
			'config' => Array(
				'type' => 'passthrough',
			),
		),
		'parenttable' => Array(
			'config' => Array(
				'type' => 'passthrough',
			),
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, --palette--;Way;2, text;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_minicrm/rte/], upload')
	),
	'palettes' => array (
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'kind, way, date')
	)
);

?>