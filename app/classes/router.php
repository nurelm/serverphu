<?php  /* vim: set autoindent expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

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
  
  public $uri;      /**< Request URI to route the request */
  public $path;     /**< URI Exploded to components */
  public $token;    /**< Token processed from $_COOKIE */
  public $post;     /**< POST Request processed from bootstrap */
  public $files;    /**< FILES array processed from bootstrap */
  public $get;      /**< GET Request processed from bootstrap */

  /** 
   * Valid routes for this controller 
   *
   * This maps the routes (key) to the controller (value)
   */
  public $routes = array(
    '' => 'Home',
    'login' => 'Login',
    'logout' => 'Logout',
  );


  /**
   * Cosntructor
   *
   * @param string $uri Request URI for this request
   *
   */
  public function __construct($uri = '/', $token = '', $post = array(), $files = array(), $get = array()){
    $this->uri = $uri;
    $this->path = explode('/', $uri);
    $this->token = $token;
    $this->post = $post;
    $this->files = $files;
    $this->get = $get;
  }
 
  /**
   * Routes the request based o URI
   */
  public function process(){
    //See if array includes the class and the class exists
    if (array_key_exists($this->path[1],$this->routes) && class_exists('phu' . $this->routes["{$this->path[1]}"] . 'Controller', false)){
      $name = 'phu' . $this->routes["{$this->path[1]}"] . 'Controller';
      $controller = new $name($this->path);
    }
    else{
      $controller = new phu404Controller($this->path, $this->token, $this->post, $this->files, $this->get);
    }

    //The controller is doing stuff
    $controller->process();
  }
}
