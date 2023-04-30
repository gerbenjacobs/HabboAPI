<?php
/**
 * The entity model for an Achievement object
 */

namespace HabboAPI\Entities;

use Carbon\Carbon;

/**
 * Class Achievement
 *
 * @package HabboAPI\Entities
 */
class Achievement implements Entity
{
    private string $id, $name, $category, $state;
    private \DateTimeInterface $creationTime;
    private int $level, $score;

    /**
     * Parses achievement info array to Achievement object
     * @param $data
     */
    public function parse($data): void
    {
        // add default fields
        $this->id = $data['achievement']['id'];
        $this->name = $data['achievement']['name'];
        $this->category = $data['achievement']['category'];
        if (isset($data['achievement']['state'])) {
            $this->state = $data['achievement']['state'];
        }

        if (isset($data['achievement']['creationTime'])) {
            $this->creationTime = Carbon::parse($data['achievement']['creationTime']);
        }

        // add user state if available
        if (isset($data['level'])) {
            $this->level = $data['level'];
        }
        if (isset($data['score'])) {
            $this->score = $data['score'];
        }
    }

    public function __toString()
    {
        return $this->getName();
    }


    public function getId(): int|string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getLevel(): int
    {
        return $this->level;
    }


    public function getScore(): int
    {
        return $this->score;
    }


    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCreationTime(): \DateTimeInterface
    {
        return $this->creationTime;
    }

    public function setCreationTime(\DateTimeInterface $creationTime): void
    {
        $this->creationTime = $creationTime;
    }
}
