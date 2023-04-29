<?php
// Include the Composer autoloader
include 'vendor/autoload.php';

// Shortcut for the FQN
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Profile;
use HabboAPI\HabboAPI;
use HabboAPI\HabboParser;

// Create new Parser and API instance
$habboParser = new HabboParser('com');
$habboApi = new HabboAPI($habboParser);

try {
    // Find the user 'Macklebee' and get their ID
    $myHabbo = $habboApi->getHabbo('Macklebee');

    // Get extra information about one of their groups
    // Note: This is actually a hardcoded group ID to showcase the parseGroup() endpoint
    $group = $habboApi->getGroup("g-hhus-0419705237d0e8c004195c365810e7a7");
} catch (Exception $e) {
    echo '
        <p>Oops. Can not find this Habbo!</p>
        <p>Try to catch this exception gracefully in your application!</p>
        <p>[' . $e->getCode() . '] ' . $e->getMessage() . '</p>
        <hr>
        ' . nl2br($e->getTraceAsString()) . '
    ';
    exit();
}

if ($myHabbo->hasProfile()) {
    // Collect all the profile info
    $myProfile = $habboApi->getProfile($myHabbo->getId());
} else {
    // This Habbo has a closed home, only show their Habbo object
    $myProfile = new Profile();
    $myProfile->setHabbo($myHabbo);
}

// Get all their photos
$myPhotos = $habboApi->getPhotos($myHabbo->getId());

// Export as HTML
$html = [
    'habbo' => '',
    'worn_badges' => '',
    'friends' => '',
    'groups' => '',
    'rooms' => '',
    'badges' => '',
    'photos' => ''
];


// Some markup for the Habbo part

$habbo = $myProfile->getHabbo();
$onlineText = $habbo->isOnline() ? "yes" : "no";
$lastAccess = ($habbo->getLastAccessTime()) ? $habbo->getLastAccessTime()->toFormattedDateString() : "N/A";
$html['habbo'] .= '<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $habbo->getFigureString() . '&size=l&gesture=sml&head_direction=3"
            alt="' . $habbo->getHabboName() . '" title="' . $habbo->getHabboName() . '" style="float: left; margin-right: 10px;" />';
$html['habbo'] .= '<h3>' . $habbo->getHabboName() . '</h3>';
$html['habbo'] .= '<p>' . $habbo->getMotto() . '<br><em>' . $habbo->getMemberSince()->toFormattedDateString() . '</em></p>';
$html['habbo'] .= '<p>StarGem count: ' . $habbo->getStarGemCount() . '<br>Total Experience: ' . $habbo->getTotalExperience() . ' <br> Current Level: ' . $habbo->getCurrentLevel() . '</p>';
$html['habbo'] .= '<p>Online: ' . $onlineText . '<br>Last seen: <em>' . $lastAccess . '</em></p>';

if ($habbo->getProfileVisible()) {
    $html['habbo'] .= '<p><a href="https://www.habbo.com/profile/' . $habbo->getHabboName() . '">View home &raquo;</a></p>';
}

if ($badges = $habbo->getSelectedBadges()) {
    foreach ($badges as $badge) {
        /** @var Badge $badge */
        $html['worn_badges'] .= '
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

if ($myHabbo->hasProfile()) {
    // Show all the other sections as an unordered list
    foreach (array("friends", "groups", "rooms", "badges") as $section) {
        $html[$section] .= '<ul>';
        $method_name = sprintf('get%s', ucfirst($section));
        foreach (call_user_func(array($myProfile, $method_name)) as $object) {
            $html[$section] .= '<li>' . $object . '</li>'; // uses the __toString() method
        }
        $html[$section] .= '</ul>';
    }
}

// Generate the photos
if ($myPhotos) {
    foreach ($myPhotos as $myPhoto) {
        $html['photos'] .= '
            <div class="col-md-3">
                <a href="https://www.habbo.com/profile/' . $myPhoto->getCreatorName() . '/photo/' . $myPhoto->getId() . '" class="thumbnail">
                  <img src="' . $myPhoto->getPreviewUrl() . '" alt="' . $myPhoto->getId() . '">
                </a>
                <div class="caption">Taken on ' . $myPhoto->getTakenOn()->toFormattedDateString() . ' by ' . $myPhoto->getCreatorName() . '</div>
            </div>
        ';
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

    <link href="https://bootswatch.com/3/lumen/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        html,
        body {
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

        <hr>

        <div class="row">
            <?php echo $html['photos']; ?>
        </div>

        <?php if ($myHabbo->hasProfile()) : ?>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $html['badges']; ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $html['friends']; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $html['groups']; ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $html['rooms']; ?>
                        </div>
                    </div>
                    <?php if ($group) : ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="https://www.habbo.com/habbo-imaging/badge/<?php echo $group->getBadgeCode(); ?>.gif">

                                <h3>
                                    <span style="display: inline-block; border: 1px solid #000; width: 20px; background-color: #<?php echo $group->getPrimaryColor(); ?>;">&nbsp;</span>
                                    <span style="display: inline-block; border: 1px solid #000; width: 20px; background-color: #<?php echo $group->getSecondaryColor(); ?>;">&nbsp;</span>
                                    <?php echo $group->getName(); ?>
                                </h3>

                                <p>[<?php echo $group->getType(); ?>] - <?php echo $group->getDescription(); ?></p>
                                <p>
                                    <a class="btn btn-default" href="https://www.habbo.com/hotel?room=<?php echo $group->getRoomId(); ?>" target="_blank">Go to room <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                                </p>

                                <?php $members = $group->getMembers();
                                if (count($members) > 0) : ?>
                                    <p>This group has <strong><?php echo count($group->getMembers()); ?></strong> members.
                                        Here are 10 random ones:</p>

                                    <ul>
                                        <?php $list = array_rand($members, 10);
                                        foreach ($list as $i) : ?>
                                            <li><?php echo $members[$i]->getHabboName(); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>