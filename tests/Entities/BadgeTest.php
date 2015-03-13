<?php

use HabboAPI\Entities\Badge;

class BadgeTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Badge $badge
     */
    private $badge;

    private static $data;


    public static function setUpBeforeClass() {
        self::$data = json_decode(file_get_contents(dirname(__FILE__).'/../data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp () {
        $this->badge = new Badge();
        $this->badge->parse(self::$data['badges'][0]);
    }

    public function testEntityType() {
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $this->badge);
    }

    public function testGetCode()
    {
        $this->assertEquals('DK2', $this->badge->getCode());
    }

    public function testGetName()
    {
        $this->assertEquals('Pub(lic) Crawl Cider', $this->badge->getName());
    }

    public function testGetDescription()
    {
        $this->assertEquals('St Patrick\'s Day 2011!', $this->badge->getDescription());
    }

}
