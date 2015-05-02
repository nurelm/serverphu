<?php  /* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

/**
 * phuInstaller Class
 * 
 * Checks for installation, then installs the site
 * 
 * @category Bootstrap
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 */
class phuInstaller{
  public $install = false; /**< Set to true if site needs to be installed */
  public $error = 0; /**< set to non-zero if an error occurs */
  public $message = ''; /**< Message to show error if it occurs */
  public $console = ''; /**< Console to write progress in case error is emitted */
  
  /**
   * Constructs the installer object, checking to see if it is installed
   */  
  public function __construct(){
  
  }
}
