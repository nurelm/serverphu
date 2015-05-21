<?php

/**
 * @file
 * phuFileView Class
 * 
 * Create view for file loading
 *
 * @category Rendering
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuFileView extends phuView{
  /**
   * Render the view
   */
  public function render(){
    $this->sendHeaders();
    echo $this->model->string;
  }
}
