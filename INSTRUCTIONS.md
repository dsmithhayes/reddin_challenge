# Instructions

This document will outline how to set up the development environment.

## Stack

* PHP 7
    * PHP-FPM
    * Composer
* MySQL 5.7

Everything is developed locally on an Ubuntu 16.04 Linux distribution, using
the maintained versions of the stack from Aptitude.

## Installation

The post-installation script will initialize the database, and its tables.

    $ composer install
    $ app/console server:run

## Parse Users

To parse the users data into the database issue the following command:

    $ app/console csv:import-users csv/user-data.csv
