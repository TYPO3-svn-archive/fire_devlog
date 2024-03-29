<?php

########################################################################
# Extension Manager/Repository config file for ext "fire_devlog".
#
# Auto generated 30-03-2011 12:28
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Fire DevLog',
	'description' => 'Writes the System DevLog into Firebug',
	'category' => 'misc',
	'shy' => 0,
	'version' => '1.2.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Marketing Factory TYPO3 dev Team',
	'author_email' => 'typo3@marketing-factory.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.3.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:11:{s:9:"ChangeLog";s:4:"9375";s:23:"class.tx_firedevlog.php";s:4:"1ec3";s:16:"ext_autoload.php";s:4:"f89d";s:21:"ext_conf_template.txt";s:4:"0c49";s:12:"ext_icon.gif";s:4:"9a17";s:17:"ext_localconf.php";s:4:"8c08";s:14:"doc/manual.sxw";s:4:"897c";s:19:"doc/wizard_form.dat";s:4:"8522";s:20:"doc/wizard_form.html";s:4:"0411";s:21:"lib/FirePHP.class.php";s:4:"48f5";s:10:"lib/fb.php";s:4:"818b";}',
	'suggests' => array(
	),
);

?>