<?php

########################################################################
# Extension Manager/Repository config file for ext: "minicrm"
#
# Auto generated 28-04-2009 00:11
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'miniCRM',
	'description' => 'Small Customer Relationship Management (CRM) for TYPO3, Storing clients, projects, mails, invoices and much more...',
	'category' => 'be',
	'shy' => 0,
	'version' => '0.1.3',
	'dependencies' => 'cms,tt_address,wt_doorman',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => 'mod1',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_minicrm/rte/, uploads/tx_minicrm/projects/, uploads/tx_minicrm/mails/ typo3temp/tx_minicrm/',
	'modify_tables' => 'tt_address, fe_users',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Alex Kellner',
	'author_email' => 'alexander.kellner@einpraegsam.net',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '4.1.0-',
			'tt_address' => '',
			'php' => '5.0.0-0.0.0',
			'wt_doorman' => '1.0.0-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:60:{s:21:"ext_conf_template.txt";s:4:"fb3d";s:12:"ext_icon.gif";s:4:"e570";s:17:"ext_localconf.php";s:4:"db98";s:14:"ext_tables.php";s:4:"00ac";s:14:"ext_tables.sql";s:4:"ec0a";s:27:"icon_tx_minicrm_account.gif";s:4:"f557";s:30:"icon_tx_minicrm_account__h.gif";s:4:"1fbb";s:31:"icon_tx_minicrm_accounttype.gif";s:4:"8ecf";s:34:"icon_tx_minicrm_accounttype__h.gif";s:4:"f184";s:25:"icon_tx_minicrm_mails.gif";s:4:"6b43";s:28:"icon_tx_minicrm_mails__h.gif";s:4:"3ce0";s:25:"icon_tx_minicrm_notes.gif";s:4:"82e0";s:28:"icon_tx_minicrm_notes__h.gif";s:4:"4805";s:27:"icon_tx_minicrm_payment.gif";s:4:"4648";s:30:"icon_tx_minicrm_payment__h.gif";s:4:"e17d";s:28:"icon_tx_minicrm_products.gif";s:4:"6a61";s:31:"icon_tx_minicrm_products__h.gif";s:4:"4c3e";s:27:"icon_tx_minicrm_project.gif";s:4:"2e90";s:30:"icon_tx_minicrm_project__h.gif";s:4:"4d15";s:27:"icon_tx_minicrm_segment.gif";s:4:"9b10";s:30:"icon_tx_minicrm_segment__h.gif";s:4:"5221";s:26:"icon_tx_minicrm_status.gif";s:4:"80e3";s:29:"icon_tx_minicrm_status__h.gif";s:4:"880c";s:13:"locallang.xml";s:4:"1c23";s:16:"locallang_db.xml";s:4:"2132";s:7:"tca.php";s:4:"3f77";s:8:"todo.txt";s:4:"841a";s:14:"doc/manual.sxw";s:4:"d4c0";s:36:"mod1/class.tx_minicrm_customview.php";s:4:"a946";s:32:"mod1/class.tx_minicrm_export.php";s:4:"e82a";s:30:"mod1/class.tx_minicrm_list.php";s:4:"7f35";s:14:"mod1/clear.gif";s:4:"cc11";s:13:"mod1/conf.php";s:4:"49fc";s:14:"mod1/index.php";s:4:"7de1";s:18:"mod1/locallang.xml";s:4:"a8d2";s:22:"mod1/locallang_mod.xml";s:4:"ab64";s:19:"mod1/moduleicon.gif";s:4:"e08e";s:14:"pi1/ce_wiz.gif";s:4:"85b6";s:28:"pi1/class.tx_minicrm_pi1.php";s:4:"d471";s:36:"pi1/class.tx_minicrm_pi1_invoice.php";s:4:"7c47";s:33:"pi1/class.tx_minicrm_pi1_list.php";s:4:"d77b";s:36:"pi1/class.tx_minicrm_pi1_wizicon.php";s:4:"04ae";s:13:"pi1/clear.gif";s:4:"cc11";s:23:"pi1/flexform_ds_pi1.xml";s:4:"d6e8";s:17:"pi1/locallang.xml";s:4:"3f66";s:28:"lib/class.tx_minicrm_div.php";s:4:"01e7";s:39:"lib/class.tx_minicrm_dynamicmarkers.php";s:4:"d89f";s:32:"lib/class.tx_minicrm_markers.php";s:4:"bfff";s:25:"lib/user_minicrm_misc.php";s:4:"6373";s:29:"files/img/icon_addaccount.gif";s:4:"4b0f";s:22:"files/img/icon_csv.gif";s:4:"ddf9";s:22:"files/img/icon_gap.gif";s:4:"198c";s:22:"files/img/icon_xls.gif";s:4:"f031";s:34:"files/img/minicrm_print_footer.jpg";s:4:"94ce";s:34:"files/img/minicrm_print_header.jpg";s:4:"0e19";s:31:"files/static/main/constants.txt";s:4:"e0c2";s:27:"files/static/main/setup.txt";s:4:"4827";s:33:"files/templates/tmpl_invoice.html";s:4:"0d41";s:30:"files/templates/tmpl_list.html";s:4:"20dd";s:29:"files/css/minicrm_invoice.css";s:4:"9876";}',
	'suggests' => array(
	),
);

?>