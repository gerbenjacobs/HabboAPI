<?php


use HabboAPI\Entities\Achievement;

class AchievementTest extends \PHPUnit_Framework_TestCase
{
    private static $data;
    /**
     * @var Achievement $achievement
     */
    private $achievement, $achievement2;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_getachievements.json'), true);
    }

    public function setUp()
    {
        $this->achievement = new Achievement();
        $this->achievement->parse(self::$data[0]);

        $this->achievement2 = new Achievement();
        $this->achievement2->parse(self::$data[1]);

    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Achievement', $this->achievement);
    }

    public function testGetters()
    {
        // First achievement
        $this->assertEquals(3, $this->achievement->getId());
        $this->assertEquals("EmailVerification", $this->achievement->getName());
        $this->assertEquals("identity", $this->achievement->getCategory());

        $this->assertEquals(0, $this->achievement->getScore());
        $this->assertEquals(1, $this->achievement->getLevel());

        // Second achievement
        $this->assertEquals(4, $this->achievement2->getId());
        $this->assertEquals("Login", $this->achievement2->getName());
        $this->assertEquals("identity", $this->achievement2->getCategory());

        $this->assertEquals(2, $this->achievement2->getScore());
        $this->assertEquals(1, $this->achievement2->getLevel());
    }

    public function testAllForExceptions()
    {
        // All achievements..
        foreach (self::$data as $data) {
            $entity = new Achievement();
            $entity->parse($data);

            // Make sure it doesn't throw errors
            $this->assertInstanceOf('HabboAPI\Entities\Achievement', $entity);
        }
    }

}
