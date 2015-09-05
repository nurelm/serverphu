# PostgreSQL Requirements

To use PostgreSQL with your Serverphu installation, the following requirements
must be met: Server has PHP 5.5 or later with PDO, and the PDO pgsql driver 
must be enabled.

Note that the database must be created with UTF-8 (Unicode) encoding.

## Create Database User

This step is only necessary if you don't already have a user set up (e.g., by
your host), or want to create a new user for use with Serverphu only. The
following command creates a new user named 'username' and asks for a password
for that user (make sure to remember that password so you can enter it in 
app/settings.php):
```
createuser --pwprompt --encrypted --no-createrole --no-createdb username
```

If there are no errors, then the command was successful.

## Create Serverphu Database

This step is only necessary if you don't already have a database set up
(e.g., by your host) or want to create a new database for use with Serverphu
only. The following command creates a new database named 'databasename',
which is owned by the previously created 'username':
```
createdb --encoding=UTF8 --owner=username databasename
```

If there are no errors, then the command was successful.

## Create Schema

Serverphu will need to run in the schema that you specify in 
app/settings.php:
```
CREATE SCHEMA schema_name AUTHORIZATION username;
```

