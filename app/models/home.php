<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuHomeModel Class
 * 
 * Model for home page
 *
 * @category Data Abstraction
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuHomeModel extends phuModel{

  /**
   * Constructor
   */
  public function __construct(){
    phuModel::__construct();
    $this->date = date('Y-m-d H:i:s');
    $this->test = 'Michael Sypolt';
    $this->string = $this->date . "\n" . $this->test . "\n";
  }

}
