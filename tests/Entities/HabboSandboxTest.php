<?php

use HabboAPI\Entities\Habbo;
use PHPUnit\Framework\TestCase;

/**
 * Class HabboTest
 *  Tests for the Habbo entity object
 */
class HabboSandboxTest extends TestCase
{

    private static $data;
    /**
     * @var Habbo $habbo
     */
    private $habbo;

    public static function setUpBeforeClass(): void
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/sandbox_johno_gethabbo.json'), true);
    }

    public function setUp(): void
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
        $this->assertEquals('hhs2-15cdd228b60baf1fcd72283ab29d1527', $this->habbo->getId());
    }

    public function testGetHabboName()
    {
        $this->assertEquals('Johno', $this->habbo->getHabboName());
    }

    public function testGetFigureString()
    {
        $this->assertEquals('hr-165-31.hd-180-1.ch-215-1408.lg-280-1408.sh-300-1408.fa-1201', $this->habbo->getFigureString());
    }

    public function testGetMotto()
    {
        $this->assertEquals('null', $this->habbo->getMotto());
    }

    public function testGetMemberSince()
    {
        $this->assertInstanceOf('\Carbon\Carbon', $this->habbo->getMemberSince());
        $this->assertEquals('Jul 19, 2004', $this->habbo->getMemberSince()->toFormattedDateString());
    }

    public function testGetLastAccessTime()
    {
        $this->assertInstanceOf('\Carbon\Carbon', $this->habbo->getLastAccessTime());
        $this->assertEquals('Dec 7, 2020', $this->habbo->getLastAccessTime()->toFormattedDateString());
    }

    public function testFiveSelectedBadges()
    {
        $selectedBadges = $this->habbo->getSelectedBadges();
        $this->assertCount(3, $selectedBadges);
        $this->assertInstanceOf('HabboAPI\Entities\Badge', $selectedBadges[0]);
    }

    public function testHasProfile()
    {
        $this->assertTrue($this->habbo->hasProfile());
    }

    public function testIsOnline()
    {
        $this->assertNotTrue($this->habbo->isOnline());
    }

    public function testCurrentLevel()
    {
        $this->assertEquals(7, $this->habbo->getCurrentLevel());
    }

    public function testCurrentLevelCompleted()
    {
        $this->assertEquals(75, $this->habbo->getCurrentLevelCompleted());
    }

    public function testTotalExp()
    {
        $this->assertEquals(110, $this->habbo->getTotalExperience());
    }

    public function testStarGem()
    {
        $this->assertEquals(18, $this->habbo->getStarGemCount());
    }
}
