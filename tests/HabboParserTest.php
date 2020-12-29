<?php

use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Profile;
use HabboAPI\Exceptions\HabboNotFoundException;
use HabboAPI\Exceptions\MaintenanceException;
use HabboAPI\Exceptions\UserInvalidException;
use HabboAPI\HabboParser;
use PHPUnit\Framework\TestCase;

class HabboParserTest extends TestCase
{
    private static $habbo, $profile, $photos, $public_photos, $group, $group_members, $hotel_maintenance, $achievements;
    private $habboParserMock;

    public static function setUpBeforeClass(): void
    {
        self::$habbo = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_gethabbo.json'), true);
        self::$profile = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_getprofile.json'), true);
        self::$photos = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_getphotos.json'), true);
        self::$public_photos = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_public_photos.json'), true);
        self::$group = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_group.json'), true);
        self::$group_members = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_group_members.json'), true);
        self::$hotel_maintenance = file_get_contents(dirname(__FILE__) . '/data/hotel_maintenance.html');
        self::$achievements = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_getachievements.json'), true);
    }

    public function setUp(): void
    {
        $this->habboParserMock = $this->getMockBuilder('\HabboAPI\HabboParser')
            ->onlyMethods(['_callUrl'])
            ->getMock();

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
        $this->habboParserMock->expects($this->once())
            ->method('_callUrl')
            ->with('https://www.habbo.com/api/public/users/hhus-9cd61b156972c2eb33a145d69918f965')
            ->will($this->returnValue(array(self::$habbo)));

        $this->habboParserMock->parseHabbo('hhus-9cd61b156972c2eb33a145d69918f965', true);
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
        $this->habboParserMock->expects($this->any())
            ->method('_callUrl')
            ->willReturnOnConsecutiveCalls([self::$group], [self::$group_members]);

        $group = $this->habboParserMock->parseGroup("g-hhus-fd92759bc932225f663f1521be8ce255");
        $members = $group->getMembers();

        $this->assertInstanceOf('HabboAPI\Entities\Group', $group);
        foreach ($members as $member) {
            $this->assertInstanceOf('HabboAPI\Entities\Habbo', $member);
        }
    }

    public function testParseAchievements()
    {
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(array(self::$achievements)));

        $achievements = $this->habboParserMock->parseAchievements("hhus-9cd61b156972c2eb33a145d69918f965");

        $this->assertEquals(44, count($achievements), "Should contain 44 achievements");
        foreach ($achievements as $achievement) {
            $this->assertInstanceOf('HabboAPI\Entities\Achievement', $achievement);
        }
    }

    public function testMaintenanceException()
    {
        $this->expectException(MaintenanceException::class);
        HabboParser::throwHabboAPIException(self::$hotel_maintenance);
    }

    public function testHabboNotFoundException()
    {
        $this->expectException(HabboNotFoundException::class);
        $not_found = '{"error":"not-found"}';
        HabboParser::throwHabboAPIException($not_found);
    }

    public function testUserInvalidException()
    {
        $this->expectException(UserInvalidException::class);
        $invalid = '{"errors":[{"param":"name","msg":"user.invalid_name","value":"a"}]}';
        HabboParser::throwHabboAPIException($invalid);
    }

    public function testSomeHTMLException()
    {
        $this->expectException(Exception::class);
        $some_html = '<!DOCTYPE><html><head><title>Fake HTML from Habbo</title></head><body>Sorry, we have failing machines</body></html>';
        HabboParser::throwHabboAPIException($some_html);
    }

    public function testSomeJSONException()
    {
        $this->expectException(Exception::class);
        $some_json = '{"error":"something we dont recognize"}';
        HabboParser::throwHabboAPIException($some_json);
    }
}
