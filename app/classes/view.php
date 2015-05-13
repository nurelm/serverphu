<?php  /* vim: set ai et ts=2 sw=2 sts=2: */

/**
 * @file
 * phuView 
 *
 * Blueprint for a view
 *
 * @category Formatting
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuView{
  public $model;   /**< phuModel that the view is being used for */
  public $string;  /**< string that would be output */
  public $ajax;    /**< Boolean to determine if we are using AJAX */

  /**
   * Constructor
   *
   * @param phuModel $model Model used for the view
   * @param int $ajax Set to 1 is ajax is used
   */
  public function __construct($model, $ajax){
    $this->model = $model;
    if (isset($model->string)){
      $this->string = $this->model->string;
    }
    $this->ajax = $ajax;
  }

  /**
   * Render the view
   */
  public function render(){
    if (isset($this->ajax) && $this->ajax == 1){
      echo $this->string;
    }
    else{
      echo "<html>\n";
      echo $this->string;
      echo "\n</html>\n";
    }
  }
}

