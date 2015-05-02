<?php  /* vim: set autoindent expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

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

// Collect globals (see if it is a web, or commandline)
if (isset($_SERVER) && isset($_SERVER['REQUEST_URI'])){
  $uri = $_SERVER['REQUEST_URI'];          /**< Request URI */
}
elseif (isset($_SERVER['argv'][1])){
  $uri = $_SERVER['argv'][1];
}
else{
  $uri = '/';
}

// Load the settings files
require_once (DOC_ROOT . '/app/settings.php');

// Load the master classes
$PATH = DOC_ROOT . '/app/classes';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

// Load all models
$PATH = DOC_ROOT . '/app/models';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

// Load all the controllers
$PATH = DOC_ROOT . '/app/controllers';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

// Load all views
$PATH = DOC_ROOT . '/app/views';
$includes = scandir($PATH);
foreach ($includes as $include){
  if (is_file($PATH . '/' . $include) && $include != '.' && $include != '..' && fnmatch("*.php", $include)){
    require_once ($PATH . '/' . $include);
  }
}

$router = new phuRouter($uri);
$router->process();

