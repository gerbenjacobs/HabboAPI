<?php
// Include the Composer autoloader
include 'vendor/autoload.php';

// Shortcut for the FQN
use HabboAPI\HabboAPI;

// Create new API instance
$habboApi = new HabboAPI();

// Find the user 'koeientemmer' and get their ID
$koeientemmer = $habboApi->getHabbo('koeientemmer')->getId();

// Collect all the profile info
$profile = $habboApi->getProfile($koeientemmer);

// Print all the $profile data in a pretty format
$lastSection = '';
foreach ($profile as $section => $data) {

    // Print section name
    if ($section != $lastSection) {
        $lastSection = $section;
        echo '<h2>'.ucfirst($section).'</h2>';
    }

    // Some markup for the Habbo part
    if ($section == 'habbo') {
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