<?php  /* vim: set autoindent expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

/**
 * @file
 * phuLogoutController Class
 * 
 * Controlls logout events
 *
 * @category Request Handling
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuLogoutController extends phuController{
  /**
   * Constructor
   *
   * @param string $uri Request URI for this request
   *
   */
  public function __construct($uri = '/'){
    echo 'See you soon.';
  }
 
}
