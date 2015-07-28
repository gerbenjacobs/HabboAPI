<?php
// Include the Composer autoloader
include '../vendor/autoload.php';

// Shortcut for the FQN
use HabboAPI\HabboAPI;
use HabboAPI\HabboParser;

// Create new Parser and API instance
$server_ip = @file_get_contents('https://api.ipify.org'); // Only used for instant example, fix this in production
$habboParser = new HabboParser($server_ip, 'https://www.habbo.com/api/public/');
$habboApi = new HabboAPI($habboParser);

// Find the user 'Powertoo'
$habboEntity = $habboApi->getHabbo('Powertoo');


// Set up HTML response
$html = '
    <h1>Habbo: ' . $habboEntity->getHabboName() . '</h1>
    <h3>Motto: ' . $habboEntity->getMotto() . ' - <small>Signed up: ' . $habboEntity->getMemberSince() . '</small></h3>
';

if ($habboEntity->hasProfile()) {
    $html .= '<p><a href="http://www.habbo.com/profile/' . $habboEntity->getHabboName() . '">View Habbo home</a>';
} else {
    $html .= '<p><em>Habbo Home is closed</em></p>';
}

foreach ($habboEntity->getSelectedBadges() as $badge) {
    $html .= '
        <p>
            <img src="http://images.habbo.com/c_images/album1584/' . $badge->getCode() . '.gif" alt="' . $badge->getName() . '" title="' . $badge->getName() . '" style="float: left; margin-right: 10px;">
            (' . $badge->getCode() . ') - <strong>' . $badge->getName() . '</strong><br>
            <em>' . $badge->getDescription() . '</em>
        </p>
    ';
}
?>
<!doctype html>
<html>
<head>
    <title>Habbo entity of: <?php echo $habboEntity->getHabboName(); ?></title>
</head>
<body>
<?php echo $html; ?>
</body>
</html>
