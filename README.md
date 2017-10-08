MyVBC - Online Administration for a Volleyball Club
=====

# Installation
## Checkout or download

Checkout Project from Github:

```
git clone https://github.com/splattner/myvbc.git
```

or

Download Release from: https://github.com/splattner/myvbc/releases

## Run Composer for Dependencies

```
composer install // Change this to suit your composer environment.
```



# First Run

## Database configuration

Change Database settings in ```etc/config.inc.php```

```
$config["db"]["host"] = getenv('MYSQL_DB_HOST') ? getenv('MYSQL_DB_HOST') : "127.0.0.1";
$config["db"]["port"] = getenv('MYSQL_DB_HOST') ? getenv('MYSQL_DB_PORT') : "3306";
$config["db"]["username"] = getenv('MYSQL_DB_USERNAME') ? getenv('MYSQL_DB_USERNAME') : "myvbc";
$config["db"]["password"] = getenv('MYSQL_DB_PASSWORD') ? getenv('MYSQL_DB_PASSWORD') : "myvbc";
$config["db"]["database"] = getenv('MYSQL_DB_NAME') ? getenv('MYSQL_DB_NAME') :  "myvbc";
```

or use Environment Variables:

```
MYSQL_DB_HOST
MYSQL_DB_HOST
MYSQL_DB_USERNAME
MYSQL_DB_PASSWORD
MYSQL_DB_NAME
```

## Deploy database shema

Run ```install.php```to deploy Database

## Login

MyVBC in now ready. Open in Browser and have fun.

Default Credentials:

```
Username: admin@myvbc.ch
Password: myvbc
```





