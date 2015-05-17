<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuCxsController Class
 * 
 * Controls css file requests
 *
 * @category Request Handling
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuCssController extends phuController{
  public function process(){
    phuController::process();
    $this->model->getCss($this->path);
  }
}
