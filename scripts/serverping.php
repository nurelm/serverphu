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
  if(is_object($sites) && is_array($sites->list)){
    // Look for IP list, just to check things
    $ips = array();
    if (is_object($sites->ip)){
      foreach($sites->ip as $server => $list){
        if(is_array($list) && count($list)>0){
          foreach($list as $i => $ip){
            $ips[$ip] = "{$server}_{$i}";
          }
        }
      }
    }

    $email = false;
    $message = $log = '';

    // Go through the list!
    foreach ($sites->list as $i => $site){
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
      if (isset($curl->headers['primary_ip'])){
        $ip = str_pad($curl->headers['primary_ip'], 15, ' ');
      }
      else{
        $ip = str_pad('', 15, ' ');
      }
      $count = 0;
      $redirect_string = '';
      while ($curl->status >= 300 && $curl->status <= 399 && $count < 30){
        $count ++;
        if (isset($curl->headers['redirect_url'])){
          $newurl = $curl->headers['redirect_url'];
          $curl = new phuCurl($newurl, $method, $data, $headers);
          $curl->send();
          if (isset($curl->headers['primary_ip'])){
            $newip = str_pad($curl->headers['primary_ip'], 15, ' ');
          }
          else{
            $newip = str_pad('', 15, ' ');
          }
          $redirect_string = " --redirect {$count}x--> {$newurl} at [{$newip}]";
        }
      }
      if (!array_key_exists(trim($ip), $ips)){
        $no = 'no';
      }
      else{
        $no = "  ";
      }
      if (isset($site->statuses) && is_array($site->statuses) && !in_array($curl->status, $site->statuses)){
        $email = true;
        $list = implode(',',$site->statuses);
        $message .= "{$curl->status} {$curl->url} (expected {$list})\n";
      }

      $log .= "{$no} {$curl->status}  {$ip}  {$curl->method} {$url} {$redirect_string}\n";
    }
    if($email == true && is_object($sites->config) && $sites->config->send == true){
      echo "I am emailing this!!!";
      $headers = "From: {$sites->config->emailfrom}\r\nReply-To: {$sites->config->emailfrom}\r\n";
      $to = $sites->config->emailto;
      if (isset($sites->config->emailcc) && trim($sites->config->emailcc != '')){
        $headers .= "Cc: {$sites->config->emailcc}";
      }
      if (isset($sites->config->emailbcc)){
        $headers .= "Bcc: {$sites->config->emailcc}";
      }
      $subject = $sites->config->emailsubject;
      $headers .= "\r\nContent-Type: text/plain\r\n";
      //$message .= "\n\nFull Log:\n\n{$log}\n";
      $mail_sent = @mail($to, $subject, $message, $headers);
    }
    echo $log;
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
