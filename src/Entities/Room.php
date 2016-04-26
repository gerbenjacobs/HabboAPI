<?php
/**
 * The entitymodel for a Room object
 */
namespace HabboAPI\Entities;
use Carbon\Carbon;

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
    private $uniqueId;
    private $name;
    private $description;
    private $creationTime;
    private $maximumVisitors;
    private $tags;
    private $showOwnerName;
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
        $this->setUniqueId($room['uniqueId']);
        $this->setName($room['name']);
        $this->setDescription($room['description']);
        $this->setMaximumVisitors($room['maximumVisitors']);
        $this->setTags($room['tags']);
        $this->setShowOwnerName($room['showOwnerName']);
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
        return $this->uniqueId;
    }

    /**
     * @return int
     */
    public function getOldId()
    {
        return $this->id;
    }

    /**
     * @param int $id
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
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string[] $categories
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
     * @return Carbon
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
        $this->creationTime = Carbon::parse($creationTime);
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
    public function getShowOwnerName()
    {
        return $this->showOwnerName;
    }

    /**
     * @param boolean $showOwnerName
     */
    public function setShowOwnerName($showOwnerName)
    {
        $this->showOwnerName = $showOwnerName;
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

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }
}