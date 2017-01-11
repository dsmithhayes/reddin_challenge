# Instructions

This document will outline how to set up the development environment.

## Stack

* PHP 7
    * PHP-FPM
    * Composer
* MySQL 5.7

Everything is developed locally on an Ubuntu 16.04 Linux distribution, using
the maintained versions of the stack from Aptitude. The downside of this is that
the application is not entirely portable.

## Installation

    $ composer install                              # install dependencies
    $ app/console doctrine:database:create          # create the database
    $ app/console doctrine:schema:update --force    # create the tables
    $ app/console server:run                        # run the server

## Parse Users Command

To parse the users data into the database issue the following command:

    $ app/console csv:import-users csv/user-data.csv

This command will take a while as it hashes a list of 100 passwords.
