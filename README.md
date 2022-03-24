School Board
===================

## Setup project

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

    curl -s http://getcomposer.org/installer | php

Install vendors with

    php composer.phar install

Create config file on the base config/config.ini.dist

    cp config/config.ini.dist config/config.ini

Set config for database in file config/config.ini

For create tables run

    mysql -uUSER -pPASSWORD SCHEMA < data/sql/init.sql

or import data/sql/init.sql in your schema by using phpmyadmin

For populate the database with random data  run

    mysql -uUSER -pPASSWORD SCHEMA < data/sql/data.sql

or import data/sql/data.sql in your schema by using phpmyadmin

## Additional help

You can receive the data about the student by next URL

    domain-of-your-app/students/{id}

