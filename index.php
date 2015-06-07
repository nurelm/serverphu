<?php

/**
 * @file
 * Calls the bootstrap file for the Serverphu ticketing system
 *
 * This calls the bootstrap file, which would load appropriate themes, classes,
 * and modules.
 *
 * LICENSE: All code is Copyright 2012 - 2015 by Michael Sypolt of 
 * TransitGuru Limited <msypolt@transitguru.limited>.
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or (at
 * your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program as the file LICENSE.txt; if not, please see
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 * 
 *
 * @category   Bootstrap
 * @package    Serverphu
 * @author     Michael Sypolt <msypolt@transitguru.limited>
 * @copyright  Copyright (c) 2015
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 * @version    alpha
 */

// Load the bootstrap file, nothing more, nothing less!
define('DOC_ROOT', getcwd());
require_once(DOC_ROOT . '/app/bootstrap.php');

