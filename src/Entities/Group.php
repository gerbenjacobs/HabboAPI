<?php
/**
 * The entitymodel for a Group object
 */
namespace HabboAPI\Entities;

/**
 * Class Group
 *
 * @package HabboAPI\Entities
 */
class Group implements Entity
{

    private $id;
    private $name;
    private $description;
    private $type;
    private $primaryColour;
    private $secondaryColour;
    private $badgeCode;
    private $roomId;
    private $isAdmin;

    /** Parses group info array to \Entities\Group object
     *
     * @param array $group
     */
    public function parse($group)
    {
        $this->setId($group['id']);
        $this->setName($group['name']);
        $this->setDescription($group['description']);
        $this->setType($group['type']);
        $this->setPrimaryColour($group['primaryColour']);
        $this->setSecondaryColour($group['secondaryColour']);
        $this->setBadgeCode($group['badgeCode']);
        $this->setRoomId($group['roomId']);
        $this->setIsAdmin($group['isAdmin']);
    }

    public function __toString()
    {
        return $this->getName();
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
    public function getBadgeCode()
    {
        return $this->badgeCode;
    }

    /**
     * @param mixed $badgeCode
     */
    protected function setBadgeCode($badgeCode)
    {
        $this->badgeCode = $badgeCode;
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
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    protected function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return mixed
     */
    public function getPrimaryColour()
    {
        return $this->primaryColour;
    }

    /**
     * @param mixed $primaryColour
     */
    protected function setPrimaryColour($primaryColour)
    {
        $this->primaryColour = $primaryColour;
    }

    /**
     * @return mixed
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @param mixed $roomId
     */
    protected function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * @return mixed
     */
    public function getSecondaryColour()
    {
        return $this->secondaryColour;
    }

    /**
     * @param mixed $secondaryColour
     */
    protected function setSecondaryColour($secondaryColour)
    {
        $this->secondaryColour = $secondaryColour;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /* Cleaner methods */
    public function isAdmin()
    {
        return $this->getIsAdmin();
    }

    public function getPrimaryColor()
    {
        return $this->getPrimaryColour();
    }

    public function getSecondaryColor()
    {
        return $this->getSecondaryColour();
    }

    /**
     * @param mixed $type
     */
    protected function setType($type)
    {
        $this->type = $type;
    }
}