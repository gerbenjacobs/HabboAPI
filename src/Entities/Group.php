<?php
/**
 * The entity model for a Group object
 */

namespace HabboAPI\Entities;

/**
 * Class Group
 *
 * @package HabboAPI\Entities
 */
class Group implements Entity
{

    private string $id, $name, $description, $type;
    private ?string $badgeCode = null, $roomId = null, $primaryColour = null, $secondaryColour = null;
    private array $members;
    private ?bool $isAdmin = null;

    /** Parses group info array to \Entities\Group object
     *
     * @param array $data
     */
    public function parse($data): void
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setDescription($data['description']);
        $this->setType($data['type']);
        if (isset($data['primaryColour'])) {
            $this->setPrimaryColour($data['primaryColour']);
        }
        if (isset($data['secondaryColour'])) {
            $this->setSecondaryColour($data['secondaryColour']);
        }
        if (isset($data['badgeCode'])) {
            $this->setBadgeCode($data['badgeCode']);
        }
        if (isset($data['roomId'])) {
            $this->setRoomId($data['roomId']);
        }
        if (isset($data['isAdmin'])) {
            $this->setIsAdmin($data['isAdmin']);
        }
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBadgeCode(): string
    {
        return $this->badgeCode;
    }

    protected function setBadgeCode(string $badgeCode): void
    {
        $this->badgeCode = $badgeCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }


    protected function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    protected function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    public function getPrimaryColour(): ?string
    {
        return $this->primaryColour;
    }

    protected function setPrimaryColour(string $primaryColour): void
    {
        $this->primaryColour = $primaryColour;
    }

    public function getRoomId(): ?string
    {
        return $this->roomId;
    }

    protected function setRoomId(string $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function getSecondaryColour(): ?string
    {
        return $this->secondaryColour;
    }

    protected function setSecondaryColour(string $secondaryColour): void
    {
        $this->secondaryColour = $secondaryColour;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getMembers(): array|null
    {
        return $this->members;
    }

    public function setMembers(array $members): void
    {
        $this->members = $members;
    }

    /* Cleaner methods */
    public function isAdmin(): bool
    {
        return $this->getIsAdmin();
    }

    public function getPrimaryColor(): ?string
    {
        return $this->getPrimaryColour();
    }

    public function getSecondaryColor(): ?string
    {
        return $this->getSecondaryColour();
    }
}
