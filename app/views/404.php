<?php  /* vim: set autoindent expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

/**
 * @file
 * phu404View Class
 * 
 * Create view for not found page
 *
 * @category Rendering
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phu404View extends phuView{
  public function render(){
    echo $this->model->string;
  }
}
