#
# Table structure for table 'tx_minicrm_account'
#
CREATE TABLE tx_minicrm_account (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	notes blob NOT NULL,
	address blob NOT NULL,
	contact blob NOT NULL,
	project blob NOT NULL,
	accounttype int(11) DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_accounttype'
#
CREATE TABLE tx_minicrm_accounttype (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_notes'
#
CREATE TABLE tx_minicrm_notes (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title text NOT NULL,
	description text NOT NULL,
	payment_behavior text NOT NULL,
	quality int(11) DEFAULT '0' NOT NULL,
	fussy tinyint(3) DEFAULT '0' NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable text NOT NULL,
	payment int(11) DEFAULT '0' NOT NULL,
	segment int(11) DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_payment'
#
CREATE TABLE tx_minicrm_payment (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_segment'
#
CREATE TABLE tx_minicrm_segment (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_project'
#
CREATE TABLE tx_minicrm_project (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	invoiceno tinytext NOT NULL,
	invoicedate int(11) DEFAULT '0' NOT NULL,
	startdate int(11) DEFAULT '0' NOT NULL,
	payed tinyint(3) DEFAULT '0' NOT NULL,
	status int(11) DEFAULT '0' NOT NULL,
	products blob NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable text NOT NULL,
	description text NOT NULL,
	mails blob NOT NULL,
	upload text,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_status'
#
CREATE TABLE tx_minicrm_status (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_products'
#
CREATE TABLE tx_minicrm_products (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	productnumber tinytext NOT NULL,
	price double(11,2) DEFAULT '0.00' NOT NULL,
	amount int(11) DEFAULT '0' NOT NULL,
	description text NOT NULL,
	description_intern text NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable text NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_minicrm_mails'
#
CREATE TABLE tx_minicrm_mails (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	kind int(11) DEFAULT '0' NOT NULL,
	date int(11) DEFAULT '0' NOT NULL,
	text text NOT NULL,
	parentid int(11) DEFAULT '0' NOT NULL,
	parenttable text NOT NULL,
	upload text,
	way int(11) DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tt_address'
#
CREATE TABLE tt_address (
	tx_minicrm_parentid int(11) DEFAULT '0' NOT NULL,
	tx_minicrm_parenttable text NOT NULL,
	title text NOT NULL,
);



#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	tx_minicrm_parentid int(11) DEFAULT '0' NOT NULL,
	tx_minicrm_parenttable text NOT NULL,
	tx_minicrm_firstname text NOT NULL,
	tx_minicrm_lastname text NOT NULL,
	tx_minicrm_mobile text NOT NULL,
	tx_minicrm_skype text NOT NULL,
	tx_minicrm_icq text NOT NULL,
	tx_minicrm_position int(11) DEFAULT '0' NOT NULL,
);