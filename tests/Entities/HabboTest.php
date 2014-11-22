<?php

class HabboTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \HabboAPI\Entities\Habbo $habbo
     */
    private $habbo;

    private static $data;


    public static function setUpBeforeClass() {
        self::$data = json_decode(file_get_contents('tests/data/com_koeientemmer_gethabbo.json'), true);
    }
    public function setUp () {
        $this->habbo = new \HabboAPI\Entities\Habbo();
        $this->habbo->parse(self::$data);
    }

    public function testIsHabboEntity() {
        $this->assertInstanceOf("HabboAPI\\Entities\\Habbo", $this->habbo);
    }

    public function testGetId(){
        $this->assertEquals("hhus-9cd61b156972c2eb33a145d69918f965", $this->habbo->getId());
    }
    public function testGetHabboName() {
        $this->assertEquals("koeientemmer", $this->habbo->getHabboName());
    }

    public function testTwoSelectedBadges() {
        $this->assertEquals(2, count($this->habbo->getSelectedBadges()));
    }
}
 