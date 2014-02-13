## Race Center for Miles for Myeloma

This is an event management, registration, and donation system built for Miles for Myeloma, a non-profit based in Iowa City, Iowa.
It is currently under heavy development and much of the core functionality still does not exist.

Project is a fork of [L4withSentry](https://github.com/rydurham/L4withSentry).

[![Build Status](https://travis-ci.org/MilesForMyeloma/MilesRaceCenter.png?branch=master)](https://travis-ci.org/MilesForMyeloma/MilesRaceCenter) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/MilesForMyeloma/MilesRaceCenter/badges/quality-score.png?s=861b5a46acee86f29f4c37625a80e132672f3c78)](https://scrutinizer-ci.com/g/MilesForMyeloma/MilesRaceCenter/) [![Dependencies Status](https://depending.in/MilesForMyeloma/MilesRaceCenter.png)](http://depending.in/MilesForMyeloma/MilesRaceCenter) [![Code Coverage](https://scrutinizer-ci.com/g/MilesForMyeloma/MilesRaceCenter/badges/coverage.png?s=173f200a782f2700da49b0e2726ab18fc88b75ff)](https://scrutinizer-ci.com/g/MilesForMyeloma/MilesRaceCenter/)

### Internals

* Race times are stored as UTC and converted to local race timezone when displayed.
* Creating a race requires admin access.

### Instructions

After you have cloned this repo to your development environment, [install & run composer](http://niallobrien.me/2013/03/installing-and-updating-laravel-4/):

	curl -sS https://getcomposer.org/installer | php
	php composer.phar install

Run the Miles Race Center Migrations:

	php artisan migrate

Next, run the Sentry 2 Migrations:

	php artisan migrate --package=cartalyst/sentry

Use the seeds provided in this repo to set up the initial user accounts:

	php artisan db:seed

Edit the following config files:
* /app/config/mail.php -- Email configuration
* /app/config/app.php -- Payment method configuration
* /app/config/database.php -- Database configuration

### Seeds
The seeds in this repo will create two groups and two user accounts.

__Groups__
* Users
* Admins

__Users__
* user@user.com  *Password: sentryuser*
* admin@admin.com *Password: sentryadmin*

## Dependencies and Thank Yous
- (jsTimezoneDetect)[http://pellepim.bitbucket.org/jstz/]
- Twitter Bootstrap
- jQuery
- Restfulizer.js
- BootstrapSwitch
- Omnipay
- Laravel
- Jeffery Way
- Sentry

### Notes

* Please let me know if you have any problems.
* The GroupController is restful and the UserController is not; only because I wanted to experiment with both methods.
* I have been a bit sloppy with how I handle "Admin" access checking in the UserController - I hope to clean this up soon.
* There are currently no tests here, beyond the tests provided with Sentry 2 and Laravel 4.  I am not yet hip enough to TDD to add these in a meaningful way.
* Currently all mail is being sent inline - eventually I will switch this over to use the new Queue feature in Laravel 4.


=======
The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
