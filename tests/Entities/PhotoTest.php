<?php
use HabboAPI\Entities\Photo;

/**
 * Class PhotoTest
 *  Tests for the Photo entity object
 */
class PhotoTest extends PHPUnit_Framework_TestCase
{

    private static $data;
    /**
     * @var Photo $photo
     */
    private $photo;

    public static function setUpBeforeClass()
    {
        self::$data = json_decode(file_get_contents(dirname(__FILE__) . '/../data/com_koeientemmer_getphotos.json'), true);
    }

    public function setUp()
    {
        $this->photo = new Photo();
        $this->photo->parse(self::$data[0]);
    }

    public function testEntityType()
    {
        $this->assertInstanceOf('HabboAPI\Entities\Photo', $this->photo);
    }

    public function testProperties()
    {
        $this->assertEquals('171ed8e4-6424-4c10-8ef1-bdddde2b4343', $this->photo->getId());
        $this->assertEquals('//habbo-stories-content.s3.amazonaws.com/servercamera/purchased/hhus/p-31212674-1448057454995.png', $this->photo->getPreviewUrl());
        $this->assertEquals(array(), $this->photo->getTags());
        $this->assertEquals('hhus-9cd61b156972c2eb33a145d69918f965', $this->photo->getCreatorUniqueId());
        $this->assertEquals('koeientemmer', $this->photo->getCreatorName());
        $this->assertEquals(31212674, $this->photo->getCreatorId());
        $this->assertEquals('PHOTO', $this->photo->getType());
        $this->assertEquals('//habbo-stories-content.s3.amazonaws.com/servercamera/purchased/hhus/p-31212674-1448057454995.png', $this->photo->getUrl());
        $this->assertInstanceOf('\Carbon\Carbon', $this->photo->getTakenOn());
        $this->assertEquals('Nov 20, 2015', $this->photo->getTakenOn()->toFormattedDateString());
        $this->assertEquals(65285667, $this->photo->getRoomId());
        $this->assertEquals(array('aapo'), $this->photo->getLikes());
    }

}
 