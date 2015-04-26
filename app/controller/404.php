<?php

/**
 * @file
 * phu404 Class
 * 
 * Determines routing for all requests
 * TODO add in some permissions and such
 *
 * @category Request Handling
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phu404{
  /**
   * Constructor
   *
   * @param string $uri Request URI for this request
   *
   */
  public function __construct($uri = '/'){
    echo '404 (not found)';
  }
 
}

