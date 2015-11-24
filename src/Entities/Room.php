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
    private $ownerUniqueId;
    private $thumbnailUrl;
    private $tags;
    private $categories;

    /** Parses room info array to \Entities\Room object
     *
     * @param array $room
     */
    public function parse($room)
    {
        $this->setId($room['id']);
        $this->setName($room['name']);
        $this->setDescription($room['description']);
        $this->setThumbnailUrl($room['thumbnailUrl']);
        $this->setTags($room['tags']);

        if (isset($room['ownerUniqueId'])) {
            $this->setOwnerUniqueId($room['ownerUniqueId']);
        }

        if (isset($room['categories'])) {
            $this->setCategories($room['categories']);
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
}