<?php  /* vim: set autoindent expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

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

  /**
   * Constructor
   *
   * @param array $path URI Path information
   * @param string $token User token
   * @param array $post User POST Data
   * @param array $file Uploaded FILES
   * @param array $get User GET information
   */
  public function __construct($path, $token = '', $post = array(), $files = array(), $get = array()){
    $this->path = $path;
    $this->token = $token;
    $this->post = $post;
    $this->files = $files;
    $this->get = $get;
  }

  /**
   * Process the controller
   */
  public function process(){

  }
}

