# webtools.ieeebruins.com

## Setting up a Development Environment
1. Download the project or clone this repo.

2. Download [MAMP](https://www.mamp.info/en/)

3. Point MAMP's web server to this project and start the Apache, PHP, and MySQL server.

4. Visit `localhost:8888/phpMyAdmin` to open phpMyAdmin. Create a database for this project. Create a table named `reimbursements`.

5. Create `/app/config/config.php` with your database configuration.

6. Visit `localhost:8888` to view this project

**Sample config.php file (works with MAMP)**
```
<?php

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');

```
