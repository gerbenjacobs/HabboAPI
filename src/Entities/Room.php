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

    /** Parses room info array to \Entities\Room object
     *
     * @param array $room
     */
    public function parse($room)
    {
        $this->setId($room['id']);
        $this->setName($room['name']);
        $this->setDescription($room['description']);
        $this->setOwnerUniqueId($room['ownerUniqueId']);
        $this->setThumbnailUrl($room['thumbnailUrl']);
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