<?php

use HabboAPI\Entities\Badge;

class BadgeTest extends \PHPUnit_Framework_TestCase
{
    private static $data;
    /**
     * @var Badge $badge
     */
    private $badge;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp()
    {
        $this->badge = new Badge();
        $this->badge->parse(self::$data['badges'][0]);
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $this->badge);
    }

    public function testGetCode()
    {
        $this->assertEquals('ACH_RoomDecoFurniTypeCount9', $this->badge->getCode());
    }

    public function testGetName()
    {
        $this->assertEquals('RoomDecoFurniTypeCount9', $this->badge->getName());
    }

    public function testGetDescription()
    {
        $this->assertEquals('RoomDecoFurniTypeCount9', $this->badge->getDescription());
    }

}
