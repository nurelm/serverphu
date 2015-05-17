<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

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
    'js' => 'Js',
    'css' => 'Css',
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
    if (array_key_exists($this->path[1],$this->routes)){
      $name = $this->routes["{$this->path[1]}"];
      $classname = 'phu' . $name . 'Controller';
      if(class_exists($classname, false)){
        $controller = new $classname($this->path, $this->token, $this->post, $this->files, $this->get, $name);
      }
      else{
        $controller = new phuController($this->path, $this->token, $this->post, $this->files, $this->get, '');
      }
    }
    else{
      $controller = new phuController($this->path, $this->token, $this->post, $this->files, $this->get, '');
    }

    //The controller is doing stuff
    $controller->process();
    $controller->render();
  }
}
