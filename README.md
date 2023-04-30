[![Build status](https://github.com/gerbenjacobs/HabboAPI/actions/workflows/php.yml/badge.svg)](https://github.com/gerbenjacobs/HabboAPI/actions/workflows/php.yml)
[![Latest Stable Version](https://poser.pugx.org/gerbenjacobs/habbo-api/v/stable.svg)](https://packagist.org/packages/gerbenjacobs/habbo-api)
# HabboAPI
This PHP wrapper library is used to collect data from the _undocumented_ Habbo API.  
The project requires PHP 8.1 or higher and uses the Composer autoloader and PSR-4 standard.

Older versions for PHP 7.4 are available at [Packagist](https://packagist.org/packages/gerbenjacobs/habbo-api).

See the `example.php` file on how you could use this library.

## How to use it
1. Add [the Composer package](https://packagist.org/packages/gerbenjacobs/habbo-api) to your project by running `composer require gerbenjacobs/habbo-api`
2. On the page you want to use it add `include 'vendor/autoload.php'`
3. Create a HabboParser and construct it with the Habbo domain extension "com", "com.br", "de" etc.
4. Create a HabboAPI instance and inject the HabboParser in the constructor

## Usage
```php
    <?php
    // Include the Composer autoloader
    include 'vendor/autoload.php';
    
    // Shortcut for the FQN
    use HabboAPI\HabboAPI;
    use HabboAPI\HabboParser;
    
    // Create new Parser and API instance
    $habboParser = new HabboParser('com');
    $habboApi = new HabboAPI($habboParser);
    
    // Find the user 'koeientemmer' and get their ID
    $koeientemmer = $habboApi->getHabbo('koeientemmer')->getId();
    
    // Collect all the profile info
    $profile = $habboApi->getProfile($koeientemmer);
```

## Changelog
- April 30th, 2023 v6.0.0 - Fully support PHP 8.1 and up
- December 29th, 2020 v5.0.0 - Add support for PHP 8 and drop support below PHP 7.3
- December 18th, 2020 v4.1.0 - Adds "sandbox" as hotel, includes new values for `Habbo` entity; online, lastAccessTime, currentLevel, currentLevelCompleted, totalExperience, starGemCount
- March 30th, 2020 v4.0.0 - Use Carbon 2.0 and drop support for PHP below 7.1.8
- June 11th, 2018 v3.0.1 - Removed unused cookie logic
- May 25th, 2018 - v3.0.0 - Removed official support for PHP 5.4, updated dependencies, fixed warnings for PHP 7.1
- November 9th, 2017 - v2.4.0 - Added `getGroupId()` to Room entities, but only if that data exists
- February 1st, 2017 - v2.3.0 - Added `getAchievements()` to API, returns a list of a Habbos achievements including current level and score
- April 4th, 2016 - v2.2.0 - Added better exception handling, you can now catch `MaintenanceException`, `HabboNotFoundException` and `UserInvalidException`
- March 17th, 2016 - v2.1.1 - Add/fix support for `id` and `uniqueId` in Room objects
- February 25th, 2016 - v2.1.0 - Added getGroup and group member functionality
- February 10th, 2016 - v2.0.2 - Changed cookie for JS detection
- December 26th, 2015 - v2.0.1 - Fix for the cookie needed for Photos
- December 10th, 2015 - v2.0.0 - Added Photos to API and implemented a Profile entity [(Release notes)](https://github.com/gerbenjacobs/HabboAPI/releases/tag/v2.0.0)
- December 4th, 2015 - v1.0.7 - Adds new attributes to Room entity
- November 30th, 2015 - v1.0.6 - Small fixes to Room entity and better exception handling.
- October 27th, 2015 - v1.0.5 - Allow parseHabbo() to use either Habboname or HHID. Also adds some stability to the Group entity
- October 25th, 2015 - v1.0.3 - Throws exception if Habbo API replies with error and removed the `HabboAPI` directory for idiomatic packagist standards.
- October 12th, 2015 - v1.0.2 - Removed server IP, upgraded PHPUnit and tests, expanded on example.php
- March 30th, 2015 - v1.0.1 - Added hasProfile and more stable example.php
- March 28th, 2015 - v1.0.0 - Created first tagged release, includes Travis CI and Packagist integration.

## Developer Installation
1. Clone the project
2. Run `composer install`
3. Verify the installation by running `vendor/bin/phpunit` or opening the `example.php` page on a PHP server
