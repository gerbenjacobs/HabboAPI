<?php
/**
 * The entity model for a Badge object
 */

namespace HabboAPI\Entities;

/**
 * Class Badge
 *
 * @package HabboAPI\Entities
 */
class Badge implements Entity
{
    private int $badgeIndex = 0;
    private string $code;
    private string $name;
    private string $description;

    /**
     * Parses badge info array to Badge object
     * @param array $data
     */
    public function parse($data): void
    {
        if (isset($data['badgeIndex'])) {
            $this->setBadgeIndex($data['badgeIndex']);
        }
        $this->setCode($data['code']);
        $this->setName($data['name']);
        $this->setDescription($data['description']);
    }

    public function __toString()
    {
        return '[' . $this->getCode() . '] ' . $this->getName();
    }

    public function getCode(): string
    {
        return $this->code;
    }

    protected function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBadgeIndex(): int
    {
        return $this->badgeIndex;
    }

    protected function setBadgeIndex(int $badgeIndex): void
    {
        $this->badgeIndex = $badgeIndex;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->getCode();
    }
}
