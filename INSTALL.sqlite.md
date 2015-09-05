# SQLite Requirements

To use SQLite with your Serverphu installation, the following requirements must 
be met: Server has PHP 5.5 or later with PDO, and the PDO SQLite driver must be
enabled.

## Create the Database

The Serverphu installer will create the SQLite database for you. The only
requirement is that the installer must have write permissions to the directory
where the database file resides. This directory (not just the database file) 
also has to remain writeable by the web server going forward for SQLite to 
continue to be able to operate.

The 'name' key for the database ($db) array in the app/settings.php should
contain the full path to the database for this installation to work.

