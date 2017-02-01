[![Build status] (https://api.travis-ci.org/gerbenjacobs/HabboAPI.svg)](https://travis-ci.org/gerbenjacobs/HabboAPI)
[![Latest Stable Version](https://poser.pugx.org/gerbenjacobs/habbo-api/v/stable.svg)](https://packagist.org/packages/gerbenjacobs/habbo-api)
[![Join the chat at https://gitter.im/gerbenjacobs/HabboAPI](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/gerbenjacobs/HabboAPI) 
# HabboAPI
This PHP wrapper library is used to collect data from the _undcoumented_ Habbo API.  
The project requires PHP 5.3 or higher and uses the Composer autoloader and PSR-4 standard.

See the `example.php` file on how you could use this library.

## How to use it
1. Add [the Composer package](https://packagist.org/packages/gerbenjacobs/habbo-api) to your package.json file: `"gerbenjacobs/habbo-api": "v2.*"`
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
3. Verify the install by running `phpunit` or opening the `example.php` page on a PHP server
