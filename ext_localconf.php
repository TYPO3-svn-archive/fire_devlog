<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");


require_once(t3lib_extMgm::extPath('fire_devlog').'class.tx_firedevlog.php');

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_div.php']['devLog'][$_EXTKEY] = 'EXT:'.$_EXTKEY.'/class.tx_firedevlog.php:tx_firedevlog->devLog';

?>
