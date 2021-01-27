#!/usr/bin/php -q
<?php
/**
 * Command-line code generation utility to automate programmer chores.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Console
 * @since         CakePHP(tm) v 2.0
 */

// if (!defined('$ds')) {
// 	define('$ds', DIRECTORY_SEPARATOR);
// }
$ds = DIRECTORY_SEPARATOR;
$dispatcher = 'Cake' . $ds . 'Console' . $ds . 'ShellDispatcher.php';

if (function_exists('ini_set')) {
	$root = dirname(dirname(dirname(__FILE__)));
	$appDir = basename(dirname(dirname(__FILE__)));
	$install = $root . $ds . 'lib';
	$composerInstall = $root . $ds . $appDir . $ds . 'Vendor' . $ds . 'cakephp' . $ds . 'cakephp' . $ds . 'lib';

	// the following lines differ from its sibling
	// /app/Console/cake.php
	if (file_exists($composerInstall . $ds . $dispatcher)) {
		$install = $composerInstall;
	} elseif (!file_exists($install . $ds . $dispatcher)) {
		$install = $root . PATH_SEPARATOR .  $ds . 'var' . $ds . 'www' . $ds . 'html' . $ds . 'Vendor' . $ds . 'cakephp' . $ds . 'cakephp' . $ds . 'lib';
	}

	ini_set('include_path', $install . PATH_SEPARATOR . ini_get('include_path'));
	unset($root, $appDir, $install, $composerInstall);
}

if (!include $dispatcher) {
	trigger_error('Could not locate CakePHP core files.', E_USER_ERROR);
}
unset($dispatcher);

return ShellDispatcher::run($argv);


