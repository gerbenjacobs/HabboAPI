# HabboAPI
This PHP wrapper library is used to collect data from the _unofficial_ Habbo.com Beta API.  
The project required PHP 5 and uses the Composer autoloader and PSR-4 standard.

See the `example.php` file on how to use this library at the moment.

## Installation
1. Download/git clone the project
2. Download Composer if not installed globally `curl -sS https://getcomposer.org/installer | php`
3. Run `composer install`
4. Verify the install by running `phpunit` or opening the `example.php` page on a PHP server

To use it:

1. On the page you want to use it add `include 'vendor/autoload.php'`
2. Create a HabboAPI instance with the namespace included `$habboAPI = new \HabboAPI\HabboAPI();` (Or have a look at the example.php page for the `use` statement)

## Usage
```php
    <?php
    // Create new API instance
    $habboApi = new \HabboAPI\HabboAPI();
    
    // Find the user 'koeientemmer' and get their ID
    $koeientemmer = $habboApi->getHabbo('koeientemmer')->getId();
    
    // Collect all the profile info
    $profile = $habboApi->getProfile($koeientemmer);
```

## Current status
Pre-alpha/dev/what have you. At the moment this is the first development iteration.  
Consider it a prototype.
