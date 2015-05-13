<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phu404Controller Class
 * 
 * Controls not found page
 *
 * @category Request Handling
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phu404Controller extends phuController{
  public function process(){
    phuController::process();
    $model = new phu404Model();
    $view = new phu404View($model, $this->ajax);
    $view->render();
  }
}
