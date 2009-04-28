<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_minicrm_products'] = array (
	'ctrl' => $TCA['tx_minicrm_products']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title,productnumber,price,amount,description,description_intern,mails'
	),
	'feInterface' => $TCA['tx_minicrm_products']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, trim',
			)
		),
		'productnumber' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products.productnumber',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, trim',
			)
		),
		'price' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products.price',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required, double2',
			)
		),
		'amount' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products.amount',		
			'config' => Array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '10000',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => Array (
					'upper' => '100000',
					'lower' => '1'
				),
				'default' => 1
			)
		),
		'description' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products.description',		
			'config' => Array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
				'eval' => 'required'
			)
		),
		'description_intern' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products.description_intern',		
			'config' => Array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, --palette--;Product;2, --palette--;Productdescription;3')
	),
	'palettes' => array (
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'productnumber, price, amount'),
		'3' => array('showitem' => 'description, description_intern')
	)
);

?>