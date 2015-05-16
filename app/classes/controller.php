<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuController
 *
 * Blueprint for a controller
 *
 * @category Request Handling
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuController{
  public $model;  /**< Model that will be processed by the controller */
  public $view;   /**< View that the controller will use */
  public $ajax;   /**< Boolean to indicate if we are using ajax or not */
  public $path;   /**< Path array to route requests within the application */
  public $token;  /**< user token for session management */
  public $post;   /**< User post data */
  public $files;  /**< uploaded files */
  public $get;    /**< GET array from URL */
  public $name;   /**< Name of model and view to handle */

  /**
   * Constructor
   *
   * @param array $path URI Path information
   * @param string $token User token
   * @param array $post User POST Data
   * @param array $file Uploaded FILES
   * @param array $get User GET informationi
   * @param string $name Name of model and view to handle
   */
  public function __construct($path, $token = '', $post = array(), $files = array(), $get = array(), $name = ''){
    $this->path = $path;
    $this->token = $token;
    $this->post = $post;
    $this->files = $files;
    $this->get = $get;
    $this->name = $name;
  }

  /**
   * Process the controller (this is almost always extended :) )
   */
  public function process(){
    // Check to see if we are wrapping this in template
    if (isset($this->post['ajax']) && $this->post['ajax'] == 1){
      $this->ajax = true;
    }
    else{
      $this->ajax = false;
    }
    $classname = 'phu' . $this->name . 'Model';
    if(class_exists($classname, false)){
      $this->model = new $classname($this->ajax);
    }
    else{
      $this->model = new phuModel($this->ajax);
    }
  }

  /**
   * Get and render the view (We doubt that this call is extended that much)
   */
  public function render(){
    $classname = 'phu' . $this->name . 'View';
    if(class_exists($classname, false)){
      $this->view = new $classname($this->model, $this->ajax);
    }
    else{
      $this->view = new phuView($this->model, $this->ajax);
    }
    $this->view->render();
  }
}

