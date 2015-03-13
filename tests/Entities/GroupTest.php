<?php

use HabboAPI\Entities\Group;

class GroupTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Group $entity
     */
    private $entity;

    private static $data;


    public static function setUpBeforeClass() {
        self::$data = json_decode(file_get_contents(dirname(__FILE__).'/../data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp () {
        $this->entity = new Group();
        $this->entity->parse(self::$data['groups'][0]);
    }

    public function testEntityType() {
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
        $this->assertEquals('b12114s81133s97134s89135b5daef0623e81c6434e07abb60a12941', $this->entity->getBadgeCode());
    }

    public function testGetPrimaryColour()
    {
        $this->assertEquals('242424', $this->entity->getPrimaryColour());
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

}
