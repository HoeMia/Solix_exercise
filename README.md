# Solix Exercise Project

This is a test project in PHP made to show my, let's say, DECENT PHP SKILLS.

# Dev Overview

- Whole project was managed using Composer
- I was trying to make use of TDD in the process
- I used two external packaged to manage TDD and time operations

# Project is using
- nesbot/carbon for time management
- phpunit/phpunit for unit testing
- Composer for package management

# Project Setup
- download files to a folder on Your machine
- run ```sh composer update ``` to download needed packages

# Testing
- to run tests, use command ```sh./vendor/bin/phpunit tests``` from root path of the project

# Running program
- Program is executed from console. To run it just use ```sh php .\generatePaydayCsv.php ```
#### It can be run with four OPTIONAL options: 
- -d (for date) - provided in a format "m-d-Y" or, if You specify format, in the given format. If date is not provided, todays date is assumed
- -f (for date format) - specify date format (see possible formats for Carbon) like "Y-m-d". If not provided, default format is "m-d-Y"
- -p (for file path) - possibility of specifying file path for file to be saved. If not provided, file will be created in root dir of the projects
- -n (for file name) - specifies filename (without extension). If not specified, You will get a file named "paydayDates_[timestamp]_[date]"

#### Examples of invoking script
```sh
php .\generatePaydayCsv.php -d"2020-07-12" -f"Y-m-d" -p"c:/smth"
php .\generatePaydayCsv.php -f"Y-m-d"
php .\generatePaydayCsv.php -d"2020-07-12"
php .\generatePaydayCsv.php
php .\generatePaydayCsv.php -n"someName"
```

# THANKS FOR READING, LOV U <3