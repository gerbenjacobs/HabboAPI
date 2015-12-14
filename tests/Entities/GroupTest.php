<?php

use HabboAPI\Entities\Group;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    private static $data;
    /**
     * @var Group $entity
     */
    private $entity;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp()
    {
        $this->entity = new Group();
        $this->entity->parse(self::$data['groups'][0]);
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Group', $this->entity);
    }

    public function testGetId()
    {
        $this->assertEquals('g-hhus-1332dcd15645042afc396f726351721d', $this->entity->getId());
    }

    public function testGetName()
    {
        $this->assertEquals('Ditch the Label', $this->entity->getName());
    }

    public function testGetDescription()
    {
        $this->assertEquals('The official Ditch the Label anti-bullying public group. Join now and support our cause! Find out more at www.DitchtheLabel.org', $this->entity->getDescription());
    }

    public function testGetType()
    {
        $this->assertEquals('NORMAL', $this->entity->getType());
    }

    public function testGetRoomId()
    {
        $this->assertEquals('r-hhus-a08de337a9dc601102b0139194164f78', $this->entity->getRoomId());
    }

    public function testGetBadgeCode()
    {
        $this->assertEquals('b13114s19134a55aa7427bc0a3f0c083e94232fb3475', $this->entity->getBadgeCode());
    }

    public function testGetPrimaryColour()
    {
        $this->assertEquals('242424', $this->entity->getPrimaryColour());
    }

    public function testIncompleteGroup()
    {
        $incomplete = array(
            'id' => 'g-hhtr-8fe11690ee3f3b36705dd3f6ecb3dde3',
            'name' => 'Crowleys Koffie Clan',
            'description' => 'Iedereen een kopje koffie?',
            'type' => 'NORMAL'
        );
        $this->entity = new Group();
        $this->entity->parse($incomplete);

        // Is valid entity?
        $this->assertInstanceOf('HabboAPI\Entities\Group', $this->entity);

        $this->assertEquals('Iedereen een kopje koffie?', $this->entity->getDescription());
        $this->assertNull($this->entity->getPrimaryColor());
    }

    /**
     * Explicitly checks the helper method with EN_US locale
     */
    public function testGetSecondaryColor()
    {
        $this->assertEquals('ffffff', $this->entity->getSecondaryColor());
    }

    public function testIsAdmin()
    {
        $this->assertFalse($this->entity->getIsAdmin());
    }

    public function testAllForExceptions()
    {
        foreach (self::$data['groups'] as $data) {
            $entity = new Group();
            $entity->parse($data);

            // Make sure it doesn't throw errors
            $this->assertInstanceOf('HabboAPI\Entities\Group', $entity);
        }
    }

}
