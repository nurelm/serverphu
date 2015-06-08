<?php

/**
 * @file
 * Commandline script to test HTTP statuses
 *
 * @category   Testing
 * @package    Serverphu
 * @author     Michael Sypolt <msypolt@transitguru.limited>
 * @copyright  Copyright (c) 2015
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 * @version    @package_version
 */

// DRAFT CURL CLASS
class phuCurl{

  public $url; /**< URL to send the request */
  public $post_body; /**< Post body to send to a server */
  public $method; /**< HTTP Method to send */
  public $curl; /**< cURL handle keeping track of this */
  public $status; /**< stores the HTTP status from cURL response */
  public $headers; /**< stores the headers from the cURL response */
  public $response; /**< stores the raw response body */
  public $response_object; /**< response in object form, if available */
  public $options; /**< stores the cURL options */

  /**
   * Constructor
   *
   * @param string $url Url to send
   * @param string $method HTTP method
   * @param array $data Data to pack and send to the server
   * @param array $headers Headers to send with your request
   */
  public function __construct($url, $method='GET', $data='', $headers = array('Content-Type: text/plain')){
    if(is_null($data)){
      $this->post_body = '';
    }
    elseif(is_array($data)){
      $this->post_body = json_encode($data, JSON_UNESCAPED_SLASHES);
    }
    else{
      $this->post_body = $data;
    }
    if(is_null($url)){
      $this->url = "http://transitguru.limited/";
    }
    $this->status = 0;
    $this->method = $method;
    $this->url = $url;
    $this-> options = array(
      CURLOPT_POST => true,
      CURLOPT_URL => $this->url,
      CURLOPT_USERAGENT => 'Serverphu',
      CURLOPT_POSTFIELDS => $this->post_body,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_CUSTOMREQUEST => $this->method,
    );
    $this->curl = curl_init();
  }

  /**
   * Sends the request to the remote server
   */
  public function send(){
    ob_start();
    curl_setopt_array($this->curl, $this->options);
    $success = curl_exec($this->curl);
    if ($success){
      $this->headers = curl_getinfo($this->curl);
      $this->status = $this->headers['http_code'];
      $this->response = ob_get_clean();
      curl_close($this->curl);
    }
    else{
      $this->status = -99;
    }
  }

  /**
   *
   */
  public function unpack(){
    if ($this->headers['content_type'] == 'application/json' && $this->status > 0){
      $this->response_object = json_decode($this->response);
    }
    else{
      $this->response_object = null;
    }
  }
}
// END DRAFT CURL CLASS

// Collect commandline arguments
if (!isset($_SERVER['argv']) || count($_SERVER['argv']) == 1){
  echo "Please include a filename containing a URL list\n";
  exit(1);
}
elseif(isset($_SERVER['argv'][1])){
  $file = $_SERVER['argv'][1];
  if (!is_file($file)){
    echo "'{$file}' is not readable, exiting...\n";
    exit(2);
  }
  $json = file_get_contents($file);
  $sites = json_decode($json);
  if(is_array($sites)){
    foreach ($sites as $i => $site){
      //set defaults
      $url = '';
      $data = '';
      $method = 'GET';
      $headers = array('Content-Type: text/html');
      if(isset($site->method)){
        $method = $site->method;
      }
      if(isset($site->url)){
        $url = $site->url;
      }
      if(isset($site->data)){
        $data = $site->data;
      }
      if(isset($site->headers) && is_array($site->headers) && count($site->headers)>0){
        $headers = $site->headers;
      }

      // Make curl request
      $curl = new phuCurl($url, $method, $data, $headers);
      $curl->send();
      echo "{$curl->status} {$curl->method} {$curl->url}";
      if ($curl->status >= 300 && $curl->status <= 399){
        echo " ------------> ";
        if (isset($curl->headers['redirect_url'])){
          echo $curl->headers['redirect_url'];
        }
      }
      echo "\n";
    }
  }
  else{
    echo "The file is improperly formed\n";
    exit(9);
  }

}
else{
  echo "Something bad happened...\n";
  exit(3);
}
