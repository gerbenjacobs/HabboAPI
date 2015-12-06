<?php
/**
 * The entitymodel for a Room object
 */
namespace HabboAPI\Entities;

/**
 * Class Room
 *
 * The model for a Habbo object
 *
 * @package HabboAPI\Entities
 */
class Room implements Entity
{
    private $id;
    private $name;
    private $description;
    private $creationTime;
    private $maximumVisitors;
    private $tags;
    private $officialRoom;
    private $ownerName;
    private $ownerUniqueId;
    private $categories;
    private $thumbnailUrl;
    private $imageUrl;
    private $rating;

    /** Parses room info array to \Entities\Room object
     *
     * @param array $room
     */
    public function parse($room)
    {
        $this->setId($room['id']);
        $this->setName($room['name']);
        $this->setDescription($room['description']);
        $this->setMaximumVisitors($room['maximumVisitors']);
        $this->setTags($room['tags']);
        $this->setOfficialRoom($room['officialRoom']);
        $this->setOwnerName($room['ownerName']);
        $this->setOwnerUniqueId($room['ownerUniqueId']);
        $this->setCategories($room['categories']);
        $this->setThumbnailUrl($room['thumbnailUrl']);
        $this->setImageUrl($room['imageUrl']);
        $this->setRating($room['rating']);

        if (isset($room['creationTime'])) {
            $this->setCreationTime($room['creationTime']);
        }
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    protected function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getOwnerUniqueId()
    {
        return $this->ownerUniqueId;
    }

    /**
     * @param string $ownerUniqueId
     */
    protected function setOwnerUniqueId($ownerUniqueId)
    {
        $this->ownerUniqueId = $ownerUniqueId;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string $thumbnailUrl
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * @param string $creationTime
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;
    }

    /**
     * @return int
     */
    public function getMaximumVisitors()
    {
        return $this->maximumVisitors;
    }

    /**
     * @param int $maximumVisitors
     */
    public function setMaximumVisitors($maximumVisitors)
    {
        $this->maximumVisitors = $maximumVisitors;
    }

    /**
     * @return boolean
     */
    public function getOfficialRoom()
    {
        return $this->officialRoom;
    }

    /**
     * @param boolean $officialRoom
     */
    public function setOfficialRoom($officialRoom)
    {
        $this->officialRoom = $officialRoom;
    }

    /**
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * @param string $ownerName
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}