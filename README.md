MyVBC - Online Administration for a Volleyball Club
=====

[![Docker Repository on Quay](https://quay.io/repository/splattner/myvbc/status "Docker Repository on Quay")](https://quay.io/repository/splattner/myvbc)
[![GitHub release](https://img.shields.io/github/release/splattner/myvbc.svg)](https://github.com/splattner/myvbc)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/4c276e5990f140168513b17530eefd62)](https://www.codacy.com/app/splattner/myvbc?utm_source=github.com&utm_medium=referral&utm_content=splattner/myvbc&utm_campaign=badger)

# Features

* Membermanagement, for Addresses of the Members
* Teammanagement, which Teams do we have and which Member is part of the Team
* Licence Ordering, for easy licence Ordering of the Team-Responsible
* Gamemanagement, all Games directly imported from SwissVolley (VolleyManager) or Swissvolley Region Solothurn
* Game-Writer Management, easy assign Writers to a Game
* Keymanagement, all (physical)-Keys from the Club,
* Reports, some preconfigured Reports
* Role-based Access Control

## Screenshots

<img src="/doc/images/myvbc.png" width="30%"></img>
<img src="/doc/images/login.png" width="30%"></img>
<img src="/doc/images/adressen" width="30%"></img>
<img src="/doc/images/teams"></img>
<img src="/doc/images/teammitglieder.png" width="30%"></img>
<img src="/doc/images/lizenzen.png" width="30%"></img>
<img src="/doc/images/spiele_schreiber.png" width="30%"></img>

# Installation

## Requirements

* A webserver with PHP 7.0
* MySQL Database
* Composer

## Checkout or download

Checkout Project from Github:

```
git clone https://github.com/splattner/myvbc.git
```

or

Download Release from: https://github.com/splattner/myvbc/releases

## Run Composer for Dependencies

```
composer install
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
MYSQL_DB_PORT
MYSQL_DB_USERNAME
MYSQL_DB_PASSWORD
MYSQL_DB_NAME
```

## Deploy database shema

Run ```install.php```to deploy Database. This script does install the DB Schema or makes an update to a current Database.

## Login

MyVBC in now ready. Open in Browser and have fun.

Default Credentials:

```
Username: admin@myvbc.ch
Password: myvbc
```

# Docker

## Docker images

MyVBC is available as Docker Image: https://quay.io/repository/splattner/myvbc
Run

```
docker pull quay.io/splattner/myvbc
```

to get the latest Version.

Start with (using default credentials, see etc/config.inc.php):

```
docker run -d -P --link mydb:mysql quay.io/splattner/myvbc
```

or with Environment Variables for the DB Connection:

```
docker run -d -P --link mydbserver:mysql -e MYSQL_DB_NAME=mydbname -e MYSQL_DB_PASSWORD=mypassword -e MYSQL_DB_USERNAME=myusername quay.io/splattner/myvbc
```

replace mydbserver, mydbname, mypassword, myusername to suit your Environment.




## Run with Docker-Compose

You can run MyVBC using Docker-Compose. Just run:

```
docker-compose up
```

and you shoud have a running instance (with MariaDB and PHPmyAdmin).
Open http://localhost:8080 for MyVBC and http://localhost:8081 for PHPmyAdmin

On first run (or Upgrade), you should open http://localhost:8080/install.php.
