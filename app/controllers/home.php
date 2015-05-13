<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuHomeController Class
 * 
 * Controls home page
 *
 * @category Request Handling
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuHomeController extends phuController{
  public function process(){
    phuController::process();
    $model = new phuHomeModel();
    $view = new phuHomeView($model, $this->ajax);
    $view->render();
  }
}
