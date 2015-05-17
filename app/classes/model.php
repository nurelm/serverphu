<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuModel 
 *
 * Blueprint for a model 
 *
 * @category Data abstraction
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuModel{
  public $string = 'Page Not Found';    /**< String Representation of the model */
  public $ajax = false;                 /**< Whether we are using ajax or not */
  public $title = 'Serverphu';          /**< String to put in the title tags */
  public function __construct($ajax){
    $this->ajax = $ajax;
  }
}

