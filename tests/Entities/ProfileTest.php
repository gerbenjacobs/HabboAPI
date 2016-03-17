<?php

use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Group;
use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Profile;
use HabboAPI\Entities\Room;

class ProfileTest extends \PHPUnit_Framework_TestCase
{
    private static $data;
    /**
     * @var Profile $profile
     */
    private $profile;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp()
    {
        // Create profile
        $this->profile = new Profile();

        // Create and add Habbo
        $habbo = new Habbo();
        $habbo->parse(self::$data['user']);
        $this->profile->setHabbo($habbo);

        // Create and add all Badge
        foreach (self::$data['badges'] as $badge_data) {
            $badge = new Badge();
            $badge->parse($badge_data);
            $this->profile->addBadge($badge);
        }

        // Create and add all Groups
        foreach (self::$data['groups'] as $group_data) {
            $group = new Group();
            $group->parse($group_data);
            $this->profile->addGroup($group);
        }

        // Create and add all Friends
        foreach (self::$data['friends'] as $friend_data) {
            $friend = new Habbo();
            $friend->parse($friend_data);
            $this->profile->addFriend($friend);
        }

        // Create and add all Rooms
        foreach (self::$data['rooms'] as $room_data) {
            $room = new Room();
            $room->parse($room_data);
            $this->profile->addRoom($room);
        }
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Profile', $this->profile);
    }

    public function testCounts()
    {
        $counts = $this->profile->getCounts();

        $this->assertEquals(1, $counts['habbo'], "Habbo count should be 1");
        $this->assertEquals(204, $counts['badges'], "Badges count should be 204");
        $this->assertEquals(10, $counts['groups'], "Groups count should be 10");
        $this->assertEquals(146, $counts['friends'], "Friends count should be 146");
        $this->assertEquals(5, $counts['rooms'], "Rooms count should be 5");
    }

}
