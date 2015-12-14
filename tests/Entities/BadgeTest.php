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
        $this->assertEquals('THI41', $this->badge->getCode());
    }

    public function testGetName()
    {
        $this->assertEquals('...will go on!!!', $this->badge->getName());
    }

    public function testGetDescription()
    {
        $this->assertEquals('Winner of broken hearts 2/2', $this->badge->getDescription());
    }

    public function testAllForExceptions()
    {
        foreach (self::$data['badges'] as $data) {
            $entity = new Badge();
            $entity->parse($data);

            // Make sure it doesn't throw errors
            $this->assertInstanceOf('HabboAPI\Entities\Badge', $entity);
        }
    }

}
