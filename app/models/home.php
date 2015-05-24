<?php

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
  public function __construct($ajax){
    phuModel::__construct($ajax);
    $this->httpstatus = 200;
    $this->date = date('Y-m-d H:i:s');
    $this->test = 'Michael Sypolt';
    if ($ajax == 1){
      $this->headers[] = array('Content-Type: text/json', true);
      $vars_to_send = array($this->date, $this->test, $this->httpstatus, $this->headers);
      $this->string = json_encode($vars_to_send);
    }
    else{
      $this->string = $this->date . " " . $this->test;
    }
  }

}
