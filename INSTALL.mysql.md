# MySQL/MariaDB REQUIREMENTS

To use MySQL or MariaDB with your Serverphu installation, the following
requirements must be met: Server has PHP 5.5 or later with PDO, and the PDO
mysql driver must be enabled.

## Create the MySQL Database

This step is only necessary if you don't already have a database set up (e.g.,
by your host). In the following examples, 'username' is an example MySQL user
which has the CREATE and GRANT privileges. Use the appropriate user name for
your system.

First, you must create a new database for your Serverphu site (here,
'databasename' is the name of the new database):

```
mysqladmin -u username -p create databasename
```

MySQL will prompt for the 'username' database password and then create the
initial database files. Remember the password to enter in the app/settings.php
config file. Next you must log in and set the access database rights:

```
mysql -u username -p
```

Again, you will be asked for the 'username' database password. At the MySQL
prompt, enter the following command:
```
GRANT ALL PRIVILEGES ON databasename.* TO 'username'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
```

where:

`databasename` is the name of your database
`username` is the username of your MySQL account
`localhost` is the web server host where Serverphu's databasae is installed
`password` is the password required for that username

Note: Unless the database user/host combination for your Serverphu installation
has all of the privileges listed above you will not be able to install or run 
Serverphu.

If successful, MySQL will reply with:

```
Query OK, 0 rows affected
```

If the InnoDB storage engine is available, it will be used for all database
tables. InnoDB provides features over MyISAM such as transaction support,
row-level locks, and consistent non-locking reads.
