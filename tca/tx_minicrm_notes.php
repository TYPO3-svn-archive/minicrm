<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_minicrm_notes'] = array (
	'ctrl' => $TCA['tx_minicrm_notes']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,description,payment_behavior,quality,fussy'
	),
	'feInterface' => $TCA['tx_minicrm_notes']['feInterface'],
	'columns' => array (
		'title' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, trim',
			)
		),
		'description' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.description',		
			'config' => Array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
			)
		),
		'payment' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.payment',		
			'config' => Array (
				'type' => 'select',	
				'items' => Array (
					Array('', 0),
				),
				'foreign_table' => 'tx_minicrm_payment',	
				'foreign_table_where' => 'AND tx_minicrm_payment.pid=###CURRENT_PID### ORDER BY tx_minicrm_payment.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'segment' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.segment',		
			'config' => Array (
				'type' => 'select',	
				'items' => Array (
					Array('', 0),
				),
				'foreign_table' => 'tx_minicrm_segment',	
				'foreign_table_where' => 'AND tx_minicrm_segment.pid=###CURRENT_PID### ORDER BY tx_minicrm_segment.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'payment_behavior' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.payment_behavior',	
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.payment_behavior.I.0', '0'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.payment_behavior.I.1', '1'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.payment_behavior.I.2', '2'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.payment_behavior.I.3', '3')
				),
				'size' => 1,	
				'maxitems' => 1,
			)
		),
		'quality' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.quality',	
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.quality.I.0', '0'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.quality.I.1', '1'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.quality.I.2', '2'),
					Array('LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.quality.I.3', '3')
				),
				'size' => 1,	
				'maxitems' => 1,
			)
		),
		'fussy' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes.fussy',		
			'config' => Array (
				'type' => 'check',
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
		'0' => array('showitem' => 'title, description, payment, segment, payment_behavior, quality, fussy')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

?>