<?php
namespace HabboAPI\Entities;
class Room {
    private $id;
    private $name;
    private $description;
    private $ownerUniqueId;

    public function parse($room) {
        $this->setId($room['id']);
        $this->setName($room['name']);
        $this->setDescription($room['description']);
        $this->setOwnerUniqueId($room['ownerUniqueId']);
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    protected function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getOwnerUniqueId()
    {
        return $this->ownerUniqueId;
    }

    /**
     * @param mixed $ownerUniqueId
     */
    protected function setOwnerUniqueId($ownerUniqueId)
    {
        $this->ownerUniqueId = $ownerUniqueId;
    }
}