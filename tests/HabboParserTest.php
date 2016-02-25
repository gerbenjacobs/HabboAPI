<?php

use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Profile;
use HabboAPI\HabboParser;

class HabboParserTest extends PHPUnit_Framework_TestCase
{
    private static $habbo, $profile, $photos, $public_photos, $group, $group_members;
    /** @var HabboParser|PHPUnit_Framework_MockObject_MockObject $habboParserMock */
    private $habboParserMock;

    public static function setUpBeforeClass()
    {
        self::$habbo = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_gethabbo.json'), true);
        self::$profile = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_getprofile.json'), true);
        self::$photos = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_getphotos.json'), true);
        self::$public_photos = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_public_photos.json'), true);
        self::$group = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_group.json'), true);
        self::$group_members = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_group_members.json'), true);
    }

    public function setUp()
    {
        $this->habboParserMock = $this->getMockBuilder('\HabboAPI\HabboParser')
            ->setMethods(array('_callUrl'))
            ->getMock();
        $this->habboParserMock->cookie = "some-fake-cookie";
    }

    /**
     * Testing the parseHabbo method with static input
     */
    public function testParseHabbo()
    {
        // Replace parseHabbo with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(array(self::$habbo)));

        /** @var Habbo $habboObject */
        $habboObject = $this->habboParserMock->parseHabbo('koeientemmer');

        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $habboObject);
        $selectedBadges = $habboObject->getSelectedBadges();
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $selectedBadges[0]);
    }

    public function testParseHabboWithId()
    {
        // Should use HHID based url
        $this->habboParserMock->expects($this->once())->method('_callUrl')->with('https://www.habbo.com/api/public/users/hhus-9cd61b156972c2eb33a145d69918f965');

        $this->habboParserMock->parseHabbo('hhus-9cd61b156972c2eb33a145d69918f965', 'hhid');
    }

    public function testParseProfile()
    {
        // Replace parseProfile with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(array(self::$profile)));

        /** @var Profile $profile */
        $profile = $this->habboParserMock->parseProfile('hhus-9cd61b156972c2eb33a145d69918f965');

        $friends = $profile->getFriends();
        $groups = $profile->getGroups();
        $rooms = $profile->getRooms();
        $badges = $profile->getBadges();
        $this->assertInstanceOf('HabboAPI\Entities\Profile', $profile);
        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $profile->getHabbo());
        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $friends[0]);
        $this->assertInstanceOf('HabboAPI\Entities\Group', $groups[0]);
        $this->assertInstanceOf('HabboAPI\Entities\Room', $rooms[0]);
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $badges[0]);
    }

    /**
     * @expectedException Exception
     */
    public function testErrorHabbo()
    {
        // Replace parseHabbo with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->throwException(new Exception('Some kind of exception')));

        $this->habboParserMock->parseHabbo('someHabboNameThatDoesNotExist');
    }

    public function testParseHabboPhotos()
    {
        // Replace Habbo Parser mock with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(array(self::$photos)));

        $photos = $this->habboParserMock->parsePhotos('hhus-9cd61b156972c2eb33a145d69918f965');

        $this->assertEquals(2, count($photos), "Should contain 2 photos");
        $this->assertInstanceOf('HabboAPI\Entities\Photo', $photos[0]);
        $this->assertInstanceOf('HabboAPI\Entities\Photo', $photos[1]);
    }

    public function testParsePublicPhotos()
    {
        // Replace Habbo Parser mock with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(array(self::$public_photos)));

        $photos = $this->habboParserMock->parsePhotos();

        $this->assertEquals(200, count($photos), "Should contain 200 photos");
        foreach ($photos as $photo) {
            $this->assertInstanceOf('HabboAPI\Entities\Photo', $photo);
        }
    }

    public function testParseGroup()
    {
        // Replace Habbo Parser mock with static data
        $this->habboParserMock->expects($this->at(0))->method('_callUrl')->will($this->returnValue(array(self::$group)));
        $this->habboParserMock->expects($this->at(1))->method('_callUrl')->will($this->returnValue(array(self::$group_members)));

        $group = $this->habboParserMock->parseGroup("g-hhus-fd92759bc932225f663f1521be8ce255");

        $this->assertInstanceOf('HabboAPI\Entities\Group', $group);
        foreach ($group->getMembers() as $member) {
            $this->assertInstanceOf('HabboAPI\Entities\Habbo', $member);
        }
    }
}
