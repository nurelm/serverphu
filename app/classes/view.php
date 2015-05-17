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
  public $ajax;    /**< Boolean to determine if we are using AJAX */

  /**
   * Constructor
   *
   * @param phuModel $model Model used for the view
   * @param int $ajax Set to 1 is ajax is used
   */
  public function __construct($model, $ajax){
    $this->model = $model;
    $this->ajax = $ajax;
  }

  /**
   * Render the view
   */
  public function render(){
    if (isset($this->ajax) && $this->ajax == 1){
      // Only show the string
      echo $this->model->string;
    }
    else{
      // Load the page
      echo "<!DOCTYPE html>\n";
      echo "<html>\n";
      echo "  <head>\n";
      echo "    <!-- Loading Meta Tags -->\n";
      echo "    <meta charset=\"utf-8\" />\n";
      echo "    <title>{$this->model->title}</title>\n";
      echo "    <!-- Loading Scripts -->\n";
      $this->loadJS();
      echo "    <!-- Loading Stylesheets -->\n";
      $this->loadCSS();
      echo "  </head>\n";
      echo "  <body>\n";
      echo $this->model->string;
      echo "\n  </body>\n";
      echo "</html>\n";
    }
  }

  /**
   * Load the javascripts
   */
  protected function loadJS(){
    $DIR = DOC_ROOT . '/app/js';
    $files = scandir($DIR);
    if (is_array($files) && count($files)>2){
      foreach($files as $file){
        if($file !== '.' && $file !== '..' && is_file($DIR . '/' . $file) && fnmatch('*.js', $file)){
          echo "    <script type=\"application/javascript\" src=\"/js/{$file}\"></script>\n";
        }
      }
    }
  }

  /**
   * Load the stylesheets
   */
  protected function loadCSS(){
    $DIR = DOC_ROOT . '/app/css';
    $files = scandir($DIR);
    if (is_array($files) && count($files)>2){
      foreach($files as $file){
        if($files !== '.' && $file !== '..' && is_file($DIR . '/' . $file) && fnmatch('*.css', $file)){
          echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/{$file}\" />\n";
        }
      }
    }
  }
}

