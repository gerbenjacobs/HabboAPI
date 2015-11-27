<?php

use HabboAPI\Entities\Habbo;
use HabboAPI\HabboParser;

class HabboParserTest extends PHPUnit_Framework_TestCase
{
    private static $habbo;
    private static $profile;
    /** @var HabboParser|PHPUnit_Framework_MockObject_MockObject $habboParserMock */
    private $habboParserMock;

    public static function setUpBeforeClass()
    {
        self::$habbo = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_gethabbo.json'), true);
        self::$profile = json_decode(file_get_contents(dirname(__FILE__) . '/data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp()
    {
        $this->habboParserMock = $this->getMockBuilder('\HabboAPI\HabboParser')
            ->setMethods(array('_callUrl'))
            ->getMock();
    }

    /**
     * Testing the parseHabbo method with static input
     */
    public function testParseHabbo()
    {
        // Replace parseHabbo with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(self::$habbo));

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

    /**
     * @expectedException InvalidArgumentException
     */
    public function testParseHabboWithInvalidType()
    {
        $this->habboParserMock->parseHabbo('hhus-9cd61b156972c2eb33a145d69918f965', 'invalid');
    }

    public function testParseProfile()
    {
        // Replace parseProfile with static data
        $this->habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(self::$profile));

        $profile = $this->habboParserMock->parseProfile('hhus-9cd61b156972c2eb33a145d69918f965');

        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $profile['habbo']);
        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $profile['friends'][0]);
        $this->assertInstanceOf('HabboAPI\Entities\Group', $profile['groups'][0]);
        $this->assertInstanceOf('HabboAPI\Entities\Room', $profile['rooms'][0]);
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $profile['badges'][0]);
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
}
