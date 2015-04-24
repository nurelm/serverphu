<?php

/**
 * @file
 * phuRouter Class
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
class phuRouter{
  public $uri = '/';    /**< Request URI to route the request */

  /**
   * Cosntructor
   *
   * @param string $uri Request URI for this request
   *
   */
  public function __construct($uri = '/'){
    $this->uri = $uri;
  }
 
  /**
   * Routes the request based o URI
   */
  public function process(){
    //Right now, this is hard coded to test
    if($this->uri == '/'){
      echo 'welcome home!';
    }
    elseif($this->uri == '/login/'){
      echo 'login';
    }
    else{
      echo '404';
    }
  }
}
