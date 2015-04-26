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
  /** Request URI to route the request */
  public $uri = '/';
  
  /** 
   * Valid routes for this controller 
   *
   * This maps the routes (key) to the controller (value)
   */
  public $routes = array(
    '/' => 'Home',
    '/login/' => 'Login',
    '/logout/' => 'Logout',
  );


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
    //See if array includes the class and the class exists
    if (array_key_exists($this->uri,$this->routes) && class_exists('phu' . $this->routes[$this->uri], false)){
      $name = 'phu' . $this->routes[$this->uri];
      $controller = new $name();
    }
    else{
      $controller = new phu404();
    }
  }
}
