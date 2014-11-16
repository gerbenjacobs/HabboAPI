# HabboAPI
This PHP wrapper library is used to collect data from the _unofficial_ Habbo.com Beta API.  
The project required PHP 5 and uses the Composer autoloader and PSR-4 standard.

See the `example.php` file on how to use this library at the moment.

## Installation
1. Download/git clone the project
2. Run `php composer.phar install`
3. On the page you want to use it add `include 'vendor/autoload.php'`
4. Create a HabboAPI instance with the namespace included `$habboAPI = new \HabboAPI\HabboAPI();` (Or have a look at the example.php page for the `use` statement)

## Usage
    <?php
    // Create new API instance
    $habboApi = new \HabboAPI\HabboAPI();
    
    // Find the user 'koeientemmer' and get their ID
    $koeientemmer = $habboApi->getHabbo('koeientemmer')->getId();
    
    // Collect all the profile info
    $profile = $habboApi->getProfile($koeientemmer);


## Current status
Pre-alpha/dev/what have you. At the moment this is the first development iteration.  
Consider it a prototype.