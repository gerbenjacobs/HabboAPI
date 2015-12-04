<?php
use HabboAPI\Entities\Habbo;

/**
 * Class HabboTest
 *  Tests for the Habbo entity object
 */
class HabboTest extends PHPUnit_Framework_TestCase
{

    private static $data;
    /**
     * @var Habbo $habbo
     */
    private $habbo;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_gethabbo.json'), true);
    }

    public function setUp()
    {
        $this->habbo = new Habbo();
        $this->habbo->parse(self::$data);
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Habbo', $this->habbo);
    }

    public function testGetId()
    {
        $this->assertEquals('hhus-9cd61b156972c2eb33a145d69918f965', $this->habbo->getId());
    }

    public function testGetHabboName()
    {
        $this->assertEquals('koeientemmer', $this->habbo->getHabboName());
    }

    public function testGetFigureString()
    {
        $this->assertEquals('hr-155-42.hd-195-1.ch-255-76.lg-285-81.sh-290-1408.ha-3430', $this->habbo->getFigureString());
    }

    public function testGetMotto()
    {
        $this->assertEquals('Oldskooler than Dionysus!', $this->habbo->getMotto());
    }

    public function testGetMemberSince()
    {
        $this->assertEquals('2001-10-06T12:21:53.000+0000', $this->habbo->getMemberSince());
    }

    public function testFiveSelectedBadges()
    {
        $selectedBadges = $this->habbo->getSelectedBadges();
        $this->assertEquals(5, count($selectedBadges));
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $selectedBadges[0]);
    }

    public function testHasProfile()
    {
        $this->assertTrue($this->habbo->hasProfile());
    }
}
 