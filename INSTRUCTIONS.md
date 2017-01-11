# Instructions

This document will outline how to set up the development environment.

## Stack

* PHP 7
    * PHP-FPM
    * Composer
* MySQL 5.7

## Installation

The post-installation script will initialize the database, and its tables.

    $ composer install
    $ app/console server:run

## Parse Users

To parse the users data into the database issue the following command:

    $ app/console csv:import-users csv/user-data.csv

