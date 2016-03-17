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

    public function testGetOldId()
    {
        $this->assertEquals(31159787, $this->entity->getOldId());
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

    public function testGetTags()
    {
        $this->assertEquals(array("habbies"), $this->entity->getTags());
    }

    public function testGetCategories()
    {
        $this->assertEquals(array("navigator.flatcategory.global.CHAT"), $this->entity->getCategories());
    }

    public function testGetCreationTime()
    {
        $this->assertInstanceOf('\Carbon\Carbon', $this->entity->getCreationTime());
        $this->assertEquals('Jun 10, 2010', $this->entity->getCreationTime()->toFormattedDateString());
    }

    public function testGetMaximumVisitors()
    {
        $this->assertEquals(25, $this->entity->getMaximumVisitors());
    }

    public function testGetShowOwnerName()
    {
        $this->assertEquals(true, $this->entity->getShowOwnerName());
    }

    public function testGetOwnerName()
    {
        $this->assertEquals('koeientemmer', $this->entity->getOwnerName());
    }

    public function testGetThumbnailUrl()
    {
        $this->assertEquals('https://habbo-stories-content.s3.amazonaws.com/navigator-thumbnail/hhus/31159787.png', $this->entity->getThumbnailUrl());
    }

    public function testGetImageUrl()
    {
        $this->assertEquals('https://habbo-stories-content.s3.amazonaws.com/fullroom-photo/hhus/31159787.png', $this->entity->getImageUrl());
    }

    public function testGetRating()
    {
        $this->assertEquals(116, $this->entity->getRating());
    }

    public function testAllForExceptions()
    {
        foreach (self::$data['rooms'] as $data) {
            $entity = new Room();
            $entity->parse($data);

            // Make sure it doesn't throw errors
            $this->assertInstanceOf('HabboAPI\Entities\Room', $entity);
        }
    }
}
