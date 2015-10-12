<?php
// Include the Composer autoloader
include 'vendor/autoload.php';

// Shortcut for the FQN
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Habbo;
use HabboAPI\HabboAPI;
use HabboAPI\HabboParser;

// Create new Parser and API instance
$habboParser = new HabboParser('https://www.habbo.com/api/public/');
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

// Export as HTML
$html = [
    'habbo' => '',
    'worn_badges' => '',
    'friends' => '',
    'groups' => '',
    'rooms' => '',
    'badges' => ''
];

// Print all the $profile data in a pretty format, except for 'habbo'
$lastSection = 'habbo';
foreach ($myProfile as $section => $data) {

    // Print section name
    if ($section != $lastSection) {
        $lastSection = $section;
        $html[$section] .= '<h2>' . ucfirst($section) . ' (' . count($data) . ')</h2>';
    }

    // Some markup for the Habbo part
    if ($section == 'habbo') {
        /* @var Habbo $habbo */
        $habbo = $data;
        $html['habbo'] .= '<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $habbo->getFigureString() . '&size=l&gesture=sml&head_direction=3"
            alt="' . $habbo->getHabboName() . '" title="' . $habbo->getHabboName() . '" style="float: left; margin-right: 10px;" />';
        $html['habbo'] .= '<h3>' . $habbo->getHabboName() . '</h3>';
        $html['habbo'] .= '<p>' . $habbo->getMotto() . '<br><em>' . date('d-M-Y', strtotime($habbo->getMemberSince())) . '</em></p>';
        if ($habbo->getProfileVisible()) {
            $html['habbo'] .= '<p><a href="https://www.habbo.com/profile/' . $habbo->getHabboName() . '">View home &raquo;</a></p>';
        }
        if ($badges = $habbo->getSelectedBadges()) {
            foreach ($badges as $badge) {
                /** @var Badge $badge */
                $html['worn_badges'] .=
                    '
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#">
                                <img class="media-object" src="http://images.habbo.com/c_images/album1584/' . $badge->getCode() . '.gif" alt="' . $badge->getName() . '">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">' . $badge->getName() . '</h4>
                            <em>' . $badge->getDescription() . '</em>
                        </div>
                    </div>
                    ';
            }
        }
    } else {
        // Show all the other sections as an unordered list
        if (in_array($section, array("friends", "groups", "rooms", "badges"))) {
            $html[$section] .= '<ul>';
            foreach ($data as $object) {
                $html[$section] .= '<li>' . $object . '</li>'; // uses the __toString() method
            }
            $html[$section] .= '</ul>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HabboAPI</title>

    <link href="http://bootswatch.com/lumen/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        html, body {
            margin: 20px;
        }
        .media-left {
            min-width: 60px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">

    <div class="jumbotron">
        <h1>HabboAPI</h1>

        <p>A PHP wrapper library for the undocumented API of Habbo</p>

        <p><a class="btn btn-primary btn-lg" href="https://github.com/gerbenjacobs/HabboAPI" role="button" target="_blank">Learn more</a></p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php echo $html['habbo']; ?>
        </div>
        <div class="col-md-6">
            <?php echo $html['worn_badges']; ?>
        </div>
    </div>

    <?php if ($myHabbo->hasProfile()): ?>
        <div class="row">
            <div class="col-md-3">
                <?php echo $html['badges']; ?>
            </div>
            <div class="col-md-3">
                <?php echo $html['friends']; ?>
            </div>
            <div class="col-md-3">
                <?php echo $html['groups']; ?>
            </div>
            <div class="col-md-3">
                <?php echo $html['rooms']; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
