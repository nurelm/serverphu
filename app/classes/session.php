<?php

/**
 * @file
 * phuSession Class
 *
 * Contains and processes user information for authentication
 *
 * @category Authentication
 * @package Serverphu
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * @copyright Copyright (c) 2015
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version Release: @package_version@
 *
 */
class phuSession{
  public $id;              /**< Session ID */
  public $user;            /**< User data in an associative array */
  public $company;         /**< Company information in an associative array */
  public $expire = 60*60;  /**< Number of seconds to expire a session */
  public $data;            /**< Session data */

  /**
   * Recalls a session using the token
   *
   * @param string $token Token from cookie to identify user's session
   */
  public function __construct($token = '0'){
    //I don't know what to do yet
  }
}
