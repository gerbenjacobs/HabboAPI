<?php

use HabboAPI\Entities\Room;

class RoomTest extends \PHPUnit_Framework_TestCase
{
    private static $data;
    /**
     * @var Room $entity
     */
    private $entity;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_getprofile.json'), true);
    }

    public function setUp()
    {
        $this->entity = new Room();
        $this->entity->parse(self::$data['rooms'][0]);
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Room', $this->entity);
    }

    public function testGetId()
    {
        $this->assertEquals('r-hhus-a091e0f1d891108b49ca7af953386f0f', $this->entity->getId());
    }

    public function testGetName()
    {
        $this->assertEquals('Venice Beach Rollercoaster', $this->entity->getName());
    }

    public function testGetDescription()
    {
        $this->assertEquals('Ahh well..', $this->entity->getDescription());
    }

    public function testGetOwnerId()
    {
        $this->assertEquals('hhus-9cd61b156972c2eb33a145d69918f965', $this->entity->getOwnerUniqueId());
    }

    public function testThumbnailUrl()
    {
        $this->assertEquals('http://habbo-stories-content.s3.amazonaws.com/navigator-thumbnail/hhus/31159787.png', $this->entity->getThumbnailUrl());
    }
}
