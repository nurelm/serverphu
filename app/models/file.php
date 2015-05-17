<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuFileModel Class
 * 
 * Model for file requests
 *
 * @category Data Abstraction
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuFileModel extends phuModel{

  /**
   * Constructor
   */
  public function __construct($ajax){
    phuModel::__construct($ajax);
  }

  /**
   * Get the files
   *
   * @param array $path Array of path data
   *
   */
  public function getFile($path){
    if (isset($path) && isset($path[1]) && $path[1] == 'js' && isset($path[2]) && fnmatch('*.js', $path[2]) && is_file(DOC_ROOT . '/app/js/' . $path[2])){
      $this->httpstatus = 200;
      $filename = DOC_ROOT . '/app/js/' . $path[2];
      $this->string = file_get_contents($filename);
    }
    elseif (isset($path) && isset($path[1]) && $path[1] == 'css' && isset($path[2]) && fnmatch('*.css', $path[2]) && is_file(DOC_ROOT . '/app/css/' . $path[2])){
      $this->httpstatus = 200;
      $filename = DOC_ROOT . '/app/css/' . $path[2];
      $this->string = file_get_contents($filename);
    }
    elseif (isset($path) && isset($path[1]) && $path[1] == 'file' && isset($path[2]) && is_file(DOC_ROOT . '/files/' . $path[2])){
      $this->httpstatus = 200;
      $filename = DOC_ROOT . '/files/' . $path[2];
      $this->string = file_get_contents($filename);
    }
  }
}
