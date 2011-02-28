<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Marketing Factory TYPO3 dev Team <typo3@marketing-factory.de> 
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
 
 
if (!class_exists('FirePHP')) {
	require_once(t3lib_extMgm::extPath('fire_devlog').'lib/FirePHP.class.php');
	require_once(t3lib_extMgm::extPath('fire_devlog').'lib/fb.php');
}

/**
 * Fire-Devlog main class
 *
 * @package TYPO3
 * @subpackage fire_devlog
 */
class tx_firedevlog {

	/**
	 * Prepares log event
	 * 
	 * @param	array	$logArr: 
	 * @return	void
	 */
	function devLog($logArr) {

			// Check the config
		$staticConf = unserialize ($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['fire_devlog']);
		if (!is_array($staticConf)) {
			return;
		}
		$enableBELogging = $staticConf['enableBELogging'];
		$ipRange = $staticConf['iprange'];
		
			// Logging only if BE User is logged in?
		if ($enableBELogging && !$GLOBALS['BE_USER']->user) {
			return;
		}

			// Logging only for an IP Range?
		if ('' != $ipRange) {
			if (!t3lib_div::cmpIP(t3lib_div::getIndpEnv('REMOTE_ADDR'), trim($ipRange))) {
				return;
			}
		}
		
			// Holds the severity information
		$severity = array (
			'0'  => FirePHP::LOG,
			'1'  => FirePHP::INFO,
			'2'  => FirePHP::WARN,
			'3'  => FirePHP::ERROR,
			'-1' => FirePHP::INFO,
		);	
		
		fb(date('d.m.Y H:i:s') . ' by ' . $logArr['extKey'] . ': ' . $logArr['msg'], $severity[$logArr['severity']]);
		if (!empty($logArr['dataVar'])) {
			fb($this->getPrintable ($logArr['dataVar']) . chr(10));
		}
	}
	
	/**
	 * Returns a suitable form of a variable (be it a string, array, object ...) for logfile output
	 * 
	 * @param	mixed	$var: The variable
	 * @param	integer	$spaces: Number of spaces to add before a line
	 * @return	string	text output
	 */
	function getPrintable($var, $spaces = 4) {
		if ($spaces > 100) {
			return;
		}
		$out = '';
		if (is_array ($var)) {
			foreach ($var as $k=>$v) {
				if (is_array ($v)) {
					$out .= str_repeat(' ', $spaces) . $k . ' => array (' . LF . $this->getPrintable($v, $spaces + 3) . str_repeat (' ', $spaces) . ')' . LF;
				} else {
					if (is_object($v)) {
						$out .= str_repeat(' ', $spaces) . $k . ' => object: ' . get_class($v) . LF;
					} else {
						$out .= str_repeat(' ', $spaces) . $k . ' => ' . $v . LF;
					}
				}
			}
			return $out;
		} else {
			if (is_object($var)) {
				$out .= str_repeat(' ', $spaces) . ' [ OBJECT: ' . strtoupper(get_class($var)) . ' ]:' . LF;
				if (is_array(get_object_vars($var))) {
					foreach (get_object_vars($var) as $objVarName => $objVarValue) {
						if (is_array($objVarValue) || is_object($objVarValue)) {
							$out .= str_repeat(' ', $spaces) . $objVarName . ' => ' . LF;
							$out .= $this->getPrintable($objVarValue, $spaces + 3);
						} else {
							$out .= str_repeat(' ', $spaces) . $objVarName . ' => ' .$objVarValue . LF;
						}	
					}	
				}
				$out .= LF;
			} else {
				$out .= str_repeat(' ', $spaces) . '=> ' . $var . LF;
			}
			return $out;
		}
	}
}
?>
