<?php
// Include the Composer autoloader
include 'vendor/autoload.php';

// Shortcut for the FQN
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Habbo;
use HabboAPI\HabboAPI;
use HabboAPI\HabboParser;

// Create new Parser and API instance
$habboParser = new HabboParser('95.96.129.101', 'https://www.habbo.com/api/public/');
$habboApi = new HabboAPI($habboParser);

// Find the user 'koeientemmer' and get their ID
$koeientemmer = $habboApi->getHabbo('koeientemmer')->getId();

// Collect all the profile info
$profile = $habboApi->getProfile($koeientemmer);

// Print all the $profile data in a pretty format
$html = '';
$lastSection = '';
foreach ($profile as $section => $data) {

    // Print section name
    if ($section != $lastSection) {
        $lastSection = $section;
        $html .= '<h2>'.ucfirst($section).'</h2>';
    }

    // Some markup for the Habbo part
    if ($section == 'habbo') {
        /* @var Habbo $habbo */
        $habbo = $data;
        $html .= '<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure='.$habbo->getFigureString().'&size=m&gesture=sml&head_direction=3"
            alt="'.$habbo->getHabboName().'" title="'.$habbo->getHabboName().'" style="float: left; margin-right: 10px;" />';
        $html .= '<h3>'.$habbo->getHabboName().'</h3>';
        $html .= '<p>'.$habbo->getMotto().'<br><em>'.date('d-M-Y', strtotime($habbo->getMemberSince())).'</em></p>';
        if ($habbo->getProfileVisible()) {
            $html .= '<p><a href="https://beta.habbo.com/profile/'.$habbo->getHabboName().'">View home &raquo;</a></p>';
        }
        if ($badges = $habbo->getSelectedBadges()) {
            foreach ($badges as $badge) {
                /* @var $badge Badge */
                $html .=
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
        $html .= '<ul>';
        foreach ($data as $object) {
            $html .= '<li>'.$object.'</li>'; // uses the __toString() method
        }
        $html .= '</ul>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HabboAPI Example</title>
</head>
<body>
    <?php echo $html; ?>
    <pre>
        <?php print_r($profile['habbo']); ?>
    </pre>
</body>
</html>