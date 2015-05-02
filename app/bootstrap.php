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

// These variables are used to remove reliance on superglobals
$uri = '/';         /**< Request URI */
$post = array();    /**< Information from POST  */
$get = array();     /**< Information GET */
$files = array();   /**< Information from FILES (only when used in webserver) */
$session = array(); /**< Information from User's SESSION */

// Collect globals (see if it is a web, or commandline)
if (isset($_SERVER) && isset($_SERVER['REQUEST_URI'])){
  $uri = $_SERVER['REQUEST_URI'];          /**< Request URI */
  if (isset($_POST)){
    $post = $_POST;
  }
  if (isset($_GET)){
    $get = $_GET;
  }
  if (isset($_FILES)){
    $files = $_FILES;
  }
  if (isset($_SESSION)){
    $session = $_SESSION;
  }
}
elseif (isset($_SERVER['argv'][1])){
  $string = $_SERVER['argv'][1];
  if (strpos($string, '?') !== false){
    $uri = strstr($string, '?', true);
    $query = substr(strstr($string, '?', false),1);
    parse_str($query, $get);
  }
  else{
    $uri = $string;
  }
  if (isset($_SERVER['argv'][2])){
    parse_str($_SERVER['argv'][2], $post);
  }
}
echo "<pre>\n";
echo $uri . "\n";
echo "\nPOST ... \n";
var_dump($post);
echo "\nGET ... \n";
var_dump($get);
echo "\n</pre>";

$router = new phuRouter($uri);
$router->process();

