<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

t3lib_extMgm::addStaticFile($_EXTKEY, 'files/static/main/', 'miniCRM TS'); // add possibility for static template

$TCA['tx_minicrm_account'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_account',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_account.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_account.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title, notes, payment, segment, address, contact, project',
	)
);

$TCA['tx_minicrm_accounttype'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_accounttype',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_accounttype.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_accounttype.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title',
	)
);

$TCA['tx_minicrm_notes'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_notes',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_notes.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_notes.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, description, payment_behavior, quality, fussy',
	)
);

$TCA['tx_minicrm_payment'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_payment',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_payment.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_payment.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title',
	)
);

$TCA['tx_minicrm_segment'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_segment',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_segment.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_segment.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title',
	)
);

$TCA['tx_minicrm_project'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_project',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_project.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_project.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title, invoiceno, invoicedate, payed, status, products',
	)
);

$TCA['tx_minicrm_status'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_status',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_status.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_status.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title',
	)
);

$TCA['tx_minicrm_products'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_products',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_products.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_products.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title, productnumber, price, amount, description, description_intern, mails',
	)
);

$TCA['tx_minicrm_mails'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:minicrm/locallang_db.xml:tx_minicrm_mails',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY date DESC',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca/tx_minicrm_mails.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'files/img/icon_tx_minicrm_mails.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title, kind, date, text',
	)
);

// extend tt_address
t3lib_div::loadTCA('tt_address');
t3lib_extMgm::addTCAcolumns (
	'tt_address', 
	array (    
		'title' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.title_person',
			'config' => array (
				'type' => 'text',
				'cols' => '20',
				'rows' => '3'
			)
		)
	)
);

// extend fe_users
t3lib_div::loadTCA('fe_users');
t3lib_extMgm::addTCAcolumns('fe_users', 
	array (    
		'tx_minicrm_firstname' => array (        
			'exclude' => 1,        
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_firstname', 
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),   
		'tx_minicrm_lastname' => array (        
			'exclude' => 1,        
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_lastname', 
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'tx_minicrm_mobile' => array (        
			'exclude' => 1,        
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_mobile', 
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
			)
		),
		'tx_minicrm_skype' => array (        
			'exclude' => 1,        
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_skype', 
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
			)
		),
		'tx_minicrm_icq' => array (        
			'exclude' => 1,        
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_icq', 
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
			)
		),
		'tx_minicrm_position' => array (        
			'exclude' => 1,        
			'label' => 'LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position', 
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.0', '0'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.1', '1'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.2', '2'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.3', '3'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.4', '4'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.5', '5'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.6', '6'),
					array('LLL:EXT:minicrm/locallang_db.xml:fe_users.tx_minicrm_position.I.7', '7')
				),
				'size' => 1,	
				'maxitems' => 1
			)
		)
	)
);

	// quick and very dirty renaming of "username" to "xusernaxmex" so we can use "name" for further replaces below
$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace('username', 'xusernaxmex', $TCA['fe_users']['interface']['showRecordFieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace('username', 'xusernaxmex', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['types']['0']['showitem'] = str_replace('username', 'xusernaxmex', $TCA['fe_users']['types']['0']['showitem']);
	// add names, position
$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace('name', 'name, tx_minicrm_position, tx_minicrm_lastname, tx_minicrm_firstname', $TCA['fe_users']['interface']['showRecordFieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace('name', 'name, tx_minicrm_position, tx_minicrm_lastname, tx_minicrm_firstname', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['types']['0']['showitem'] = str_replace('name', 'name, tx_minicrm_position, tx_minicrm_lastname, tx_minicrm_firstname', $TCA['fe_users']['types']['0']['showitem']);
	// add mobile
$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace('phone', 'phone, tx_minicrm_mobile', $TCA['fe_users']['interface']['showRecordFieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace('phone', 'phone, tx_minicrm_mobile', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['types']['0']['showitem'] = str_replace('phone', 'phone, tx_minicrm_mobile', $TCA['fe_users']['types']['0']['showitem']);
	// add skype, icq
$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace('www', 'www, tx_minicrm_skype, tx_minicrm_icq', $TCA['fe_users']['interface']['showRecordFieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace('www', 'www, tx_minicrm_skype, tx_minicrm_icq', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['types']['0']['showitem'] = str_replace('www', 'www, tx_minicrm_skype, tx_minicrm_icq', $TCA['fe_users']['types']['0']['showitem']);
	// get username back
$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace('xusernaxmex', 'username', $TCA['fe_users']['interface']['showRecordFieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace('xusernaxmex', 'username', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['types']['0']['showitem'] = str_replace('xusernaxmex', 'username', $TCA['fe_users']['types']['0']['showitem']);

	// changes for tt_content
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout, select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';
t3lib_extMgm::addPlugin (
	array (
		'LLL:EXT:minicrm/locallang_db.xml:tt_content.list_type_pi1', 
		$_EXTKEY.'_pi1',
		t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	), 
	'list_type'
);
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:minicrm/pi1/flexform_ds_pi1.xml');

if (TYPO3_MODE == 'BE')	{
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_minicrm_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_minicrm_pi1_wizicon.php';
	t3lib_extMgm::addModule('user', 'txminicrmM1', '', t3lib_extMgm::extPath($_EXTKEY).'mod1/');
}
?>