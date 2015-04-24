<?php

/**
 * @file
 * Bootstrap file for Serverphu
 *
 * This bootstraps the entire application and will provide a means to 
 * access all available modules.
 *
 * @category   Bootstrap
 * @package    Serverphu
 * @author     Michael Sypolt <msypolt@transitguru.limited>
 * @copyright  Copyright (c) 2015
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 * @version    @package_version@
 */

// Collect globals
if (isset($_SERVER) && isset($_SERVER['REQUEST_URI'])){
  $uri = $_SERVER['REQUEST_URI'];          /**< Request URI */
}
else{
  $uri = '/';
}
// Load the settings file
require_once (DOC_ROOT . '/app/settings.php');

// Load all models
$PATH = DOC_ROOT . '/app/model';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

// Load all views
$PATH = DOC_ROOT . '/app/view';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

// Load all the controllers
$PATH = DOC_ROOT . '/app/controller';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

// This will do more stuff later!
echo "Loaded successfully!\n";

