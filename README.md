[![Build status] (https://api.travis-ci.org/gerbenjacobs/HabboAPI.svg)](https://travis-ci.org/gerbenjacobs/HabboAPI)
[![Latest Stable Version](https://poser.pugx.org/gerbenjacobs/habbo-api/v/stable.svg)](https://packagist.org/packages/gerbenjacobs/habbo-api)
# HabboAPI
This PHP wrapper library is used to collect data from the _undcoumented_ Habbo.com Beta API.  
The project required PHP 5 and uses the Composer autoloader and PSR-4 standard.

See the `example.php` file on how you could use this library.

## How to use it
1. Add [the Composer package](https://packagist.org/packages/gerbenjacobs/habbo-api) to your package.json file: `"gerbenjacobs/habbo-api": "v1.*"`
2. On the page you want to use it add `include 'vendor/autoload.php'`
3. Create a HabboParser and construct it with the IP that the server runs on (to prevent JS Cookie issues) and the base URL of the API
4. Create a HabboAPI instance and inject the HabboParser

## Usage
```php
    <?php
    // Include the Composer autoloader
    include 'vendor/autoload.php';
    
    // Shortcut for the FQN
    use HabboAPI\HabboAPI;
    use HabboAPI\HabboParser;
    
    // Create new Parser and API instance
    $habboParser = new HabboParser('https://www.habbo.com/api/public/');
    $habboApi = new HabboAPI($habboParser);
    
    // Find the user 'koeientemmer' and get their ID
    $koeientemmer = $habboApi->getHabbo('koeientemmer')->getId();
    
    // Collect all the profile info
    $profile = $habboApi->getProfile($koeientemmer);
```

## Current status
- October 27th, 2015 - v1.0.5 - Allow parseHabbo() to use either Habboname or HHID. Also adds some stability to the Group entity
- October 25th, 2015 - v1.0.3 - Throws exception if Habbo API replies with error and removed the `HabboAPI` directory for idiomatic packagist standards.
- October 12th, 2015 - v1.0.2 - Removed server IP, upgraded PHPUnit and tests, expanded on example.php
- March 30th, 2015 - v1.0.1 - Added hasProfile and more stable example.php
- March 28th, 2015 - v1.0.0 - Created first tagged release, includes Travis CI and Packagist integration.

## Developer Installation
1. Clone the project
2. Run `composer install`
3. Verify the install by running `phpunit` or opening the `example.php` page on a PHP server
