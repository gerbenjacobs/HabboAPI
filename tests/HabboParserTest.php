<?php

class HabboParserTest extends PHPUnit_Framework_TestCase {
    private static $habbo;
    private static $profile;

    public static function setUpBeforeClass() {
        self::$habbo = json_decode(file_get_contents('tests/data/com_koeientemmer_gethabbo.json'), true);
        self::$profile = json_decode(file_get_contents('tests/data/com_koeientemmer_getprofile.json'), true);
    }

    /**
     * Testing the parseHabbo method with static input
     */
    public function testParseHabbo() {
        $habboParserMock = $this->getMock('\HabboAPI\HabboParser', array('_callUrl'), array($this->any()));
        $habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(self::$habbo));

        $habboObject = $habboParserMock->parseHabbo('koeientemmer');

        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $habboObject);
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $habboObject->getSelectedBadges()[0]);
    }

    public function testParseProfile() {
        $habboParserMock = $this->getMock('\HabboAPI\HabboParser', array('_callUrl'), array($this->any()));
        $habboParserMock->expects($this->once())->method('_callUrl')->will($this->returnValue(self::$profile));

        $profile = $habboParserMock->parseProfile('hhus-9cd61b156972c2eb33a145d69918f965');

        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $profile['habbo']);
        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $profile['friends'][0]);
        $this->assertInstanceOf('HabboAPI\Entities\Group', $profile['groups'][0]);
        $this->assertInstanceOf('HabboAPI\Entities\Room',  $profile['rooms'][0]);
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $profile['badges'][0]);
    }
}
