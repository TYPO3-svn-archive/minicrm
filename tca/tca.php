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



$TCA['tx_minicrm_payment'] = array (
	'ctrl' => $TCA['tx_minicrm_payment']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_minicrm_payment']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_payment.title',		
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



$TCA['tx_minicrm_segment'] = array (
	'ctrl' => $TCA['tx_minicrm_segment']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_minicrm_segment']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_segment.title',		
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



$TCA['tx_minicrm_status'] = array (
	'ctrl' => $TCA['tx_minicrm_status']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_minicrm_status']['feInterface'],
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
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_status.title',		
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