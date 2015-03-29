<?php
// Include the Composer autoloader
include 'vendor/autoload.php';

// Shortcut for the FQN
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Habbo;
use HabboAPI\HabboAPI;
use HabboAPI\HabboParser;

// Create new Parser and API instance
$habboParser = new HabboParser($_SERVER['SERVER_ADDR'], 'https://www.habbo.com/api/public/');
$habboApi = new HabboAPI($habboParser);

// Find the user 'koeientemmer' and get their ID
$myHabbo = $habboApi->getHabbo('koeientemmer');

if ($myHabbo->hasProfile()) {
    // Collect all the profile info
    $myProfile = $habboApi->getProfile($myHabbo->getId());
} else {
    // This Habbo has a closed home, only show their Habbo object
    $myProfile = array('habbo' => $myHabbo);
}

// Print all the $profile data in a pretty format
$lastSection = '';
foreach ($myProfile as $section => $data) {

    // Print section name
    if ($section != $lastSection) {
        $lastSection = $section;
        echo '<h2>'.ucfirst($section).' ('.count($data).')</h2>';
    }

    // Some markup for the Habbo part
    if ($section == 'habbo') {
        /* @var Habbo $habbo */
        $habbo = $data;
        echo '<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure='.$habbo->getFigureString().'&size=m&gesture=sml&head_direction=3"
            alt="'.$habbo->getHabboName().'" title="'.$habbo->getHabboName().'" style="float: left; margin-right: 10px;" />';
        echo '<h3>'.$habbo->getHabboName().'</h3>';
        echo '<p>'.$habbo->getMotto().'<br><em>'.date('d-M-Y', strtotime($habbo->getMemberSince())).'</em></p>';
        if ($habbo->getProfileVisible()) {
            echo '<p><a href="https://beta.habbo.com/profile/'.$habbo->getHabboName().'">View home &raquo;</a></p>';
        }
        if ($badges = $habbo->getSelectedBadges()) {
            foreach ($badges as $badge) {
                /** @var Badge $badge */
                echo
                    '<p>
                        <img src="http://images.habbo.com/c_images/album1584/'.$badge->getCode().'.gif" alt="'.$badge->getName().'" title="'.$badge->getName().'" /><br>
                        <strong>'.$badge->getName().'</strong><br>
                        <em>'.$badge->getDescription().'</em>
                    </p>
                ';
            }
        }
    }

    // Show all the other sections as an unordered list
    if (in_array($section, array("friends", "groups", "rooms", "badges"))) {
        echo '<ul>';
        foreach ($data as $object) {
            echo '<li>'.$object.'</li>'; // uses the __toString() method
        }
        echo '</ul>';
    }
}