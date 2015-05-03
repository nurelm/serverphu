<?php  /* vim: set autoindent expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

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
    $model = new phuHomeModel();
    $view = new phuHomeView($model);
    $view->render();
  }
}
