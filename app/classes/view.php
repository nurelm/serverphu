<?php

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
    $this->sendHeaders();
    if (isset($this->ajax) && $this->ajax == 1){
      // Only show the string
      echo $this->model->string;
    }
    else{
      // Load the page
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Loading Meta Tags -->
    <meta charset="utf-8" />
    <title><?php echo $this->model->title; ?></title>
    <!-- Loading Scripts -->
<?php echo $this->loadJS(); ?>
    <!-- Loading Stylesheets -->
<?php echo $this->loadCSS(); ?>
  </head>
  <body>
<?php echo $this->model->string; ?>
  </body>
</html>
<?php
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

  /**
   * Send the headers
   */
  protected function sendHeaders(){
    if (is_array($this->model->headers) && count($this->model->headers)>0){
      foreach($this->model->headers as $header){
        header($header[0], $header[1], $this->model->httpstatus);
      }
    }
  }
}

