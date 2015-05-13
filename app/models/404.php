<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phu404Model Class
 * 
 * Model for not found page
 *
 * @category Data Abstraction
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phu404Model extends phuModel{
  
  public function __construct(){
    phuModel::__construct();
    $this->date = date('Y-m-d H:i:s');
    $this->header = '404 Not Found';
    $this->string = "404 Not Found\nDate: " . $this->date . "\n";
  }

}
