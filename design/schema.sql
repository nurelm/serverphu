/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

/**
 * @file
 * @author Michael Sypolt <msypolt@transitguru.limited>
 * 
 * Core database set up for empty tables in pm tool
 */


-- -----------------------------------------------------
-- Table `roles` 
-- -----------------------------------------------------

DROP TABLE IF EXISTS `roles` ;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary identifier for a role',
  `sortorder` INT(11) NOT NULL DEFAULT 0 COMMENT 'Allows a site admin to sort roles',
  `name`  VARCHAR(255) NOT NULL COMMENT 'Human readable name for a role',
  `created` DATETIME NOT NULL COMMENT 'Date created',
  `desc` TEXT NULL COMMENT 'Optional additional information about the role',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name` ASC)
)
ENGINE = InnoDB COMMENT = 'Basic user roles';


-- -----------------------------------------------------
-- Table `groups` 
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groups` ;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary identifier for a group' ,
  `parent_id` INT(11) UNSIGNED DEFAULT NULL COMMENT 'Parent for a group, NULL means at root level' ,
  `sortorder` INT(11) NOT NULL DEFAULT 0 COMMENT 'Allows a site admin to sort groups',
  `name` VARCHAR(100) NOT NULL COMMENT 'Human readable name for a group',
  `created` DATETIME NOT NULL COMMENT 'Date created',
  `desc` TEXT COMMENT 'Optional additional information about the group',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`parent_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  UNIQUE KEY (`name` ASC)
) ENGINE=InnoDB COMMENT = 'User groups (in a hierarchical tree)';


-- -----------------------------------------------------
-- Table `users` 
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary identifier for the user',
  `login` VARCHAR(40) NOT NULL COMMENT 'Username for logging in the website',
  `firstname` VARCHAR(100) NOT NULL COMMENT 'First name',
  `lastname` VARCHAR(100) NOT NULL COMMENT 'Surname',
  `email` VARCHAR(255) NOT NULL COMMENT 'Email address',
  `created` DATETIME NOT NULL COMMENT 'Date created',
  `desc`  TEXT NULL  COMMENT 'Optional additional information about the user',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`login`),
  UNIQUE KEY (`email`)
)
ENGINE = InnoDB COMMENT = 'User information for authenticated users';

-- -----------------------------------------------------
-- Table `user_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_groups` ;

CREATE TABLE IF NOT EXISTS `user_groups` (
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT 'Reference to users.id',
  `group_id` INT(11) UNSIGNED NOT NULL COMMENT 'Reference to groups.id',
  PRIMARY KEY (`group_id`, `user_id`) ,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB COMMENT = 'Adds users to group membership';


-- -----------------------------------------------------
-- Table `user_roles` 
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_roles` ;

CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT 'Reference to users.id',
  `role_id` INT(11) UNSIGNED NOT NULL COMMENT 'Reference to roles.id',
  PRIMARY KEY (`role_id`, `user_id`) ,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB COMMENT = 'Adds users to roles';


-- -----------------------------------------------------
-- Table `passwords` 
-- -----------------------------------------------------
DROP TABLE IF EXISTS `passwords` ;

CREATE TABLE IF NOT EXISTS `passwords` (
  `user_id`  INT(11) UNSIGNED NOT NULL COMMENT 'Reference to users.id',
  `valid_date` DATETIME NOT NULL COMMENT 'Valid date for this password',
  `expire_date` DATETIME NULL COMMENT 'Expiration date for this password',
  `reset_date` DATETIME NULL COMMENT 'Expiration date for this reset code',
  `reset_code` VARCHAR(255) NULL COMMENT 'Reset code that would be used in a URL for a user to reset the password',
  `hashed` VARCHAR(255) NOT NULL COMMENT 'Hashed password',
  PRIMARY KEY (`user_id`, `valid_date`) ,
  FOREIGN KEY (`user_id` ) REFERENCES `users` (`id` ) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB COMMENT = 'User hashed passwords';

-- -----------------------------------------------------
-- Table `companies` 
-- -----------------------------------------------------
DROP TABLE IF EXISTS `companies` ;

CREATE TABLE IF NOT EXISTS `companies` (
  `id`  INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for company',
  `name` VARCHAR(255) NOT NULL COMMENT 'Name of company',
  `contact` VARCHAR(255) NULL COMMENT 'Primary contact for company',
  `addr1` VARCHAR(255) NULL COMMENT 'Address line 1',
  `addr2` VARCHAR(255) NULL COMMENT 'Address line 2',
  `city` VARCHAR(255) NULL COMMENT 'City',
  `state` VARCHAR(255) NULL COMMENT 'State or province',
  `nation` VARCHAR(255) NULL COMMENT 'Nation',
  `postal` VARCHAR(12) NULL COMMMENT 'Postal code or ZIP code',
  `desc`  TEXT NULL  COMMENT 'Additional information about the company',
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX (`hostname` ASC),
  UNIQUE INDEX (`id_address` ASC)
)
ENGINE = InnoDB COMMENT = 'Servers being managed in the system';

-- -----------------------------------------------------
-- Table `servers` 
-- -----------------------------------------------------
DROP TABLE IF EXISTS `servers` ;

CREATE TABLE IF NOT EXISTS `servers` (
  `id`  INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier to server',
  `hostname` VARCHAR(255) NOT NULL COMMENT 'Hostname',
  `ip_address` VARCHAR(255) NOT NULL COMMENT 'Primary IP address',
  `passwd` VARCHAR(255) NOT NULL COMMENT 'Root Password',
  `create_date` DATETIME NOT NULL COMMENT 'Date server was created',
  `decommission_date` DATETIME NULL COMMENT 'Date server was decommissioned',
  `desc`  TEXT NULL  COMMENT 'Additional information about the server',
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX (`hostname` ASC),
  UNIQUE INDEX (`id_address` ASC)
)
ENGINE = InnoDB COMMENT = 'Servers being managed in the system';


