<?php
/**
 * The entitymodel for a Room object
 */

namespace HabboAPI\Entities;

use Carbon\Carbon;
use DateTimeInterface;

/**
 * Class Room
 *
 * The model for a Room object
 *
 * @package HabboAPI\Entities
 */
class Room implements Entity
{
    private int $id, $maximumVisitors, $rating;
    private string $uniqueId, $name, $description = "", $habboGroupId = "", $ownerName, $ownerUniqueId, $thumbnailUrl, $imageUrl;
    private ?DateTimeInterface $creationTime = null;
    private array $tags, $categories;
    private bool $showOwnerName;


    /** Parses room info array to \Entities\Room object
     *
     * @param array $data
     */
    public function parse($data): void
    {
        $this->setId($data['id']);
        $this->setUniqueId($data['uniqueId']);
        $this->setName($data['name']);
        if (isset($data['description'])) {
            $this->setDescription($data['description']);
        }
        $this->setMaximumVisitors($data['maximumVisitors']);
        $this->setTags($data['tags']);
        $this->setShowOwnerName($data['showOwnerName']);
        $this->setOwnerName($data['ownerName']);
        $this->setOwnerUniqueId($data['ownerUniqueId']);
        $this->setCategories($data['categories']);
        $this->setThumbnailUrl($data['thumbnailUrl']);
        $this->setImageUrl($data['imageUrl']);
        $this->setRating($data['rating']);

        if (isset($data['creationTime'])) {
            $this->setCreationTime($data['creationTime']);
        }

        if (isset($data['habboGroupId'])) {
            $this->setGroupId($data['habboGroupId']);
        }
    }

    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    protected function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setMaximumVisitors(int $maximumVisitors): void
    {
        $this->maximumVisitors = $maximumVisitors;
    }

    public function setOwnerName(string $ownerName): void
    {
        $this->ownerName = $ownerName;
    }

    protected function setOwnerUniqueId(string $ownerUniqueId): void
    {
        $this->ownerUniqueId = $ownerUniqueId;
    }


    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    public function setThumbnailUrl(string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function setGroupId(string $habboGroupId): void
    {
        $this->habboGroupId = $habboGroupId;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getId(): string
    {
        return $this->uniqueId;
    }


    protected function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOldId(): int
    {
        return $this->id;
    }

    public function getOwnerUniqueId(): string
    {
        return $this->ownerUniqueId;
    }


    public function getTags(): array
    {
        return $this->tags;
    }


    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }


    public function getCreationTime(): ?DateTimeInterface
    {
        return $this->creationTime;
    }

    public function setCreationTime(string $creationTime): void
    {
        $this->creationTime = Carbon::parse($creationTime);
    }

    public function getMaximumVisitors(): int
    {
        return $this->maximumVisitors;
    }

    public function getShowOwnerName(): bool
    {
        return $this->showOwnerName;
    }

    public function setShowOwnerName(bool $showOwnerName): void
    {
        $this->showOwnerName = $showOwnerName;
    }

    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(string $uniqueId): void
    {
        $this->uniqueId = $uniqueId;
    }

    public function getGroupId(): string
    {
        return $this->habboGroupId;
    }
}
