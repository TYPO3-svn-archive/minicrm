<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_account=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_accounttype=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_payment=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_project=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_status=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_products=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_minicrm_segment=1
');
t3lib_extMgm::addPageTSConfig('

	# ***************************************************************************************
	# CONFIGURATION of RTE in table "tx_minicrm_mails", field "text"
	# ***************************************************************************************
RTE.config.tx_minicrm_mails.text {
  hidePStyleItems = H1, H4, H5, H6
  proc.exitHTMLparser_db=1
  proc.exitHTMLparser_db {
    keepNonMatchedTags=1
    tags.font.allowedAttribs= color
    tags.font.rmTagIfNoAttrib = 1
    tags.font.nesting = global
  }
}
');

#t3lib_extMgm::addPItoST43($_EXTKEY,'pi1/class.tx_minicrm_pi1.php','_pi1','list_type',1);
?>