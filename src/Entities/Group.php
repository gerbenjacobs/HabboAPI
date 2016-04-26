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

    private $id, $name, $description, $type, $primaryColour, $secondaryColour, $badgeCode, $roomId, $isAdmin, $members;

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
        if (isset($group['primaryColour'])) {
            $this->setPrimaryColour($group['primaryColour']);
        }
        if (isset($group['secondaryColour'])) {
            $this->setSecondaryColour($group['secondaryColour']);
        }
        if (isset($group['badgeCode'])) {
            $this->setBadgeCode($group['badgeCode']);
        }
        if (isset($group['roomId'])) {
            $this->setRoomId($group['roomId']);
        }
        if (isset($group['isAdmin'])) {
            $this->setIsAdmin($group['isAdmin']);
        }
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
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param boolean $isAdmin
     */
    protected function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return string
     */
    public function getPrimaryColour()
    {
        return $this->primaryColour;
    }

    /**
     * @param string $primaryColour
     */
    protected function setPrimaryColour($primaryColour)
    {
        $this->primaryColour = $primaryColour;
    }

    /**
     * @return string
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @param string $roomId
     */
    protected function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * @return string
     */
    public function getSecondaryColour()
    {
        return $this->secondaryColour;
    }

    /**
     * @param string $secondaryColour
     */
    protected function setSecondaryColour($secondaryColour)
    {
        $this->secondaryColour = $secondaryColour;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    protected function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Habbo[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param Habbo[] $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
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

}